<?php

/**
* nx3 Module: Header
* 
* Provides the page or content header.
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

  // Define page header
  if (defined("PAGE_HEADING"))
  {
    $arr_content["HEADING"] = constant("PAGE_HEADING");
  }
  else
  {
    $arr_content["HEADING"] = lookup_setting($db, 'nx3.header.defaultheading');
  }

?>
