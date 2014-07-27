<?php

/**
* nx3 Common Module: Menu
* 
* Provides ability to provide secured menus to the user.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 24-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function get_menu($db, $str_menu_code)
{
  // Retrieve default menu called "MENU" and apply security
  $sql = 'SELECT mi.caption, mi.link, mi.order_by FROM @TABLE_PREFIX@nx3_menu_item mi
    JOIN @TABLE_PREFIX@nx3_menu m ON mi.menu_id = m.menu_id WHERE m.menu_code = ? AND mi.menu_item_id IN @MENU_ITEM_SECURITY@ ORDER BY 3';
  $result_menu = func_db_query($db, $sql, array("s", 'MENU'));
  $arr_menu_content = array();
  
  foreach ($result_menu as $row_id => $row_data)  
  {
    $arr_menu_content[] = array('menu_link' => str_replace('>#_SITE_URL_#<', lookup_setting($db, 'nx3.global.siteurl'), $row_data['link']),
                      'menu_caption' => $row_data['caption']);
  }
  
  return $arr_menu_content;
}

?>