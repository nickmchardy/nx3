<?php

/**
* nx3 System Module: Config
* 
* Configure database connectivity in this file.
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

function set_config()
{
  // DB TABLE PREFIX
  define("table_prefix", "core_");
   
  // DEBUG MODE
  // Set to true to enable debug mode
  $GLOBALS['NX3_DEBUG'] = false;

  // MAINTENANCE MODE
  // Set to true to disable the ENTIRE website (including admin functions)
  $GLOBALS['NX3_MAINTENANCE_MODE'] = false;
}

function db_connect()
{
  // Configure database connectivity below
  $dbhost = "localhost";
  $dbname = "changeme";
  $dbuser = "changeme";
  $dbpasswd = "changeme";
  
  // Connect to the database:
  $db = @new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
  
  if (mysqli_connect_errno()) 
  {
    fatal_error_handler (null, "Database Connect Failed - " .  mysqli_connect_error());
  }

  return $db;
}

?>