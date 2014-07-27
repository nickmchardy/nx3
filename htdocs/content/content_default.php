<?php

/**
* nx3 Content Module: Default
* 
* Description.
* @author Nick McHardy <nm@nisch.org>
* @version 1.1
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 11-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*  1.1     | 12-Jan-2010  | nisch       | Changed to support Apache Mod_Rewrite for nicer URLs.
*          |              |             | Changed to use setting for URL rather than specific module.
* ---------+--------------+-------------+----------------------------------------
*/

  function content_handler($db, $obj_user, $content, $action, $template)
  {
    // Redirect user to default content module
    // Default module - based on setting "nx3.global.siteurl" and "nx3.default.url"
    header('Location: ' . lookup_setting($db, 'nx3.global.siteurl') . lookup_setting($db, "nx3.default.url"));
    $db->close();
    exit();
  }
  
?>