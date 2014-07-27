<?php

/**
* nx3 Common Module: Errors
* 
* Provides a number of error handlers to neatly log & handle errors and produces friendly error messages for the user.
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

function fatal_error_handler($db, $str_error_msg, $str_source = 'UNKNOWN')
{
  $errorfile = 'fatal_error.html';
  $maxfilesize = 100000;
  if (!file_exists($errorfile))
  {
    echo "NX3 Seriously Fatal Error: Could not open file '" . $errorfile . "' for reading.";
    exit();
  }
  else
  {
    $fp = fopen($errorfile, "r");
    $content = fread($fp, $maxfilesize);
    fclose($fp);
  }
  
  if ($db <> null)
  {
    // Log the fact that we've hit an error (if logging is available)
    if (function_exists('log_message'))
    {
      log_message($db, $str_source, 20, '### FATAL ERROR OCCURRED ' . $str_error_msg);
    }
    if (function_exists('log_usage'))
    {
      log_usage($db,
        $_SESSION['NX3_USER']['user_id'],
        isset($GLOBALS['NX3_PARAM_ARRAY'][0]) ? $GLOBALS['NX3_PARAM_ARRAY'][0] : null,
        isset($GLOBALS['NX3_PARAM_ARRAY'][1]) ? $GLOBALS['NX3_PARAM_ARRAY'][1] : null,
        null,
        isset($GLOBALS['NX3_DB_QUERY_COUNT']) ? $GLOBALS['NX3_DB_QUERY_COUNT'] : null,
        0,
        'FATAL',
        0,
        $str_error_msg);
    }

    // Close the database connection
    $db->close();
  }
  
  // Echo message to user
  $content = str_replace('>#_ERROR_MSG_#<', $str_error_msg, $content);
  // Echo debug info (TODO: might need to disable this later)
  $error_details = "GET: " . str_replace("\n", "<br />\n", print_r($_GET, true)) . "<br /><br />\n";
  $error_details = "GET: " . str_replace("\n", "<br />\n", print_r($_GET, true)) . "<br /><br />\n";
  $error_details .= "POST: " . str_replace("\n", "<br />\n", print_r($_POST, true)) . "<br /><br />\n";
  $error_details .= "SERVER: " . str_replace("\n", "<br />\n", print_r($_SERVER, true)) . "<br /><br />\n";
  $content = str_replace('>#_ERROR_DETAILS_#<', $error_details, $content);
  echo $content;
  exit();
}

function php_error_handler($errno, $errstr, $errfile, $errline)
{
  // Pass the PHP error over to the nx3 fatal error handler to make things appear neat. It's some sort of attempt at a pacifier, ok?
  fatal_error_handler(null, 'PHP Error # ' . $errno . ': ' . $errstr . ' in file ' . $errfile . ' on line ' . $errline . '.');
}

?>