<?php
/**
 * WP REST API - filter fields
 *
 * @package             REST_Api_Filter_Fields
 * @author              Stephan van Rooij <wordpress@svrooij.nl
 * @license             MIT
 *
 * @wordpress-plugin
 * Plugin Name:         WP REST API - filter fields
 * Plugin URI:          https://github.com/svrooij/rest-api-filter-fields
 * Description:         Enables you to filter the fields returned by the api.
 * Version:             1.0.0
 * Author:              Stephan van Rooij
 * Author URI:          http://svrooij.nl
 * License:             MIT
 * License URI:         https://raw.githubusercontent.com/svrooij/rest-api-filter-fields/master/LICENSE
 */

add_action('rest_api_init','rest_api_filter_fields_init',20);
/**
 * Register the fields functionality for all posts.
 * Because of the 12 you can also use the filter functionality for custom posts
 */
function rest_api_filter_fields_init(){

  // Get all public post types, default includes 'post','page','attachment' and custom types added before 'init', 20
  $post_types = get_post_types(array('public' => true), 'objects');

  foreach ($post_types as $post_type) {

    //Test if this posttype should be shown in the rest api.
    $show_in_rest = ( isset( $post_type->show_in_rest ) && $post_type->show_in_rest ) ? true : false;
    if($show_in_rest) {

      // We need the postname to enable the filter.
      $post_type_name = $post_type->name;

      //die($post_type_name);

      // Add de filter. The api uses eg. 'rest_prepare_post' with 3 parameters.
      add_filter('rest_prepare_'.$post_type_name,'rest_api_filter_fields_magic',20,3);
    }

  }

  // Also enable filtering 'comments', 'taxonomies' and 'terms'
  add_filter('rest_prepare_comment','rest_api_filter_fields_magic',20,3);
  add_filter('rest_prepare_taxonomy','rest_api_filter_fields_magic',20,3);
  add_filter('rest_prepare_term','rest_api_filter_fields_magic',20,3);
}


/**
 * This is where the magic happends.
 *
 * @return object (Either the original or the object with the fields filtered)
 */
function rest_api_filter_fields_magic( $data, $post, $request ){
  // Get the parameter from the WP_REST_Request
  // This supports headers, GET/POST variables.
  // and returns 'null' when not exists
  $fields = $request->get_param('fields');
  if($fields){

    // Create a new array
    $filtered_data = array();

    // Explode the $fields parameter to an array.
    $filter = explode(',',$fields);

    // If the filter is empty return the original.
    if(empty($filter) || count($filter) == 0)
      return $data;


    // The original data is in $data object in the property data
    // Foreach property inside the data, check if the key is in the filter.
    foreach ($data->data as $key => $value) {
      // If the key is in the $filter array, add it to the $filtered_data
      if (in_array($key, $filter)) {
        $filtered_data[$key] = $value;
      }
    }

  }

  // return the filtered_data if it is set and got fields.
  return (isset($filtered_data) && count($filtered_data) > 0) ? $filtered_data : $data;

}

 ?>
