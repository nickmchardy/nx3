<?php

/**
* nx3 Module: Footer
* 
* Provides a copyright or disclaimer piece of text for the footer.
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

  // Define footer
  $arr_content["FOOTER"] = lookup_setting($db, "nx3.footer.text");

?>