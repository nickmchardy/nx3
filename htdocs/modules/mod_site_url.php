<?php

/**
* nx3 Module: Site URL
* 
* Provides site URLs for all those that need it.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 08-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

// TODO: This probably will need tweaking once smarty has been fully implemented
$arr_content['SITE_URL'] = lookup_setting($db, 'nx3.global.siteurl');
foreach ($arr_content as $key => $value)
{
  $arr_content[$key] = str_replace('>#_SITE_URL_#<', $arr_content['SITE_URL'], $arr_content[$key]);
}

?>