<?php

/**
* nx3 Module: Meta
* 
* Retrieves site-wide meta tages for search engines (description & keywords).
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

  // Retrieve META keywords 
  $arr_content["nx3_meta_description"] = lookup_setting($db, 'nx3.meta.description');
  $arr_content["nx3_meta_keywords"] = lookup_setting($db, 'nx3.meta.keywords');

?>
