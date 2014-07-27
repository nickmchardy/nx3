<?php

/**
* nx3 Content Module: Admin Article Editor
* 
* Admin module to view & edit articles.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 13-Jan-2010  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "view" || $action == "")
  {
    define("PAGE_HEADING", "Admin - View Articles");
    return action_default($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  // Display all rows
  $db_result = func_db_query($db, "SELECT af.article_folder_name, af.article_folder_code, a.article_code, a.article_name, a.hidden_yn, a.view_count, a.deleted_yn,
    (SELECT COUNT(1) FROM @TABLE_PREFIX@nx3_article_attachment aa WHERE a.article_id = aa.article_id) AS attachment_count,
    (SELECT COUNT(1) FROM @TABLE_PREFIX@nx3_article_comment ac WHERE a.article_id = ac.article_id) AS comment_count
    FROM @TABLE_PREFIX@nx3_article a
    JOIN @TABLE_PREFIX@nx3_article_folder af ON a.article_folder_id = af.article_folder_id
    ORDER BY 1, 4", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_articles'][] = array(
      'article_folder_name' => $row_data['article_folder_name'],
      'article_folder_code' => $row_data['article_folder_code'],
      'article_code' => $row_data['article_code'], 
      'article_name' => $row_data['article_name'],
      'hidden_yn' => $row_data['hidden_yn'],
      'view_count' => $row_data['view_count'],
      'deleted_yn' => $row_data['deleted_yn'],
      'attachment_count' => $row_data['attachment_count'],
      'comment_count' => $row_data['comment_count']
      );
  }
  
  return $page_content;
}

?>