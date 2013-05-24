<?php

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
  $get = get_values();
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
    $get = get_values();
    if (
        ($_SERVER['PHP_SELF'] == '/wp-login.php')
        || ($_SERVER['PHP_SELF'] == '/admin')
        && (
          !isset($_GET[$get['key']]) 
          || ($_GET[$get['key']] != $get['value'])
        )
      ){
      // set 404 header and redirect to home site
      header("HTTP/1.1 404 File not found");
      header("location:". $get['url']);
    }
  }
}

block();

add_filter('login_url', 'add_key_to_url', 101, 2);
add_filter('logout_url', 'add_key_to_url', 101, 2);
add_filter('lostpassword_url', 'add_key_to_url', 101, 2);  
add_filter('register', 'add_key_to_url', 101, 2);