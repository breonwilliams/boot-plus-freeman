<?php
/**
 * Custom functions
 */

if ( ! function_exists('list_recent_posts') ) {
    function list_recent_posts( $atts ){

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $category
        );

        $query = new WP_Query($args);

        $output .= '<ul class="media recent-posts '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<li id="post-' . get_the_ID() . '" class="media-listitem ' . implode(' ', get_post_class()) . '">';

                if ( has_post_thumbnail() ) {

                    $output .= '<a class="pull-left" href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                    $output .= '<div class="thumbnail">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'post_thumbnail', array('class' => 'img-responsive aligncenter'));
                    $output .= '</div>';
                    $output .= '</a>';

                } else {

                }

                if ( has_post_thumbnail() ) {

                    $output .= '<div class="media-content marginlft-90">';

                } else {
                    $output .= '<div class="media-content">';
                }

                $output .= '<div class="caption">';

                $output .= '<h4 class="media-heading"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h4>';

                $output .= get_the_excerpt();
                $output .= '</div>';

                $output .= '</div>';
                $output .= '<div class="clearfix"></div>';


                $output .= '</li>';

            endwhile;global $wp_query;
            $output .= '</ul>';
            $output .= '<div class="clearfix"></div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('list_recent_posts', 'list_recent_posts');

/*recent posts list end*/


/*recent posts carousel start*/

if ( ! function_exists('carousel_recent_posts') ) {
    function carousel_recent_posts( $atts ){
        wp_enqueue_script( 'slick-js' );
        wp_enqueue_script( 'slick-init' );
        wp_enqueue_style( 'slick-css' );
        wp_enqueue_style( 'slick-theme' );

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      8,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'column' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $column = $atts['column'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $category
        );

        $query = new WP_Query($args);

        $output .= '<div class="row '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<div id="post-' . get_the_ID() . '" class="'.$column.' ' . implode(' ', get_post_class()) . '">';

                $output .= '<div class="thumbnail">';

                if ( has_post_thumbnail() ) {

                    $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'post_thumbnail_lg', array('class' => 'img-responsive aligncenter'));
                    $output .= '</a>';

                } else {


                }

                $output .= '<div class="caption caption-fixedh">';

                $output .= '<h3 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h3>';

                $output .= get_the_excerpt();

                $output .= '</div>';
                $output .= '<div class="clearfix"></div>';


                $output .= '</div>';
                $output .= '</div>';

            endwhile;global $wp_query;
            $output .= '</div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );
            $output .= '<div class="clearfix"></div>';

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('carousel_recent_posts', 'carousel_recent_posts');



/*recent posts carousel end*/

/*recent posts thumb start*/
if ( ! function_exists('thumb_recent_posts') ) {
    function thumb_recent_posts( $atts ){
        wp_enqueue_style( 'masonry-css' );
        wp_enqueue_script( 'imagesLoaded-js' );
        wp_enqueue_script( 'masonry-min' );
        wp_enqueue_script( 'masonry-init' );

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'column' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $column = $atts['column'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $category
        );

        $query = new WP_Query($args);

        $output .= '<div class="row mgrid '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<div id="post-' . get_the_ID() . '" class="mgrid-item '.$column.' ' . implode(' ', get_post_class()) . '">';

                $output .= '<div class="thumbnail">';



                if ( has_post_thumbnail() ) {

                    $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'post_thumbnail_lg', array('class' => 'img-responsive aligncenter'));
                    $output .= '</a>';

                } else {


                }

                $output .= '<div class="caption padbot-30">';

                $output .= '<h3 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h3>';

                $output .= get_the_excerpt();

                $output .= '<div class="clearfix"></div>';
                $output .= '</div>';


                $output .= '</div>';
                $output .= '</div>';

            endwhile;global $wp_query;
            $output .= '</div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );
            $output .= '<div class="clearfix"></div>';

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('thumb_recent_posts', 'thumb_recent_posts');

/*recent posts thumb end*/

/* recent posts datatables */

add_shortcode( 'posts_datatables', 'posts_datatables' );
function posts_datatables( $atts ) {

    wp_enqueue_script( 'dataTables-init' );
    wp_enqueue_script( 'dataTables-min' );
    wp_enqueue_script( 'buttons-min' );
    wp_enqueue_script( 'colVis-js' );
    wp_enqueue_script( 'html5-js' );
    wp_enqueue_script( 'print-js' );
    wp_enqueue_script( 'databootstrap-js' );
    wp_enqueue_script( 'buttonsboot-js' );
    wp_enqueue_script( 'jszip-js' );
    wp_enqueue_script( 'pdfmake-js' );
    wp_enqueue_script( 'vfs_fonts-js' );
    wp_enqueue_script( 'responsive-js' );
    wp_enqueue_script( 'responsive-bootstrap' );
    wp_enqueue_style( 'dataTables-css' );
    wp_enqueue_style( 'dataTables-bootstrap' );
    wp_enqueue_style( 'dataTables-buttons' );
    wp_enqueue_style( 'dataTables-responsive' );
    wp_enqueue_script( 'moment-js' );
    wp_enqueue_script( 'datetime-js' );

    wp_enqueue_script( 'lity-js' );
    wp_enqueue_style( 'lity-css' );
    ob_start();
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'posts' => -1,
        'category' => '',
        'ptype' => '',
        'order'     =>  '',
        'orderby'   =>  '',
    ), $atts ) );


    // define query parameters based on attributes
    $options = array(
        'posts_per_page' => $posts,
        'post_type' => $ptype,
        'category_name' => $category,
        'order'             =>  $order,
        'orderby'           =>  $orderby,
    );
    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { ?>

        <table id="postsTable" class="table table-1 table-striped dt-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Post Date</th>
                <th>Title</th>
                <th>Summary</th>
            </tr>
            </thead>
            <tbody>


            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <tr>
                    <td scope="row">
                        <span><?php echo get_the_date('D, F jS, Y'); ?> </span>
                    </td>
                    <td scope="row">
                        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('%s', 'heels'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
                    </td>
                    <td>
                        <?php the_excerpt(); ?>
                    </td>
                </tr>
            <?php endwhile;
            wp_reset_postdata(); ?>


            </tbody>
        </table>
        <?php $myvariable = ob_get_clean();
        return $myvariable;
    }
}


/* related posts */

/* [relatedposts] // This is the default (3 posts, 3 columns)
[relatedposts col=1 max=1 excerpt=false] // single post, full width, without the excerpt */

add_shortcode('relatedposts', 'fphp_get_related_posts');

function fphp_get_related_posts($atts) {
    wp_enqueue_style( 'masonry-css' );
    wp_enqueue_script( 'imagesLoaded-js' );
    wp_enqueue_script( 'masonry-min' );
    wp_enqueue_script( 'masonry-init' );

    $atts = shortcode_atts( array(
        'ptype' => '',
        'max' => '3',
        'class' => '',
        'column' => '',
        'label' => '',
    ), $atts, 'relatedposts' );

    $class = $atts['class'];
    $column = $atts['column'];
    $label = $atts['label'];

    $reset_post = $post;

    global $post;
    $post_tags = wp_get_post_tags($post->ID);

    if ($post_tags) {
        $post_tag_ids = array();
        foreach($post_tags as $post_tag) $post_tag_ids[] = $post_tag->term_id;
        $args=array(
            'tag__in' => $post_tag_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => $atts['max'],
            'post_type'    =>  $atts["ptype"],
            'orderby' => 'rand'
        );

        $related_query = new wp_query( $args );
        if (intval($related_query->post_count) === 0) return '';

        $html = '<div class="relatedposts"><h3>'.$label.'</h3>';

        $html .= '<div class="row mgrid '.$class.'">';

        while( $related_query->have_posts() ) {
            $related_query->the_post();
            $html .= '<div id="post-' . get_the_ID() . '" class="mgrid-item '.$column.' ' . implode(' ', get_post_class()) . '">';

            $html .= '<div class="thumbnail">';

            if ( has_post_thumbnail() ) {

                $html .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                $html .= get_the_post_thumbnail( get_the_id(), 'post_thumbnail_lg', array('class' => 'img-responsive aligncenter'));
                $html .= '</a>';

            } else {


            }

            $html .= '<div class="caption caption-fixedh">';

            $html .= '<h3 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h3>';

            $html .= get_the_excerpt();

            $html .= '</div>';
            $html .= '<div class="clearfix"></div>';



            $html .= '</div>';
            $html .= '</div>';
        }
    }
    $post = $reset_post;
    wp_reset_query();

    $html .= '</div>';

    return $html;

}