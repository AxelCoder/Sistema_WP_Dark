<?php
/**
 * The template for displaying search form.
 *
 * @package Intrinsic
 * @since 1.0
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="searchform">
    <div class="input-group">
        <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search here &hellip;', 'intrinsic' ); ?>" class="form-control" required="required" value="<?php echo get_search_query(); ?>">
        <span class="input-group-append">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-search"></i>
            </button>
        </span> 
    </div>
</form>

