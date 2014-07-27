<?php

/**
* nx3 Content Module: Search
* 
* Provide search results for terms that the user enters.
* @author Nick McHardy <nm@nisch.org>
* @version 1.1
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 09-Aug-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*  1.1     | 12-Jan-2010  | nisch       | Changed to support Apache Mod_Rewrite for nicer URLs
* ---------+--------------+-------------+----------------------------------------
*/

  function content_handler($db, $obj_user, $content, $action, $template)
  {
    if ($action == 'query')
    {
      define('PAGE_HEADING', 'Search Results');
    
      if (!isset($_POST['terms']))
      {
        return array();
      }
    
      // TODO: Remove the fixed link to articles in the SQL below...
    
      $result_search = func_db_query($db, "SELECT ss.search_subject_name AS subject_area, a.article_name AS item, 
        CONCAT('article/viewarticle/', a.article_code, '/') AS link, SUM(1) AS frequency
        FROM @TABLE_PREFIX@nx3_search_index s
        JOIN @TABLE_PREFIX@nx3_search_subject ss ON s.search_subject_id = ss.search_subject_id
        JOIN @TABLE_PREFIX@nx3_article a ON s.search_object_id = a.article_id
        WHERE s.search_value = ? AND a.article_folder_id IN @ARTICLE_FOLDER_SECURITY@
        GROUP BY ss.search_subject_name, s.search_object_id, a.article_name
        ORDER BY SUM(1) DESC", array("s", $_POST['terms']));
      
      $page_content = array();
      $result_count = count($result_search);
      if ($result_count == 0) $result_count = 1; // Simple divide by zero protection
      
      foreach($result_search as $row)
      {
        $page_content['content_search_results'][] = array('subject_area' => $row['subject_area']
          , 'frequency' => $row['frequency'] / $result_count * 100
          , 'link' => $row['link']
          , 'item'=> $row['item']);
      }
      
      return $page_content;
    }
    else
    {
      fatal_error_handler ($db, "Specified action is not valid.");   
    }
  }
 
?>