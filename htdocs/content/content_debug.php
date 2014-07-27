<?php

/**
* nx3 Content Module: Debug
* 
* Description.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 11-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

  function content_handler($db, $obj_user, $content, $action, $template)
  {
    define("PAGE_HEADING", 'Debug Module');

    return array('content_debug_server' => "SERVER: " . str_replace("\n", "<br />\n", print_r($_SERVER, true))
      , 'content_debug_get' => "GET: " . str_replace("\n", "<br />\n", print_r($_GET, true))
      , 'content_debug_post' => "POST: " . str_replace("\n", "<br />\n", print_r($_POST, true)));
  }
 
?>