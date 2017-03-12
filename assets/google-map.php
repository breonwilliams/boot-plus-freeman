<?php


function enqueue_custom_scripts() {
    wp_register_script('googlemaps', ('https://maps.google.com/maps/api/js?sensor=false'), 'jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/*** Google Map ***/
function googleMapShortcode($atts, $content = null)
{
    wp_enqueue_script('googlemaps');
    extract(shortcode_atts(array("id" => 'myMap', "type" => 'road', "lat" => '42.0215229', "long" => '-83.2152544', "zoom" => '16', "title" => 'We are here', "width" => '100%', "height" => '300'), $atts));

    $mapType = '';
    if($type == "satellite")
        $mapType = "SATELLITE";
    else if($type == "terrain")
        $mapType = "TERRAIN";
    else if($type == "hybrid")
        $mapType = "HYBRID";
    else
        $mapType = "ROADMAP";

    echo '<!-- Google Map -->
        <script type="text/javascript">
        jQuery(document).ready(function($) {
          function initializeGoogleMap() {

              var myLatlng = new google.maps.LatLng('.$lat.','.$long.');
              var myOptions = {
                center: myLatlng,
                zoom: '.$zoom.',
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.'.$mapType.'
              };
              var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);

              var contentString = "'.$title.'";
              var infowindow = new google.maps.InfoWindow({
                  content: contentString
              });

              var marker = new google.maps.Marker({
                  position: myLatlng
              });

              google.maps.event.addListener(marker, "click", function() {
                  infowindow.open(map,marker);
              });

              marker.setMap(map);

          }
          initializeGoogleMap();

        });
        </script>';

    return '<div id="'.$id.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
}

add_shortcode('googlemap','googleMapShortcode');