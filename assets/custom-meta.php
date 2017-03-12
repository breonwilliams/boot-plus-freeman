<?php
/**
 * Custom functions
 */


// Add Slider Metabox //

add_action( 'add_meta_boxes', 'meta_box_slider' );
function meta_box_slider()
{                                      // --- Parameters: ---
    add_meta_box( 'slider-meta-box-id', // ID attribute of metabox
        'Full Width Section Below Header Shortcode',       // Title of metabox visible to user
        'meta_box_callback', // Function that prints box in wp-admin
        'page',              // Show box for posts, pages, custom, etc.
        'normal',            // Where on the page to show the box
        'low' );            // Priority of box in display order

    add_meta_box(
        'slider-meta-box-id', // ID attribute of metabox
        'Full Width Section Below Header Shortcode',       // Title of metabox visible to user
        'meta_box_callback', // Function that prints box in wp-admin
        'post',              // Show box for posts, pages, custom, etc.
        'normal',            // Where on the page to show the box
        'low' );            // Priority of box in display order
}

function meta_box_callback( $post )
{
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['meta_box_slider_embed'] ) ? $values['meta_box_slider_embed'][0] : '';
    $meta_box_slider_embed = get_post_meta( $post->ID, 'meta_box_slider_embed', true );

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="meta_box_slider_embed"><p>This will display below the header.</p></label>

        <?php wp_editor($meta_box_slider_embed, 'biography', array(
            'wpautop'               =>      true,
            'media_buttons' =>      false,
            'textarea_name' =>      'meta_box_slider_embed',
            'textarea_rows' =>      10
        )); ?>
    </p>
    <p>Leave this field Empty if you do not want to use a slider. Insert <strong>full_above_content_area();</strong> outside of fixed width container.</p>
    <?php
}

add_action( 'save_post', 'meta_box_slider_save' );
function meta_box_slider_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );

    // Probably a good idea to make sure your data is set

    if( isset( $_POST['meta_box_slider_embed'] ) && $_POST['meta_box_slider_embed'] != '' ) {
        update_post_meta( $post_id, 'meta_box_slider_embed', $_POST['meta_box_slider_embed'] );
    } else {
        delete_post_meta( $post_id, 'meta_box_slider_embed' );
    }

}



function full_above_content_area(){
    global $post;

    if(is_home() && get_option('page_for_posts') ) {
        $page_for_posts = get_option( 'page_for_posts' );
        $slider_content = wp_kses_post(get_post_meta($page_for_posts, 'meta_box_slider_embed', true));
        echo do_shortcode($slider_content);

    } else {
        if (is_page() || is_single()) {
            $slider_content = wp_kses_post(get_post_meta($post->ID, 'meta_box_slider_embed', true));
            echo do_shortcode($slider_content);
        }

    }


}






// Add Map Metabox //

add_action( 'add_meta_boxes', 'meta_box_map' );
function meta_box_map()
{                                      // --- Parameters: ---
    add_meta_box( 'map-meta-box-id', // ID attribute of metabox
        'Full Width Section Above Footer Shortcode',       // Title of metabox visible to user
        'meta_box_callback_map', // Function that prints box in wp-admin
        'page',              // Show box for posts, pages, custom, etc.
        'normal',            // Where on the page to show the box
        'low' );            // Priority of box in display order
    add_meta_box(
        'map-meta-box-id', // ID attribute of metabox
        'Full Width Section Above Footer Shortcode',       // Title of metabox visible to user
        'meta_box_callback_map', // Function that prints box in wp-admin
        'post',              // Show box for posts, pages, custom, etc.
        'normal',            // Where on the page to show the box
        'low' );            // Priority of box in display order
}

function meta_box_callback_map( $post )
{
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['meta_box_map_embed'] ) ? $values['meta_box_map_embed'][0] : '';
    $meta_box_map_embed = get_post_meta( $post->ID, 'meta_box_map_embed', true );

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="meta_box_map_embed"><p>This will display above the footer.</p></label>
        <?php wp_editor($meta_box_map_embed, 'mapp', array(
            'wpautop'               =>      true,
            'media_buttons' =>      false,
            'textarea_name' =>      'meta_box_map_embed',
            'textarea_rows' =>      10
        )); ?>
    </p>
    <p>Leave this field Empty if you do not want to use a map. Insert <strong>full_below_content_area();</strong> outside of fixed width container.</p>
    <?php
}

add_action( 'save_post', 'meta_box_map_save' );
function meta_box_map_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );

    // Probably a good idea to make sure your data is set

    if( isset( $_POST['meta_box_map_embed'] ) && $_POST['meta_box_map_embed'] != '' ) {
        update_post_meta( $post_id, 'meta_box_map_embed', $_POST['meta_box_map_embed'] );
    } else {
        delete_post_meta( $post_id, 'meta_box_map_embed' );
    }

}



function full_below_content_area(){
    global $post;

    if(is_home() && get_option('page_for_posts') ) {
        $page_for_posts = get_option( 'page_for_posts' );
        $map_content = wp_kses_post(get_post_meta($page_for_posts, 'meta_box_map_embed', true));
        echo do_shortcode($map_content);

    } else {

        if (is_page() || is_single()) {
            $map_content = wp_kses_post(get_post_meta($post->ID, 'meta_box_map_embed', true));
            echo do_shortcode($map_content);
        }

    }


}


// Custom Menu logo

function m3_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'm3_logo' ); // Add setting for logo uploader

    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'm3_logo', array(
        'label'    => __( 'Upload Custom Menu Logo', 'm3' ),
        'section'  => 'title_tagline',
        'settings' => 'm3_logo',
        'priority' => 35,
    ) ) );
}
add_action( 'customize_register', 'm3_customize_register' );