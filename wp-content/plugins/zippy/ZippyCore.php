<?php
namespace LoMa;

/**
 * Class Zippy
 * @package LoMa
 */
class ZippyCore
{
    const DATA_FILE = 'info.dat';

    /**
     * Zippy constructor.
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('admin_init', array($this, 'adminInit'), 99);
        add_action('admin_bar_menu', array($this, 'adminBarMenu'), 77);
        add_action('admin_head', array($this, 'adminHead'));
        add_action('admin_enqueue_scripts', array($this, 'adminEnqueueScripts'));
        add_action('admin_footer', array($this, 'adminFooter'));
        add_action('plugins_loaded', array($this, 'pluginsLoaded'));
    }

    /**
     * Retrieve a list of system post meta keys - which should not be archived
     * @since 1.0.0
     * @return array An array of post meta keys
     */
    private static function getProtectedMetaKeys()
    {
        return apply_filters('zippy-protected-meta-keys', array('_edit_last', '_edit_lock', '_revision-control'));
    }

    /**
     * Append a link to zip post to the posts page
     *
     * @since 1.0.0
     *
     * @param array $actions An array of action links for each post
     * @param \WP_Post $post WP_Post object for the current post
     * @return array An array of action links for each post
     */
    public function rowActions($actions, $post)
    {
        if (current_user_can('read')) {
            $actions['zippy_zip'] = '<a href="' . add_query_arg(['__action' => 'zippy-zip', 'post_id' => $post->ID]) . '">' . __('Zip', 'zippy') . '</a>';
        }

        return $actions;
    }

    /**
     * Bulk action to zip posts
     *
     * @since 1.1.0
     * @internal
     *
     * @param array $actions An array of the available bulk actions.
     * @return array An array of the available bulk actions.
     */
    public function bulkActionsEditPost($actions)
    {
        $actions['zippy_zip'] = __('Zip', 'zippy');

        return $actions;
    }

    /**
     * Process bulk action to zip posts
     *
     * @since 1.1.0
     * @internal
     *
     * @param string $redirectTo The redirect URL.
     * @param string $doAction The action being taken.
     * @param array $postIds The items to take the action on.
     * @return string The redirect URL.
     */
    public function handleBulkActionsEditPost($redirectTo, $doAction, $postIds)
    {
        if ($doAction === 'zippy_zip') {

            $path = self::zipPosts($postIds);

            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename=' . (empty($_SERVER['HTTP_HOST']) ? 'www' : $_SERVER['HTTP_HOST']) . '-' . microtime(true) . '.zip');
            header('Content-Length: ' . filesize($path));

            readfile($path);
            exit;
        }

        return $redirectTo;
    }

    /**
     * Check for the plugin actions
     * @since 1.0.0
     * @internal
     */
    public function adminInit()
    {
        foreach (get_post_types() as $postType) {
            add_filter($postType . '_row_actions', array($this, 'rowActions'), 10, 2);
            add_filter('bulk_actions-edit-' . $postType, array($this, 'bulkActionsEditPost'));
            add_filter('handle_bulk_actions-edit-' . $postType, array($this, 'handleBulkActionsEditPost'), 10, 3);
        }

        if (isset($_REQUEST['__action']) && $_REQUEST['__action'] === 'zippy-zip') {

            $postId = isset($_REQUEST['post_id']) ? (int) $_REQUEST['post_id'] : 0;
            if ($postId > 0) {

                $path = self::zipPost($postId);
                $fileName = sanitize_file_name(get_post($postId)->post_title) . '.zip';

                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename=' . (empty($_SERVER['HTTP_HOST']) ? 'www' : $_SERVER['HTTP_HOST']) . '-' . $fileName);
                header('Content-Length: ' . filesize($path));

                readfile($path);
                exit;
            }

            wp_die(__('No post to duplicate has been selected', 'zippy'));
        }

        if (isset($_REQUEST['__action']) && $_REQUEST['__action'] === 'zippy-unzip') {

            $files = [];

            if (isset($_FILES['zippyFile']['size']) && is_array($_FILES['zippyFile']['size'])) {
                for ($i = 0, $iMax = count($_FILES['zippyFile']['size']); $i < $iMax; $i++) {
                    $files[] = array(
                        'error'    => $_FILES['zippyFile']['error'][$i],
                        'name'     => $_FILES['zippyFile']['name'][$i],
                        'size'     => $_FILES['zippyFile']['size'][$i],
                        'tmp_name' => $_FILES['zippyFile']['tmp_name'][$i],
                        'type'     => $_FILES['zippyFile']['type'][$i]
                    );
                }
            }

            foreach ($files as $file) {

                if (empty($file['name'])) {
                    $this->adminNotice(__('Please select zip archive to extract articles.', 'zippy'), 'error');
                    continue;
                }

                if (pathinfo($file['name'], PATHINFO_EXTENSION) !== 'zip') {
                    $this->adminNotice(sprintf(__('Can not unzip file %s: not zip archive.', 'zippy'), $file['name']), 'error');
                    continue;
                }

                $uploadedFile = wp_handle_upload($file, array('test_form' => false));
                if (isset($uploadedFile['file'])) {

                    if (!class_exists('ZipArchive')) {
                        wp_die(__('Zip functionality is not available on the server!', 'zippy'));
                    }

                    $replaceExists = isset($_REQUEST['replaceExists']) && $_REQUEST['replaceExists'] === 'on';
                    $customPostType = isset($_REQUEST['customPT']) ? $_REQUEST['customPT'] : '';

                    $result = self::unzipPosts($uploadedFile['file'], $replaceExists, $customPostType);

                    if (!empty($result['errors'])) {
                        $this->adminNotice(implode('<br />', $result['errors']), 'error');
                    }

                    $notices = [];

                    foreach ($result['posts'] as $post) {
                        $notices[] = sprintf(__('Article "%s" has been unzipped!', 'zippy'), '<a href="' . get_edit_post_link($post->ID) . '">' . $post->post_title . '</a>');
                    }

                    if (!empty($notices)) {
                        $this->adminNotice(implode('<br />', $notices), 'success');
                    }

                    unlink($uploadedFile['file']);
                }
            }
        }
    }

    /**
     * Fix slashes in the path
     *
     * @since 1.0.0
     *
     * @param string $path Path
     * @return string Fixed path
     */
    private static function fixPath($path)
    {
        return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Archive single post
     *
     * @since 1.0.0
     *
     * @param int $postId Post Id to be archived
     * @return string Path to the archive
     */
    public static function zipPost($postId)
    {
        return self::zipPosts([$postId]);
    }

    /**
     * Archive multiple posts
     *
     * @since 1.1.0
     *
     * @param array $postIds Post Ids to be archived
     * @return string Path to the archive
     */
    public static function zipPosts($postIds)
    {
        if (!class_exists('ZipArchive')) {
            wp_die(__('Zip functionality is not available on the server!', 'zippy'));
        }

        $posts = [];

        foreach ($postIds as $postId) {

            $post = get_post($postId);

            if (!is_a($post, 'WP_Post')) {
                wp_die(sprintf(__('Can not read post with the ID %d. Process terminated.', 'zippy'), $postId));
            }

            $posts[] = $post;
        }

        $path = tempnam(sys_get_temp_dir(), 'zippy');
        if (!file_exists($path)) {
            wp_die(__('Can not create an archive', 'zippy'));
        }

        $postsData = [];

        /** @var \WP_Post $post */
        foreach ($posts as $post) {

            $data = self::getPostCompleteData($post);

            if (!$data) {
                wp_die(sprintf(__('Can not read post with the ID %d. Process terminated.', 'zippy'), $post->ID));
            }

            $postsData[$post->ID] = $data;
        }

        $zip = new \ZipArchive();

        $res = $zip->open($path, \ZipArchive::OVERWRITE);

        if (!$res) {
            wp_die(sprintf(__('Can not create an archive. Error code: %s', 'zippy'), $res));
        }

        if (!$zip->addFromString(self::DATA_FILE, serialize($postsData))) {
            wp_die(__('Can not create an archive', 'zippy'));
        }

        foreach ($postsData as $data) {

            foreach ($data['attachments'] as $attachment) {
                $attachmentPath = get_attached_file($attachment->ID);
                if (is_readable($attachmentPath) && !empty($attachment->rurl)) {
                    $zip->addFile($attachmentPath, $attachment->rurl);
                }
            }

            foreach ($data['images'] as $image) {

                $image = self::fixPath($image);
                $imagePath = self::fixPath(wp_upload_dir()['basedir']) . DIRECTORY_SEPARATOR . $image;

                if (is_readable($imagePath) && !empty($image)) {
                    $zip->addFile($imagePath, str_replace('\\', '/', $image));
                }
            }
        }

        if (!$zip->close()) {
            wp_die(__('Can not close archive', 'zippy'));
        }

        return $path;
    }

    /**
     * Retrieve a complete list of all data to be archived
     *
     * @since 1.0.0
     *
     * @param \WP_Post $post Post object
     * @return array|false Post data as array of the different figures or false on failure
     */
    private static function getPostCompleteData($post)
    {
        // get post meta
        $postMeta = get_post_custom($post->ID);

        foreach ($postMeta as $key => $value) {
            if (in_array($key, self::getProtectedMetaKeys())) {
                unset($postMeta[$key]);
            } else {
                $postMeta[$key] = is_array($value) && !empty($value) ? $value[0] : '';
            }
        }

        // get post taxonomies
        $postTaxonomies = array();
        $taxonomies = apply_filters('zippy-taxonomies', get_object_taxonomies($post->post_type));

        foreach ($taxonomies as $taxonomy) {
            $postTaxonomies[$taxonomy] = wp_get_object_terms($post->ID, $taxonomy, array('orderby' => 'term_order'));
        }

        // get post attachments
        $attachments = array();

        $args = array(
            'post_type'      => 'attachment',
            'post_status'    => 'any',
            'posts_per_page' => -1,
            'post_parent'    => $post->ID
        );

        foreach (get_posts($args) as $p) {
            $attachments[$p->ID] = $p;
        }

        // get post featured image
        $thumbnailId = get_post_thumbnail_id($post->ID);

        if ($thumbnailId > 0) {
            if (isset($attachments[$thumbnailId])) {
                $attachments[$thumbnailId]->isFeaturedImage = true;
            } else {

                /** @var object $thumbnailPost */
                $thumbnailPost = get_post($thumbnailId);

                if ($thumbnailPost instanceof \WP_Post) {
                    $thumbnailPost->isFeaturedImage = true;
                    $attachments[$thumbnailId] = $thumbnailPost;
                }
            }
        }

        $imagesPath = str_replace(ABSPATH, '', wp_upload_dir()['basedir'] . '/');

        // get images from the contents
        $images = [];
        ini_set('allow_url_fopen', 'on');
        $sources = $post->post_content . $post->post_excerpt . maybe_serialize($postMeta);

        if (preg_match_all('/(' . str_replace('/', '\/', $imagesPath) . '\S+\.(?:jpg|png|gif|jpeg))/i', $sources, $matches) && count($matches) > 0) {
            foreach ($matches[1] as $match) {
                if (file_exists(ABSPATH . $match) && !in_array($match, $images)) {
                    $images[] = $match;
                }
            }
        }

        // special case: ID of attachment saved in the custom field
        $postMetaAttachments = [];
        $zippyPostMetaAttachmentKeys = apply_filters('zippy-get-post-meta-attachments', []);

        foreach ($postMeta as $key => $value) {
            if ($value > 0 && in_array($key, $zippyPostMetaAttachmentKeys)) {

                $pmPost = get_post($value);

                if (!($pmPost instanceof \WP_Post)) {
                    continue;
                }

                if (!isset($attachments[$pmPost->ID])) {
                    $attachments[$pmPost->ID] = $pmPost;
                }

                $postMetaAttachments[$key] = $value;
            }
        }

        // skip attachments from the images
        foreach ($attachments as $attachment) {
            foreach ($images as $k => $image) {
                if (strpos($attachment->guid, $image) !== false) {
                    unset($images[$k]);
                }
            }
        }

        $findAttachment = static function ($url) {

            global $wpdb;

            $id = (int) $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid LIKE '%%%s'", esc_sql($url)));
            if ($id > 0) {
                $p = get_post($id);
                if (!empty($p) && !is_wp_error($p)) {
                    return $p;
                }
            }

            return false;
        };

        // if image is the attachment - convert it to the post object
        foreach ($images as $key => $image) {
            if (($attachment = $findAttachment($image)) != false) {

                if (!isset($attachments[$attachment->ID])) {
                    $attachments[$attachment->ID] = $attachment;
                }

                unset($images[$key]);
            }
        }

        // format attachments
        foreach ($attachments as $key => $attachment) {

            $file = get_attached_file($attachment->ID);
            if (!file_exists($file)) {
                unset($attachments[$key]);
                continue;
            }

            // generate relative image path
            // always use normal slashes!
            $attachments[$key]->rurl = str_replace(array(ABSPATH . $imagesPath, '\\'), array('', '/'), $file);

            // get attachments meta
            foreach (get_post_meta($attachment->ID) as $metaKey => $value) {

                if (!isset($attachments[$key]->meta)) {
                    $attachments[$key]->meta = [];
                }

                $attachments[$key]->meta[$metaKey] = $value;
            }
        }

        // strip uploads folder from the images path
        foreach ($images as $k => $image) {
            $images[$k] = str_replace($imagesPath, '', $image);
        }

        // get post author
        if ($post->post_author > 0) {
            $post->post_author = get_userdata($post->post_author);
            if ($post->post_author) {
                $post->post_author = $post->post_author->data;
            }
        } else {
            $post->post_author = array();
        }

        return apply_filters('zippy-data', array(
            'post'            => $post,
            'post_meta'       => $postMeta,
            'post_taxonomies' => $postTaxonomies,
            'attachments'     => $attachments,
            'images'          => array_values($images),
            'pma'             => $postMetaAttachments,
            'site_url'        => site_url(),
            'timestamp'       => time()
        ));
    }

    /**
     * Replace URL's in the variable
     *
     * @since 1.0.0
     *
     * @param string|array|object $content
     * @param string $convertFromUrl
     * @return string|array|object
     */
    private static function replaceURLs($content, $convertFromUrl)
    {
        if (!empty($content)) {
            if (is_array($content)) {
                foreach ($content as $key => $value) {
                    $content[$key] = self::replaceURLs($value, $convertFromUrl);
                }
            } elseif (is_object($content)) {
                $vars = get_object_vars($content);
                foreach ($vars as $key => $data) {
                    $content->{$key} = self::replaceURLs($data, $convertFromUrl);
                }
            } elseif (is_string($content)) {
                $content = str_replace($convertFromUrl, get_site_url(), $content);
            }
        }

        return $content;
    }

    /**
     * Create terms and assign them to the post
     *
     * @since 1.0.0
     *
     * @param int $postId Post Id
     * @param array $terms Terms to be created and assigned
     * @param string $taxonomy Taxonomy name
     * @return bool
     */
    private static function createAndAssignTerms($postId, $terms, $taxonomy)
    {
        $created = false;

        $existTerms = array();
        foreach ($terms as $term) {

            // try to find term by slug
            if ($existTerm = get_term_by('slug', $term->slug, $taxonomy, ARRAY_N, $term->filter)) {

                if (!is_wp_error($existTerm)) {
                    $existTerms[] = $term->slug;
                }

            } else { // if can't find - crate new term

                // be sure that parent in this project is the same as on from which we transferred post (compare parent slugs)
                if ($term->parent > 0) {
                    $parent = get_term_by('slug', $term->parent_slug, $taxonomy);
                    if (is_wp_error($parent) || $parent->parent === null || $parent->term_id != $term->parent) {
                        $term->parent = 0;
                    }
                }

                // create term
                $newTerm = wp_insert_term($term->name, $taxonomy, array(
                    'description' => $term->description,
                    'slug'        => $term->slug,
                    'parent'      => $term->parent
                ));

                if (!is_wp_error($newTerm)) {
                    $existTerms[] = $term->slug;
                }
            }
        }

        if (!empty($existTerms) && $r = wp_set_object_terms($postId, $existTerms, $taxonomy)) {
            $created = !is_wp_error($r);
        }

        return $created;
    }

    /**
     * Unzip the posts
     *
     * @since 1.1.0
     * @global \wpdb $wpdb
     *
     * @param string $pathToArchive Path to the archive
     * @param bool $replaceExists Whether to replace exists posts with the same name/slug. Default false.
     * @param string $customPostType Post type to be used if the transferred post type doesn't exist.
     * @return array Result array
     */
    public static function unzipPosts($pathToArchive, $replaceExists = false, $customPostType = '')
    {
        global $wpdb;

        $result = array('errors' => [], 'posts' => []);
        $zip = null;

        try {

            set_time_limit(10 * MINUTE_IN_SECONDS);

            if (!file_exists($pathToArchive)) {
                throw new \Exception(__('File not exists', 'zippy'));
            }

            $zip = new \ZipArchive();

            $res = $zip->open($pathToArchive);

            if ($res !== true) {
                throw new \Exception(
                    sprintf(__('Can not open zip archive. Error code: %s', 'zippy'), $res)
                );
            }

            $extractTo = WP_CONTENT_DIR . DIRECTORY_SEPARATOR;

            if ($zip->extractTo($extractTo, self::DATA_FILE)) {

                $content = file_get_contents($extractTo . self::DATA_FILE);

                if (file_exists($extractTo . self::DATA_FILE)) {
                    unlink($extractTo . self::DATA_FILE);
                }
            } else {
                throw new \Exception(__('Can not read zip archive content', 'zippy'));
            }

            if (!$content) {
                throw new \Exception(__('File is empty', 'zippy'));
            }

            $content = maybe_unserialize($content);

            if (empty($content)) {
                throw new \Exception(__('Incorrect data in the file', 'zippy'));
            }

            // back support of the version 1.0.X
            $postsData = isset($content['post']) ? [$content] : array_values($content);

            foreach ($postsData as $data) {

                /** @var \WP_Post $post */
                $post = $data['post'];

                $postType = empty($customPostType) ? (post_type_exists($post->post_type) ? $post->post_type : '') : $customPostType;

                // validate post type
                if (empty($postType)) {
                    $result['errors'][] = sprintf(__('Post type "%s" not found for the post "%s"', 'zippy'), esc_html($post->post_type), esc_html($post->post_title));
                    continue;
                }

                $archiveBaseUrl = $data['site_url'];

                // IMPORT POST ////////////////////////////////////////////////////////////////////////////////////////

                // post data
                $newPostData = array(
                    'post_name'      => $post->post_name,
                    'menu_order'     => (int) $post->menu_order,
                    'comment_status' => esc_attr($post->comment_status),
                    'post_content'   => self::replaceURLs($post->post_content, $archiveBaseUrl),
                    'post_excerpt'   => self::replaceURLs($post->post_excerpt, $archiveBaseUrl),
                    'post_mime_type' => $post->post_mime_type,
                    'post_password'  => $post->post_password,
                    'post_status'    => esc_attr($post->post_status),
                    'post_title'     => self::replaceURLs($post->post_title, $archiveBaseUrl),
                    'post_type'      => esc_attr($postType),
                    'post_date'      => esc_attr($post->post_date),
                    'guid'           => self::replaceURLs($post->guid, $archiveBaseUrl)
                );

                $matchedPost = false;

                $related = $wpdb->get_row($wpdb->prepare("SELECT ID, post_name, guid FROM $wpdb->posts WHERE post_name = '%s' AND post_type = '%s' AND post_status NOT IN ('inherit', 'revision') LIMIT 1", $post->post_name, $postType));
                if ($related && !is_wp_error($related)) {

                    if ($replaceExists) {

                        $matchedPost = get_post($related->ID);

                        if (is_a($matchedPost, 'WP_Post')) {
                            $newPostData['ID'] = $matchedPost->ID;
                            $newPostData['post_status'] = $matchedPost->post_status;
                        } else {
                            $matchedPost = false;
                        }

                    } else {

                        if ($related->post_name == $post->post_name) {
                            unset($newPostData['post_name']);
                        }

                        if ($related->guid == $post->guid) {
                            unset($newPostData['guid']);
                        }
                    }
                }

                // post author
                $authorId = 0;
                if (!empty($post->post_author)) {

                    /** @var \WP_User $author */
                    $author = $post->post_author;

                    $user = get_user_by('email', $author->user_email);
                    if (!$user) {
                        $user = get_user_by('login', $author->user_login);
                        if (!$user) {
                            $user = get_user_by('slug', $author->user_nicename);
                            if (!$user) {
                                $authorId = (int) $wpdb->get_var("SELECT u.ID FROM $wpdb->users as u WHERE (SELECT um.meta_value FROM $wpdb->usermeta as um WHERE um.user_id = u.ID AND um.meta_key = 'wp_user_level') >= 8 LIMIT 1");
                            } elseif ($matchedPost) {
                                $authorId = $matchedPost->post_author;
                            } else {
                                $authorId = $user->ID;
                            }
                        } else {
                            $authorId = $user->ID;
                        }
                    } else {
                        $authorId = $user->ID;
                    }

                    if ($authorId > 0) {
                        $newPostData['post_author'] = $authorId;
                    }
                }

                // post parent
                if ($post->post_parent > 0) {
                    $newPostData['post_parent'] = (int) $post->post_parent;
                }

                // save post
                $newPostData = apply_filters('zippy-unzip-post', $newPostData);

                if ($matchedPost) {
                    $postId = wp_update_post($newPostData);
                } else {
                    $postId = wp_insert_post($newPostData);
                }

                if (is_wp_error($postId) || $postId < 1) {
                    $result['errors'][] = sprintf(__('Can not unzip the post "%s"', 'zippy'), $newPostData['post_title']);
                    continue;
                }

                $result['posts'][] = (object) ['ID' => $postId, 'post_title' => $newPostData['post_title']];

                // IMPORT META ////////////////////////////////////////////////////////////////////////////////////////

                if (!empty($data['post_meta'])) {

                    // delete old meta
                    if ($matchedPost) {
                        $protectedMetaKeys = self::getProtectedMetaKeys();
                        foreach (get_post_meta($postId) as $metaKey => $value) {
                            if (!in_array($metaKey, $protectedMetaKeys)) {
                                delete_post_meta($postId, $metaKey);
                            }
                        }
                    }

                    // insert new meta
                    $meta = apply_filters('zippy-unzip-meta', stripslashes_deep($data['post_meta']));
                    foreach ($meta as $metaKey => $metaValue) {
                        update_post_meta($postId, $metaKey, self::replaceURLs(maybe_unserialize($metaValue), $archiveBaseUrl));
                    }
                }

                // IMPORT TAXONOMIES //////////////////////////////////////////////////////////////////////////////////

                if (!empty($data['post_taxonomies'])) {

                    // get taxonomies
                    $taxonomies = apply_filters('zippy-unzip-taxonomies', $data['post_taxonomies']);
                    $availableTaxonomies = get_object_taxonomies($postType);

                    // delete old terms
                    if ($matchedPost) {
                        wp_delete_object_term_relationships($postId, $availableTaxonomies);
                    }

                    // insert new terms
                    if (!empty($availableTaxonomies)) {
                        foreach ($taxonomies as $taxonomyName => $taxonomyData) {
                            if (in_array($taxonomyName, $availableTaxonomies)) {
                                self::createAndAssignTerms($postId, $taxonomyData, $taxonomyName);
                            }
                        }
                    }
                }

                // IMPORT ATTACHMENTS /////////////////////////////////////////////////////////////////////////////////

                $processedAttachments = [];

                if (!empty($data['attachments'])) {

                    require_once ABSPATH . 'wp-admin/includes/image.php';
                    require_once ABSPATH . 'wp-admin/includes/file.php';
                    require_once ABSPATH . 'wp-admin/includes/media.php';

                    $attachments = apply_filters('zippy-unzip-attachments', $data['attachments']);
                    $uploadsDir = self::fixPath(wp_upload_dir()['basedir']);

                    /** @var \WP_Post $attachment */
                    foreach ($attachments as $attachment) {

                        // extract file
                        $attachmentPath = $attachment->rurl;
                        $file = $uploadsDir . DIRECTORY_SEPARATOR . self::fixPath($attachmentPath);

                        if ($replaceExists || !file_exists($file)) {
                            $zip->extractTo($uploadsDir, $attachmentPath);
                        }

                        $newGuid = self::replaceURLs($attachment->guid, $archiveBaseUrl);

                        // try to find the attachment in the database
                        $attachmentId = 0;
                        $updateMeta = $replaceExists;
                        $matchedAttachmentId = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_date = '%s' AND guid = '%s'", $attachment->post_date, $newGuid));
                        if (!is_wp_error($matchedAttachmentId) && $matchedAttachmentId > 0) {
                            $attachmentId = $matchedAttachmentId;
                        } else {
                            $updateMeta = true;
                        }

                        // attachment not found. create a new one
                        if ($attachmentId == 0) {

                            $attachmentData = array_merge((array) $attachment, array(
                                'post_author' => $authorId,
                                'post_parent' => $postId,
                                'guid'        => $newGuid
                            ));

                            unset($attachmentData['ID'], $attachmentData['post_date_gmt'], $attachmentData['isFeaturedImage'], $attachmentData['comment_count']);

                            // insert attachment to WP posts
                            $attachmentId = wp_insert_post($attachmentData);
                            $attachmentId = is_wp_error($attachmentId) ? 0 : (int) $attachmentId;
                        }

                        // update attachment meta
                        if ($attachmentId > 0 && $updateMeta) {
                            update_attached_file($attachmentId, $attachment->rurl);
                            wp_update_attachment_metadata($attachmentId, wp_generate_attachment_metadata($attachmentId, get_attached_file($attachmentId)));
                        }

                        // set image as featured if needed
                        if ($attachmentId > 0 && !empty($attachment->isFeaturedImage)) {
                            set_post_thumbnail($postId, $attachmentId);
                        }

                        $processedAttachments[$attachment->ID] = $attachmentId;
                    }
                }

                // IMPORT IMAGES /////////////////////////////////////////////////////////////////////////////////

                if (!empty($data['images'])) {
                    $images = apply_filters('zippy-unzip-images', $data['images']);
                    foreach ($images as $image) {
                        $path = self::fixPath(wp_upload_dir()['basedir']);
                        if ($replaceExists || !file_exists($path . DIRECTORY_SEPARATOR . $image)) {
                            $zip->extractTo($path, $image);
                        }
                    }
                }

                // UPDATE POST META THAT REPRESENT IMAGES ///////////////////////////////////////////////////////

                if (!empty($data['pma'])) {
                    foreach ($data['pma'] as $metaKey => $attachmentId) {
                        if (isset($processedAttachments[$attachmentId])) {
                            update_post_meta($postId, $metaKey, $processedAttachments[$attachmentId]);
                        }
                    }
                }

                // FINALIZE /////////////////////////////////////////////////////////////////////////////////////

                clean_post_cache($postId);
            }

        } catch (\Exception $e) {
            $result['errors'] = [$e->getMessage()];
        }

        if ($zip !== null) {
            $zip->close();
        }

        return $result;
    }

    /**
     * Unzip the post
     *
     * @since 1.0.0
     * @deprecated use self::unzipPosts()
     *
     * @global \wpdb $wpdb
     * @param string $pathToArchive Path to the archive
     * @param bool $replaceExists Whether to replace exists post with the same name/slug. Default false.
     * @return array Result array
     */
    public static function unzipPost($pathToArchive, $replaceExists = false)
    {
        return self::unzipPosts($pathToArchive, $replaceExists);
    }

    /**
     * Customize the admin notice
     *
     * @since 1.0.0
     *
     * @param string|array $message Message text
     * @param string $type Message type
     */
    private function adminNotice($message, $type)
    {
        add_action('admin_notices', static function () use ($message, $type) {
            $messages = is_array($message) ? $message : [$message];
            ?>
            <div class="notice notice-<?php echo esc_attr($type); ?> is-dismissible">
                <?php foreach ($messages as $msg) { ?>
                    <p><?php echo $msg; ?></p>
                <?php } ?>
            </div>
            <?php
        });
    }

    /**
     * Add "unzip" link to the toolbar
     *
     * @since 1.0.0
     * @internal
     *
     * @param \WP_Admin_Bar $wp_admin_bar
     */
    public function adminBarMenu($wp_admin_bar)
    {
        $wp_admin_bar->add_node(array(
            'id'    => 'zippy',
            'href'  => '#TB_inline?width=400&height=280&inlineId=zippyModal',
            'title' => '<span class="unzippy">Zippy - unzip</span>'
        ));
    }

    /**
     * Design improvements
     * @since 1.0.0
     * @internal
     */
    public function adminHead()
    {
        echo '<style type="text/css">.unzippy:before { font-family: "dashicons"; content: "\\f504"; font-size: 20px; display: inline-block; vertical-align: middle; padding-right: 6px; color: rgba(240, 245, 250, 0.6); }</style>';
    }

    /**
     * Include scripts
     * @since 1.0.0
     * @internal
     */
    public function adminEnqueueScripts()
    {
        add_thickbox();
        wp_enqueue_script('zippy', plugin_dir_url(__FILE__) . 'zippy.js', ['jquery-ui-dialog'], '1.0', true);
    }

    /**
     * Add the dialogue to unzip the file
     * @since 1.0.0
     * @internal
     */
    public function adminFooter()
    {
        $pts = [
            '' => '-'
        ];

        foreach (get_post_types(['public' => true]) as $pt) {
            if ($pt !== 'attachment') {
                $pts[$pt] = sprintf(__('Change post type to "%s"', 'zippy'), get_post_type_object($pt)->label);
            }
        }

        $ptList = '';

        foreach ($pts as $key => $item) {
            $ptList .= '<option value="' . esc_attr($key) . '">' . esc_html($item) . '</option>';
        }

        echo '<div id="zippyModal" style="display: none;"><form action="" method="post" enctype="multipart/form-data" autocomplete="off">' .
             '<h3>' . __('Import the article', 'zippy') . '</h3>' .
             '<p><input type="file" name="zippyFile[]" multiple /></p>' .
             '<p><label for="zippyRepChk"><input type="checkbox" name="replaceExists" id="zippyRepChk" checked="checked" /> ' . __('Replace this post with the post which have the same name/slug.', 'zippy') . '</label></p>' .
             '<p><label for="zippyCustomPT">' . __('Force post(s) type to:', 'zippy') . '<br /><select name="customPT" id="zippyCustomPT">' . $ptList . '</select></label></p>' .
             '<input type="hidden" name="__action" value="zippy-unzip" />' .
             '<p><input type="submit" name="submit" class="button button-primary" value="' . __('Import', 'zippy') . '" /></p>' .
             '</form></div>';
    }

    /**
     * Load translations
     * @since 1.1.6
     * @internal
     */
    public function pluginsLoaded()
    {
        load_plugin_textdomain('zippy', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
}