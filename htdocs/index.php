<?php

/**
* nx3 System Module: Index
* 
* The big brain of the system. All requests go through this file.
* @author Nick McHardy <nm@nisch.org>
* @version 1.1
* @package nx3
*                       ___          ___          ___    
*                      /\__\        |\__\        /\  \  
*                     /::|  |       |:|  |      _\:\  \ 
*                    /:|:|  |       |:|  |     /\ \:\  \  
*                   /:/|:|  |__     |:|__|__  _\:\ \:\  \ 
*                  /:/ |:| /\__\____/::::\__\/\ \:\ \:\__\
*                  \/__|:|/:/  /\::::/~~/~   \:\ \:\/:/  / 
*                      |:/:/  /  ~~|:|~~|     \:\ \::/  / 
*                      |::/  /     |:|  |      \:\/:/  / 
*                      /:/  /      |:|  |       \::/  /  
*                      \/__/        \|__|        \/__/ 
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 24-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*  1.1     | 12-Jan-2010  | nisch       | Changed to support mod Rewrite nice URLs
* ---------+--------------+-------------+----------------------------------------
*/
  
  // Turn on gestapo error reporting
  error_reporting(E_ALL);
  
  // Start session
  session_start();
  
  // Set config
  include_once 'config.php';
  set_config();
  
  if ($GLOBALS['NX3_MAINTENANCE_MODE'])
  {
    // Display maintenance screen - this will lock ALL users out of the system
    $fp = fopen('maintenance_mode.html', "r");
    $content = fread($fp, 10000);
    fclose($fp);
    echo $content;
    exit();
  }
  
  // record page render time & database stats
  $starttime = microtime();
  $starttime = explode(" ", $starttime);
  $starttime = $starttime[1] + $starttime[0];
  $GLOBALS['NX3_DB_QUERY_COUNT'] = 0; // Count how many queries get executed using the frameworks func_db_query function
  $GLOBALS['NX3_DB_QUERY_LOG'] = array(); // Array to log each query executed
   
  // include common classes
  include_once 'common/com_errors.php';
  set_error_handler("php_error_handler", E_ALL);  // Configure custom error handler
   
  if(!@include_once '3rdparty/smarty/libs/Smarty.class.php') fatal_error_handler(null, "Count not include file 'smarty/libs/Smarty.class.php'.");
  if(!@include_once 'common/com_settings.php') fatal_error_handler(null, "Count not include file 'common/com_settings.php'.");
  if(!@include_once 'common/com_functions.php') fatal_error_handler(null, "Count not include file 'common/com_functions.php'.");
  if(!@include_once 'common/com_log.php') fatal_error_handler(null, "Count not include file 'common/com_log.php'.");
  if(!@include_once 'common/com_auth.php') fatal_error_handler(null, "Count not include file 'common/com_auth.php'.");
  if(!@include_once 'common/com_menu.php') fatal_error_handler(null, "Count not include file 'common/com_menu.php'.");
  if(!@include_once 'common/com_rss.php') fatal_error_handler(null, "Count not include file 'common/com_rss.php'.");

  /******************************************************************************/

  // Setup connection to database
  $db = db_connect();
  
  // Remove quotes if evil evil magic quotes are enabled
  if (get_magic_quotes_gpc())
  {
    $_POST = com_stripslashes($_POST);
    $_GET = com_stripslashes($_GET);
    $_SERVER = com_stripslashes($_SERVER);
    $_COOKIE = com_stripslashes($_COOKIE);
  }
   
  // Initialise Logging System
  log_init($db);
  log_message($db, __FILE__, 5, '### Start of request ###');
  log_message($db, __FILE__, 4, 'GET: ' . print_r($_GET, true)); // Dump contents of GET array
  log_message($db, __FILE__, 1, 'POST: ' . print_r($_POST, true)); // Dump contents of POST array
  $int_content_length = 0;

  $dirname = dirname($_SERVER['PHP_SELF']);
  if (substr($dirname, strlen($dirname) - 1, 1) == "/" || substr($dirname, strlen($dirname) - 1, 1) == "\\")
    $dirname = substr($dirname, 0, strlen($dirname) - 2);
  
  if (!stristr('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], lookup_setting($db, 'nx3.global.siteurl'))
    || 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == lookup_setting($db, 'nx3.global.siteurl'))
  {
    // Empty request (eg no module specified), or incorrect URL used (eg, IP address, subdomain, etc.) go to default module
    $c = 'default';
    $a = null;
    $t = null;
    $GLOBALS['NX3_PARAM_ARRAY'] = array($c);
  }
  else
  {
    // Populate values
	  // Retrieve parameters from URL request
	  $url_request = $_SERVER['REDIRECT_QUERY_STRING'];
	  $url_request = split('/', $url_request); // Split by / character
	  array_shift($url_request); // Remove first element

    $c = $url_request[0];
    $a = (isset($url_request[1])) ? $url_request[1] : '';
    $t = null;
    $GLOBALS['NX3_PARAM_ARRAY'] = $url_request;
    // TODO: fix template value 't'
  }

  // protect against possibly harmful parameters
  if (!func_check_parameter($c, $a, $t))
  {
    fatal_error_handler (null, "Content, Action or Template parameters were invalid or contain illegal characters. Nasty!");
  }
  
  // Retrieve $_SESSION['NX3_USER'] if it exists  
  if (isset($_SESSION['NX3_USER']) && $_SESSION['NX3_USER'] != null)
  {
    log_message($db, __FILE__, 4, 'Found user profile, user_id = ' . $_SESSION['NX3_USER']['user_id']);
  }
  else
  {
    // Log user in as special guest account
    auth_retrieve_user_properties($db, (int) lookup_setting($db, 'nx3.global.guestuserid'));
    $_SESSION['NX3_AUTHENTICATED'] = 'N';
    log_message($db, __FILE__, 4, 'User not logged in, using GUEST account, user_id = ' . $_SESSION['NX3_USER']['user_id']);
  }
  
  // Update user profile for last_active field
  auth_update_last_active($db);
  
  // Retrieve details of requested module from the db
  $result_content_module = func_db_query($db, "SELECT module_file, enabled_yn, module_type, module_code, template_file FROM @TABLE_PREFIX@nx3_module WHERE module_code = ? AND module_type IN ('CONTENT', 'SCRIPT') LIMIT 1"
                                         , array("s", $c));

  if ($result_content_module == null)
  {
    fatal_error_handler ($db, "Requested module '" . $c . "' does not exist.");
  }
  
  $content_module_file = $result_content_module[0]['module_file'];
  $content_template_file = $result_content_module[0]['template_file'];
  $module_enabled_yn = $result_content_module[0]['enabled_yn'];
  $module_type = $result_content_module[0]['module_type'];
  $module_code = $result_content_module[0]['module_code'];

  // Perform content module checks
  if ($module_enabled_yn != 'Y') // Check if module is enabled
  {
    fatal_error_handler ($db, "Requested module '" . $c . "' is disabled.");
  } 
  if (!file_exists($content_module_file))
  {
    fatal_error_handler ($db, "Could not find content module file '" . $content_module_file . "'.");
  }
 
  // Check if requested content is CONTENT or SCRIPT style module
  if ($module_type == 'SCRIPT')
  {
    // Requested Content Module is of type SCRIPT (non-html output)

    // Attempt to load requested Content Module File
    log_message($db, __FILE__, 3, 'Invoking script module "' . $content_module_file .'"');
    include $content_module_file;
    $content = script_handler($db, $_SESSION['NX3_USER'], $c, $a, $content_template_file);
    $int_content_length = strlen($content);
    echo $content;
  }
  else
  {
    // Requested Content Module is of type CONTENT (html output)
    // Create content array
    $arr_content = array();
    $template_file = lookup_setting($db, 'nx3.template.default');
    $smarty = new Smarty;
    
    // Configure Smarty settings
    $smarty->template_dir = lookup_setting($db, 'smarty.template.location');
    $smarty->compile_dir = lookup_setting($db, 'smarty.compile.location');
    $smarty->config_dir = lookup_setting($db, 'smarty.config.location');
    $smarty->compile_check = $GLOBALS['NX3_DEBUG']; // Only compile if NX3 debug mode is enabled

    // Check if specified template exists / was specified correctly
    if ($content_template_file == '')
    {
      fatal_error_handler ($db, "Content module template file was not specified and is required in the module configuration table.");
    }
    
    if (!file_exists($smarty->template_dir . '/' . $content_template_file))
    {
      fatal_error_handler ($db, "Could not find content module template file '" . $content_template_file . "'.");
    }
    
    // Run query to obtain list of enabled pre-processing persistent modules
    $result_pre_modules = func_db_query($db, "SELECT module_code, module_name, module_description, enabled_yn, module_type, custom_yn, module_file, module_order "
                        . "FROM @TABLE_PREFIX@nx3_module WHERE module_type IN ('PRE') AND enabled_yn = 'Y' ORDER BY module_order", null);
    foreach ($result_pre_modules as $row_id => $row_data)
    {
      if (file_exists($row_data['module_file']))
      {
        include $row_data['module_file'];
      }
      else
      {
        fatal_error_handler ($db, "Source file for enabled module '" . $row_data['module_code'] . "' does not exist.");
      }
    }

    // Custom hook for pre-content-module processing
    $custom_pre_file = lookup_setting($db, 'nx3.custompre.location');
    if (file_exists($custom_pre_file))
      include $custom_pre_file;
    
    if (auth_can_access_module($db, $module_code))
    {
      // Attempt to load requested Content Module File & execute content_handler procedure
      log_message($db, __FILE__, 3, 'Invoking content module "' . $content_module_file .'"');
      include $content_module_file;   
      $arr_content = array_merge($arr_content, content_handler($db, $_SESSION['NX3_USER'], $c, $a, $t));
      
      // Process content array from module with smarty
      $arr_content["nx3_content_template_file"] = $content_template_file;
    }
    else
    {
      $arr_content["nx3_module_access_denied"] = true;
      $arr_content["nx3_module_code"] = $module_code;
    }    
  
    // Run query to obtain list of enabled post-processing persistent modules  
    $result_post_modules = func_db_query($db, "SELECT module_code, module_name, module_description, enabled_yn, module_type, custom_yn, module_file, module_order " 
                         . "FROM @TABLE_PREFIX@nx3_module WHERE module_type IN ('POST') AND enabled_yn = 'Y' ORDER BY module_order", null);
    foreach ($result_post_modules as $row_id => $row_data)
    {
      if (file_exists($row_data['module_file']))
      {
        include $row_data['module_file'];
      }
      else
      {
        fatal_error_handler ($db, "Requested module '" . $row_data['module_code'] . "' does not exist.");
      }
    }
  
    // Add Self Target for modules which post back to themselves and need to maintain GET parameters
    $arr_content["nx3_self_target"] = lookup_setting($db, 'nx3.global.siteurl') . implode('/', $GLOBALS['NX3_PARAM_ARRAY']);
    
    // Add other handy variables to content array to allow templates to use them
    $arr_content["nx3_content"] = $c;
    $arr_content["nx3_action"] = $a;
    $arr_content["nx3_template"] = $t;
    $arr_content["nx3_postback"] = lookup_setting($db, 'nx3.global.siteurl') . $c . '/';
  
    // Replace tags in template array (which have been loaded from PRE, CONTENT & POST modules) with content
    foreach ($arr_content as $key => $value)
    {
      $smarty->assign($key, $value);
    }

    // Custom hook for post-content-module processing
    $custom_post_file = lookup_setting($db, 'nx3.custompost.location');
    if (file_exists($custom_post_file))
      include $custom_post_file;
      
    // Display the layout with content et al inserted to the browser:
    $content_data = $smarty->fetch($template_file);
    echo $content_data;
    $int_content_length = strlen($content_data);
  }  

  // Calculate the render time  
  $endtime = microtime();
  $endtime = explode(" ", $endtime);
  $endtime = $endtime[1] + $endtime[0];
  $int_render_time = round($endtime - $starttime, 5);
  
  if ($module_type != 'SCRIPT' && $GLOBALS['NX3_DEBUG'])
  {
    // Display debug info if the content type is text/html
    echo "\n<!-- This page was rendered by nx3 in $int_render_time seconds.-->";
    echo "\n<!-- " . $GLOBALS['NX3_DB_QUERY_COUNT'] . " queries were executed to render the page.-->";
    echo "\n<!--" . print_r($GLOBALS['NX3_DB_QUERY_LOG'], true). "\n-->";
  }
  
  log_message($db, __FILE__, 5, '### End of request (Render time = ' . $int_render_time . 's, Queries = ' . $GLOBALS['NX3_DB_QUERY_COUNT'] . ') ###');
  
  // Log usage for reporting (if enabled)
  log_usage($db, $_SESSION['NX3_USER']['user_id'], $c, $a, $t, $GLOBALS['NX3_DB_QUERY_COUNT'], round($int_render_time * 1000, 0), 'INFO', $int_content_length, null);
 
  // close the database connection
  $db->close();
 
  // That's it, we're all done folks. Until next time, have a good one.
?>