<?php
/*
 * This library provides some class definitions that are intended to make the use
 * of custom post types easier, particularly where you are defining lots of post types.
 * and/or relating post types together. It provides a number of functions that I use
 * often when using custom post types.
 * 
 * The first class is generic and provides static functions for accessing posts from
 * a post type. You need to pass the post type to each method call.  e.g.
 *
 *    Oikos_Post_Type::get_all('my_post_type');
 *
 * The second class is a "template" that should be further extended for each post type.
 * It extends the first class by adding:
 *    private static $post_type
 * and passing it to each of the parent class's methods.  In theory you could call:
 *    
 *    Oikos_Post_Type_Template::get_all();
 *
 * but it wouldn't do anything because the $post_type isn't set.
 *
 * To extend Oikos_Post_Type_Template for a given post type all you have to do is:
 *
 *   class My_Post_Type extends Oikos_Post_Type_Template {
 *      static $post_type = 'my_post_type';
 *   }
 *
 * Once you've done that you have a globally-accessible static class that provides all
 * the methods from Oikos_Post_Type, but specific to your post type.
 *
 * It's also possible (and encouraged) to add more type-specific functions to your
 * type-specific classes.  For example, if your post-type has some meta data, you can
 * add methods for getting and setting that meta data, or a method for getting posts
 * based on the meta-data value.  For example:
 *
 *   Oikos_Events::get_events_by_date( $this_date );
 *
 */
 
class Oikos_Post_Type {
	
    /*
     * This function gets the specified post. Decided not to sanity check the type so you
     * can call this for any id of any post of any type.
     *
     * Parameters:
     *   $id - ID of the post to get.
     *
     * Notes:
     *   None.
     */
	public static function get( $id ) {
		return get_post( $id );
	}
	 
	/*
	 * This function gets all posts of the type..
	 * 
	 * Parameters:
	 *   $options - used to pass options to the WP_Query - can be used for ordering and so on.
	 * 
	 * Notes:
	 *   By default the list is ordered alphabetically by title.
	 */
	public static function get_all( $post_type, $options = array() ) {
		
		$result = array();
			
		$query_args = array (
								'post_type' => $post_type,
								'posts_per_page' => -1,
								'orderby' => 'title',
								'order' => 'ASC'
							);
		if (is_array( $options )) {
			$query_args = array_merge( $query_args, $options );
			$result = get_posts( $query_args );
		}
		return $result; 			
	}

	/*
	 * This function gets all posts of the type in chronological order (most recent first)
	 * 
	 * Parameters:
	 *   $options - used to pass options to the WP_Query - can be used for ordering and so on.
	 * 
	 * Notes:
	 */
	public static function get_recent( $post_type, $options = array() ) {
		
		$result = array();
			
		$query_args = array (
								'post_type' => $post_type,
								'posts_per_page' => -1,
							);
		if (is_array( $options )) {
			$query_args = array_merge( $query_args, $options );
			$result = get_posts( $query_args );
		}
		return $result; 			
	}
	/*
	 * This function gets a list of all id's and titles from the type.
	 * Useful if you're constructing a drop-down.
	 * 
	 * Parameters:
	 *   $options - used to pass options to the WP_Query - can be used for ordering and so on.
	 *   $no_value_label - if you're generating a list for the user to select from and you want
	 *                     a "no value" option then add this - it will be used as a label for the
	 *                     value 0
	 * 
	 * Notes:
	 *   By default the list is ordered alphabetically by title.
	 */
	public static function get_list( $post_type, $options=array(), $no_value_label='' ) {
		$list = array();
		
		if ($no_value_label != '') {
			$list[0] = $no_value_label;
		}
		
		$posts = self::get_all( $post_type, $options );
		foreach ($posts as $this_post) {
			$list[$this_post->ID] = $this_post->post_title;
		}
		return $list;
	}

	/*
	 * This function gets an array of post objects that match a key-value meta data pair,
	 * or that is present in a list.
	 * 
	 * Parameters:
	 *   $meta_key - the meta data field to match
	 *   $meta_value - the meta data value to match - if this is an array an "IN" query will be used
	 *   $options - used to pass other options to the WP_Query - can be used for ordering and so on.
	 * 
	 * Notes:
	 *   By default the list is ordered alphabetically by title.
	 */
	public static function get_posts_by_meta( $post_type, $meta_key="", $meta_value="", $options=array() ) {
		
		$meta_query = array(
						array(
								'key' => $meta_key,
								'value' => $meta_value,
								'compare' => is_array($meta_value) ? 'IN' : '=' 
							));
							
		$query_args = array (
								'post_type' => $post_type,
								'posts_per_page' => -1,
								'orderby' => 'title',
								'order' => 'ASC',
								'meta_query' => $meta_query
							);
		$query_args = array_merge( $query_args, $options );
		$posts = get_posts($query_args);
		return $posts;
	}

	/*
	 * This function gets an array of post objects that match a meta-query (as defined in the WP_Query
	 * documentation).
	 * 
	 * Parameters:
	 *   $meta_query - the meta data field to match
	 *   $options - used to pass other options to the WP_Query - can be used for ordering and so on.
	 * 
	 * Notes:
	 *   By default the list is ordered alphabetically by title.
	 */
	public static function get_posts_by_meta_query( $post_type, $meta_query, $options=array() ) {
									
		$query_args = array (
								'post_type' => $post_type,
								'posts_per_page' => -1,
								'orderby' => 'title',
								'order' => 'ASC',
								'meta_query' => $meta_query
							);
		$query_args = array_merge( $query_args, $options );
		$posts = get_posts($query_args);
		return $posts;
	}

}


class Oikos_Post_Type_Template {
	
	private static $post_type;
		
	public static function get( $id ) {
		return Oikos_Post_Type::get( $id );
	}
	public static function get_all( $options=array() ) {
		return Oikos_Post_Type::get_all( static::$post_type, $options );
	}
	public static function get_recent( $options=array() ) {
		return Oikos_Post_Type::get_recent( static::$post_type, $options );
	}
	public static function get_list( $options=array(), $no_value_label='' ) {
		return Oikos_Post_Type::get_list( static::$post_type, $options, $no_value_label );
	}
	public static function get_posts_by_meta( $meta_key='', $meta_value='', $options=array() ) {
		return Oikos_Post_Type::get_posts_by_meta( static::$post_type, $meta_key, $meta_value, $options);
	}
	public static function get_posts_by_meta_query( $meta_query, $options=array() ) {
		return Oikos_Post_Type::get_posts_by_meta_query( static::$post_type, $meta_query, $options);
	}
	
}