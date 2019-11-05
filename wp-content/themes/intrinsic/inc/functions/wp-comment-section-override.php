<?php
/**
 * Move Comment Field To Bottom
 *
 * @package Intrinsic
 * @subpackage Comment Forms
 */
function intrinsic_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'intrinsic_move_comment_field_to_bottom' );

/**
 * Comment Form
 *
 * @package Intrinsic
 * @subpackage Comment Forms
 */
function intrinsic_comment_form($args) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );

	$args['fields'] = array(
      'author' =>
        '<div class="col-md-6 form-group"><label>'. esc_html__( 'Your Name', 'intrinsic' ) . ( $req ? '*' : '' ) .'</label><input id="name" class="form-control" name="author" required="required" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . ( $req ? " aria-required='true'" : '' ) . ' /></div>',

      'email' =>
        '<div class="col-md-6 form-group"><label>'. esc_html__( 'Your Email', 'intrinsic' ) . ( $req ? '*' : '' ) .'</label><input id="email" class="form-control" name="email" required="required" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
        '" size="30"' . ( $req ? " aria-required='true'" : '' ) . ' /></div>',

      'url' =>
        '<div class="col-md-12 form-group"><label>'. esc_html__( 'Got a Website?', 'intrinsic' ) .'</label><input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30"/></div>'
      );
	$args['id_form'] = "comment_form";
	$args['class_form'] = "row comment-form";
	$args['id_submit'] = "submit";
	$args['class_submit'] = "btn submit";
	$args['name_submit'] = "submit";
	$args['title_reply'] = wp_kses( __( '<span>Leave a Reply</span>', 'intrinsic' ), Intrinsic_Static::html_allow() );

	/* translators: %s: Extra words for comment title */
	$args['title_reply_to'] = wp_kses( __( 'Leave a Reply to %s', 'intrinsic' ), Intrinsic_Static::html_allow() );
	$args['cancel_reply_link'] = esc_html__( 'Cancel Reply', 'intrinsic' );
	$args['comment_notes_before'] = "";
	$args['comment_notes_after'] = "";
	$args['label_submit'] = esc_html__( 'Post Comment', 'intrinsic' );
	$args['comment_field'] = '<div class="col-md-12 form-group"><label>'. esc_html__( 'Your Comments', 'intrinsic' ) .'</label><textarea id="message" class="form-control" name="comment" aria-required="true" rows="8" cols="45"></textarea></div>';
	return $args;
}

add_filter('comment_form_defaults', 'intrinsic_comment_form');

/**
 * Comment Lists
 *
 * @package Intrinsic
 * @subpackage Comment Forms
 */
function intrinsic_comment_list($comment, $args, $depth) { 
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>

<<?php echo wp_kses_post( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
<?php endif; ?>
    <div class="comment-meta">
        <div class="comment-author vcard">
        	<?php if(get_avatar($comment, $size='60')) { ?>
            <div class="author-img">
                <?php echo get_avatar($comment, $size='60'); ?>	
            </div>
            <?php } ?>
        </div><!--/.comment-author-->
        <div class="comment-metadata">
        	<b class="author">
                <?php /* translators: %1$s: Comments Authors */ ?>
                <?php printf( esc_html__( ' %1$s ', 'intrinsic' ), get_comment_author_link() ); ?></b>
            <span class="date">
            	<?php
            	    /* translators: Comments date, edit link. */
            		printf( esc_html__('%1$s at %2$s','intrinsic'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( esc_html__( '(Edit)','intrinsic' ), '  ', '' );
            	?>
            </span>
        </div><!--/.comment-metadata-->
    </div><!--/.comment-meta-->
    <div class="comment-details">
        <div class="comment-content">
            <?php comment_text(); ?>
            <?php if ( $comment->comment_approved == '0' ) : ?>
            	<p><em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','intrinsic' ); ?></em></p>
            <?php endif; ?>
        </div><!--/.comment-content-->
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div><!-- /.comment-details-->
	<?php if ( 'div' != $args['style'] ) : ?>
	</div><!-- /.comment-body -->
	<?php endif; ?>
<?php }