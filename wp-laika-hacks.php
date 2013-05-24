<?php

class WpLaikaHacks {
  /*
   * Settings
   */

  function get_values(){
    $get['key'] = 'access';
    $get['value'] = 'allow';
    $get['url'] = get_bloginfo('url') ."/error-404";
    return $get;
  }

  /**
   * Add key to wp-login url
   * @param mixed $url
   * @param string $redirect
   * @return
   */

  function add_key_to_url($url, $redirect='0'){
    $get = $this->get_values();
    if ($url)
      return add_query_arg($get['key'], $get['value'], $url);
  }

  /**
   * Block access to wp-login.php, wp-admin/
   * only for guest users
   */

  function block(){
    // block works  only for guest users
    if (!is_user_logged_in()){
      $get = $this->get_values();
      echo $get['key'];
      echo $get['value'];
      if ((($_SERVER['PHP_SELF'] == '/wp-login.php') || ($_SERVER['PHP_SELF'] == '/admin')) && (!isset($_GET[$get['key']]) || ($_GET[$get['key']] != $get['value']))){
        echo "qui";
        // set 404 header and redirect to home site
        header("HTTP/1.1 404 File not found");
        header("location:". $get['url']);
      }
    }
  }

  /**
   * Remove scripts version (js & css)
   * @param string $src
   * @return
   */
  function remove_ver_scripts($src){
    if ( strpos( $src, 'ver=' ) )
      $src = remove_query_arg( 'ver', $src );
    return $src;
  }

}

$WpLaikaHacks = new WpLaikaHacks();

/*
 * Call to actions and filters
 */

add_action('login_head', array($WpLaikaHacks, 'block'));
add_filter('logout_url', array($WpLaikaHacks, 'add_key_to_url'), 101, 2);
add_filter('lostpassword_url', array($WpLaikaHacks, 'add_key_to_url'), 101, 2);  
add_filter('register', array($WpLaikaHacks, 'add_key_to_url'), 101, 2);
add_filter( 'style_loader_src', array($WpLaikaHacks, 'remove_ver_scripts'), 102, 4 );
add_filter( 'script_loader_src', array($WpLaikaHacks, 'remove_ver_scripts'), 102, 4 ); 

// remove canonical redirect
remove_filter('template_redirect', 'redirect_canonical');

/*
 * Remove Wordpress meta info from header and feeds
 */

//Remove generator name and version from your Website pages and from the RSS feed.
add_filter('the_generator', create_function('', 'return "";'));
//Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_generator' ); 
//Remove the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wlwmanifest_link'); 
//Remove EditURI
remove_action('wp_head', 'rsd_link');
//Remove index link.
remove_action('wp_head', 'index_rel_link');
//Remove previous link.
remove_action('wp_head', 'parent_post_rel_link', 10, 0);      
//Remove start link.
remove_action('wp_head', 'start_post_rel_link', 10, 0);
//Remove relational links (previous and next) for the posts adjacent to the current post.
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
//Remove shortlink if it is defined.
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);