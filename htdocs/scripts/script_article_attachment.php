<?php

/**
* nx3 Script Module: Article Attachment
* 
* Provides the ability to deliver article attachments stored as blobs in the nx3 database.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 11-Aug-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function script_handler($db, $obj_user, $content, $action, $smarty_template_file)
{
  if ($action == 'view' || $action == 'thumbnail')
  {
    // Show the attachment or if the attachment is an image and the action is thumbnail, then generate a thumbnail
  
    // Validate parameters
    if (!isset($GLOBALS['NX3_PARAM_ARRAY'][2]))
    {
      fatal_error_handler ($db, "No article attachment specified.");
    }

    $get_article_attachment_id = $GLOBALS['NX3_PARAM_ARRAY'][2];

    // Fetch article attachment. Also check if user is able to access article (apply security).
    $result_attachment_details = func_db_query($db, "SELECT aa.article_attachment_id, aa.article_id, aa.attachment_file_name,
      aa.attachment_content_type FROM @TABLE_PREFIX@nx3_article_attachment aa JOIN @TABLE_PREFIX@nx3_article a ON aa.article_id = a.article_id
      WHERE aa.article_attachment_id = ? AND aa.deleted_yn = 'N' AND a.deleted_yn = 'N' AND a.article_folder_id IN @ARTICLE_FOLDER_SECURITY@", 
      array("i", $get_article_attachment_id));

    // Perform checks of result set
    if ($result_attachment_details == null)
    {
      fatal_error_handler ($db, "Requested article attachment ID " . $get_article_attachment_id . " does not exist or you do not have access to the article.");
    }
      
    $article_attachment_id = $result_attachment_details[0]['article_attachment_id'];
    $content_type = $result_attachment_details[0]['attachment_content_type'];
          
    // Get BLOB (does not use prepared statements due to issues with prepared statements and blobs)
    $result = func_db_query_old_skool($db, "SELECT attachment_blob FROM @TABLE_PREFIX@nx3_article_attachment WHERE article_attachment_id = $article_attachment_id LIMIT 1", true);
    $attachment_blob = $result[0][0];
    
    // Increment query counter
    $GLOBALS['NX3_DB_QUERY_COUNT']++;

    // change the content-type so the browser knows how to handle it
    header("Content-type: " . $content_type);
    
    // set the content expiry thing so the browser doesn't reload the same attachment file every time the browser reloads
    header("Cache-Control: cache");
    // Use system-wide default for the content expiry time
    header("Expires: " . gmdate("D, d M Y H:i:s", time() + lookup_setting($db, 'nx3.article.contentexpiry')) . " GMT");    

    if ($action != 'thumbnail')
    {
      // Return the attachment's data
      return $attachment_blob;
    }
    else
    {
      // Generate thumbnail
      // TODO: this only handles JPEGs. Need to also handle other formats inlcuding icons for different file types.
      $image = imagecreatefromstring($attachment_blob);
      $nWidth = imagesx($image);
      $nHeight = imagesy($image);
      $nDestinationHeight = 64;
      $nDestinationWidth = round(($nWidth * $nDestinationHeight) / $nHeight);
      $oDestinationImage = ImageCreateTrueColor($nDestinationWidth, $nDestinationHeight);
      imagecopyresampled($oDestinationImage, $image, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight); // resize the image
      imageJPEG($oDestinationImage);
      imagedestroy($image);
      
      return null;
    }
  }
  else
  {
    fatal_error_handler ($db, "Invalid action specified.");
  }
}
 
?>