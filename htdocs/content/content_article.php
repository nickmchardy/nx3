<?php



/**

* nx3 Content Module: Article

* 

* Provides the ability to view articles, article folders and article comments.

* @author Nick McHardy <nm@nisch.org>

* @version 1.1

* @package nx3

*

* MODIFICATION HISTORY

* ---------+--------------+-------------+----------------------------------------

*  Version | Date         | Author      | Notes

* ---------+--------------+-------------+----------------------------------------

*  1.0     | 11-Jun-2009  | nisch       | Initial Version

* ---------+--------------+-------------+----------------------------------------

*  1.1     | 02-Jan-2009  | nisch       | Removed Article Folder from page title when viewing article

* ---------+--------------+-------------+----------------------------------------

*/



function content_handler($db, $obj_user, $content, $action, $template)

{

  if ($action == "")

  {

    return action_browsefolder($db, $obj_user, 'ARTICLES');

  }

  else if ($action == "browsefolder")

  {

    return action_browsefolder($db, $obj_user, $GLOBALS['NX3_PARAM_ARRAY'][2]);

  }  

  else if ($action == "viewarticle")

  {

    return action_viewarticle($db, $obj_user, $GLOBALS['NX3_PARAM_ARRAY'][2]);

  }

  else if ($action == "viewtoparticles")

  {

    return action_viewtoparticles($db, $obj_user, 

     (isset($GLOBALS['NX3_PARAM_ARRAY'][2])) ? $GLOBALS['NX3_PARAM_ARRAY'][2] : null, 

     (isset($GLOBALS['NX3_PARAM_ARRAY'][3])) ? $GLOBALS['NX3_PARAM_ARRAY'][3] : null);

  }

  else if ($action == "submitcomment")

  {

    return action_submitcomment($db, $obj_user);

  }

  else

  {

    fatal_error_handler ($db, "Specified action is not valid.");

  }

}



function action_viewtoparticles($db, $obj_user, $get_folder_code, $get_start_at)

{

  if ($get_folder_code == '')

  {

    return array('content_article_error', 'folder_not_specified');

  }

  else

  {

    if ($get_start_at == '' || !ISSET($get_start_at))

    {

      $get_start_at = 0;

    }

    $page_content = array();

    

    // Fetch Folder. Also check if user is able to access Folder (apply security).

    $result_article_details = func_db_query($db, 'SELECT f.article_folder_id, f.article_folder_name, f.deleted_yn, f.show_top_articles

      FROM @TABLE_PREFIX@nx3_article_folder f WHERE f.article_folder_code = ? AND f.article_folder_id IN @ARTICLE_FOLDER_SECURITY@', array("s", $get_folder_code));

   

    // Perform checks of result set

    if (!isset($result_article_details[0]))

    {

      return array('content_article_error' => 'folder_not_found', 'content_article_folder_code' => $get_folder_code);

    }



    $article_folder_id = $result_article_details[0]['article_folder_id'];

    $article_folder_name = $result_article_details[0]['article_folder_name'];

    $article_folder_deleted_yn = $result_article_details[0]['deleted_yn'];

    $article_folder_show_top_articles = $result_article_details[0]['show_top_articles'];

    define('PAGE_HEADING', 'Viewing ' . $article_folder_name);

    

    if ($article_folder_deleted_yn == 'Y')

    {

      return array('content_article_error' => 'folder_deleted', 'content_article_folder_code' => $get_folder_code);

    }

    

    $result_articles = func_db_query($db, "SELECT a.article_id, a.article_code, a.article_name, a.deleted_yn, a.created_date, u.display_name,

      (SELECT COUNT(1) FROM @TABLE_PREFIX@nx3_article_comment ac WHERE ac.article_id = a.article_id) AS comment_count

      FROM @TABLE_PREFIX@nx3_article a JOIN @TABLE_PREFIX@nx3_user u ON a.created_by = u.user_id

      WHERE a.article_folder_id = ? AND a.article_folder_id IN @ARTICLE_FOLDER_SECURITY@

      AND a.deleted_yn = 'N' ORDER BY a.created_date DESC LIMIT ?, ?", array("sii", $article_folder_id, $get_start_at, $article_folder_show_top_articles));

    $page_content['content_article_list'] = array();

    

    foreach ($result_articles as $row_id => $row_data)

    {

      $page_content['content_article_list'][] = array('content_article_code' => $row_data['article_code']

        , 'content_article_name' => $row_data['article_name']

        , 'content_article_created_by' => $row_data['display_name']

        , 'content_article_created_date' => func_compare_date_to_now($row_data['created_date'])

        , 'content_article_comment_count' => $row_data['comment_count']

        );

    }

    

    // "Prev" and "Next" article navigation links 

    $page_content['content_article_prev_start_at'] = $get_start_at - $article_folder_show_top_articles;

    $page_content['content_article_next_start_at'] = $get_start_at + $article_folder_show_top_articles;

    $page_content['content_article_events_to_show'] = $article_folder_show_top_articles;

    $page_content['content_article_folder_code'] = $get_folder_code;

    

    return $page_content;

  }

}



function action_viewarticle($db, $obj_user, $get_article_code)

{

  if ($get_article_code == '')

  {

    return array('content_article_error' => 'article_not_specified', 'content_article_code' => $get_article_code);

  }

  else

  {

    // Fetch article. Also check if user is able to access article (apply security).

    $result_article_details = func_db_query($db, 'SELECT a.article_id, a.article_code, a.article_name, a.deleted_yn, a.view_count, a.allow_comments_yn, a.image_res_id, f.article_folder_name, a.attribute2

      FROM @TABLE_PREFIX@nx3_article a JOIN @TABLE_PREFIX@nx3_article_folder f ON a.article_folder_id = f.article_folder_id

      WHERE a.article_code = ? AND a.article_folder_id IN @ARTICLE_FOLDER_SECURITY@', array("s", $get_article_code));



    if (!isset($result_article_details[0]))

    {

      return array('content_article_error' => 'article_not_found', 'content_article_code' => $get_article_code);

    }


    $node_id = $result_article_details[0]['attribute2'];
    header('Location: http://nisch.org/d7/node/' . $node_id);
  }   

}



function action_submitcomment($db, $obj_user)

{

  $comment = strip_tags($_POST['comment_text']);

  $article_id = strip_tags($_POST['article_id']);

  $article_code = strip_tags($_POST['article_code']);

     

  if (auth_current_user_is_guest($db))

  {

    // Guest users

  

    // Anti-spam key validation

    $key = strip_tags($_POST['key']);

    $name = strip_tags($_POST['name']);

    $anti_spam_key = lookup_setting($db, 'nx3.global.antispamkey');

    

    if ($key != $anti_spam_key)

    {

      return array('content_article_error' => 'spam_key_mismatch', 'content_article_anti_spam_key' => $anti_spam_key);

    }

    

    // Basic data validation

    if (strlen($name) < 2 || strlen($comment) < 2)

    {

      return array('content_article_error' => 'missing_data');

    }

    else

    {

      $comment_insert = func_db_query($db, "INSERT INTO @TABLE_PREFIX@nx3_article_comment 

        (article_id, comment_text, deleted_yn, attribute1, created_date, created_by) VALUES (?,?,'N',?,NOW(),-1)", 

        array("iss", $article_id, $comment, $name));

        

      return array('content_article_code' => $article_code);

    }

  }

  else

  {

    // Registered users

    

    // Basic data validation

    if ($comment == '')

    {

      return array('content_article_error' => 'missing_data');

    }

    else

    {

      $comment_insert = func_db_query($db, "INSERT INTO @TABLE_PREFIX@nx3_article_comment 

        (article_id, comment_text, deleted_yn, created_date, created_by) VALUES (?,?,'N',NOW(),?)", 

        array("isi", $article_id, $comment, $_SESSION['NX3_USER']['user_id']));     

        

      return array('content_article_code' => $article_code);

    }

  }

}



function get_folder_path($db, $obj_user, $article_folder_id)

{

  // Starting at node $str_folder_code, generate the full path of the folder. 

  // Returns the array leading from the bottom of the hierarchy back up to the root (home) node.

  $hierarchy_depth_limit = 100;

  

  $arr_hierarchy = array();

   

  $x = 0;

  while ($x < $hierarchy_depth_limit)

  {

    $db_result = func_db_query($db, "SELECT f.article_folder_id, f.article_folder_name, f.article_folder_code, f.parent_article_folder_id

      FROM @TABLE_PREFIX@nx3_article_folder f WHERE f.article_folder_id = ? LIMIT 1", array("i", $article_folder_id));

    $arr_hierarchy[$x] = $db_result[0];

    $article_folder_id = $db_result[0]['parent_article_folder_id'];

    $x++;



    if ($db_result[0]['parent_article_folder_id'] == $db_result[0]['article_folder_id'] || $article_folder_id == null)

    {

      // break if parent is the same as the current article folder id or the parent is null

      break;

    }

  }

  

  return array_reverse($arr_hierarchy);

}



function action_browsefolder($db, $obj_user, $get_folder_code)

{

  // fetch folder details

  $db_folder_details = func_db_query($db, "SELECT f.article_folder_id, f.article_folder_code, f.article_folder_name, f.hidden_yn

    FROM @TABLE_PREFIX@nx3_article_folder f

    WHERE f.article_folder_code = ?", array("s", $get_folder_code));

    

  if ($db_folder_details == null)

  {

    return array('content_article_error' => 'folder_not_found', 'content_article_folder_code' => $get_folder_code);

  }



  // fetch folder contents

  $db_result = func_db_query($db, "SELECT 1 AS union_number, 'CHILD FOLDER' AS object_type, f.article_folder_id, f.article_folder_code, f.article_folder_name, f.hidden_yn, f.order_by

    FROM @TABLE_PREFIX@nx3_article_folder f

    JOIN @TABLE_PREFIX@nx3_article_folder fp ON fp.article_folder_id = f.parent_article_folder_id

    WHERE fp.article_folder_code = ?

    AND f.hidden_yn = 'N'

    AND f.deleted_yn = 'N'

    AND f.parent_article_folder_id <> f.article_folder_id

    AND f.article_folder_id IN @ARTICLE_FOLDER_SECURITY@

    UNION ALL

    SELECT 2 AS union_number, 'ARTICLE' AS object_type, a.article_id, a.article_code, a.article_name, a.hidden_yn, a.created_date

    FROM @TABLE_PREFIX@nx3_article a

    JOIN @TABLE_PREFIX@nx3_article_folder f ON a.article_folder_id = f.article_folder_id

    WHERE f.article_folder_code = ?

    AND a.hidden_yn = 'N'

    AND a.deleted_yn = 'N'

    ORDER BY 1, 7 DESC", array("ss", $get_folder_code, $get_folder_code));

  

  $page_content = array();

  

  define("PAGE_HEADING", "Browsing Folder: " . $db_folder_details[0]['article_folder_name']); // Set page heading

  

  $page_content['content_article_folder_name'] = $db_folder_details[0]['article_folder_name'];

  $page_content['content_article_folder_hierarchy'] = get_folder_path($db, $obj_user, $db_folder_details[0]['article_folder_id']);

  

  $page_content['content_article_browse_folder'] = array();

  foreach ($db_result as $row_id => $row_data)

  {

    $page_content['content_article_browse_folder'][] = array('object_type' => $row_data['object_type']

      , 'name' => $row_data['article_folder_name']

      , 'code' => $row_data['article_folder_code']);

  }



  return $page_content;

}



?>