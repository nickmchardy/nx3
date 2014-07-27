<?php

/**
* nx3 Module: Smilies
* 
* Replaces set snippets of text with images for smilies. eg :-) will be replaced with a smiley image.
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

  // Replace the elements in the CONTENT tag with a smiley image
  $result_smilies = func_db_query($db, "SELECT target, url FROM @TABLE_PREFIX@nx3_smiley WHERE enabled_yn = 'Y'", null);
  foreach ($result_smilies as $row_id => $row_data)
  {
    $arr_content['CONTENT'] = str_replace($row_data['target'], 
                                    '<img src="' . $row_data['url'] . '" align="absmiddle" \\>',
                                    $arr_content['CONTENT']);
  }
  
?>
