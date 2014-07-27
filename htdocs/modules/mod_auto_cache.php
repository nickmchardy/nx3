<?php

/**
* nx3 Module: Auto Cache
* 
* Auto caches things like external feeds or search indexes every AUTO_CACHE_FREQUENCY minutes.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 18-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

  if (lookup_setting($db, 'nx3.autocache.enable') == 'Y')
  {
    // Cache is enabled
    
    // Cache external feeds which have not been cached in the last nx3.autocache.frequency minutes.
    $query_external_feeds = func_db_query($db, "SELECT f.feed_external_code, f.last_cache_attempt, f.feed_external_id, f.feed_external_name,
      f.enabled_yn, f.feed_external_url, f.last_cache_success
      FROM @TABLE_PREFIX@nx3_feed_external f WHERE f.enabled_yn = 'Y' AND f.auto_index_enabled_yn = 'Y'
      AND f.last_cache_attempt + INTERVAL ? MINUTE < NOW()", array("i", (int) lookup_setting($db, 'nx3.autocache.frequency')));
    
    foreach ($query_external_feeds as $feed)
    {
      log_message($db, __FILE__, 3, 'About to cache external RSS feed ' . $feed['feed_external_code'] . ' last cached ' . $feed['last_cache_success']);

      // Update the feed and record when it was attempted to be cached
      $update_feed_external = func_db_query($db, 'UPDATE @TABLE_PREFIX@nx3_feed_external SET last_cache_attempt = NOW()
        WHERE feed_external_code = ?', array("s", $feed['feed_external_code']));
      
      // Retrieve external feed. Do not display a fatal error if the feed is unreachable.
      $arr_rss = rss_retrieve_external_feed($db, $feed['feed_external_code'], false);
      rss_cache_external_feed($db, $feed['feed_external_code'], $arr_rss);
    }
    
    // Cache search engine index
    /*
    $query_search_subjects = func_db_query($db, "SELECT s.search_subject_id, s.search_subject_name, s.search_subject_code, s.search_subject_sql,
      s.enabled_yn, s.last_index_success
      FROM @TABLE_PREFIX@nx3_search_subject s WHERE s.enabled_yn = 'Y' AND s.auto_index_enabled_yn = 'Y'", null);
    
    if ($query_search_subjects != null)
    {
      // Retrieve stop words (ie words which won't be indexed)
      $query_search_stop_words = func_db_query($db, "SELECT s.stop_word
        FROM @TABLE_PREFIX@nx3_search_stop_word s WHERE s.enabled_yn = 'Y'", null);
      
      $arr_stop_words = array();
      foreach ($query_search_stop_words as $row)
      {
        $arr_stop_words[$row['stop_word']] = 1;
      }
      
      log_message($db, __FILE__, 3, 'Retrieved ' . count($query_search_stop_words) . ' search engine stop words.');

      foreach ($query_search_subjects as $subject)
      {
        log_message($db, __FILE__, 3, 'About to index search subject ' . $subject['search_subject_code'] . ' last indexed ' . $subject['last_index_success'] . '. SQL = ' . $subject['search_subject_sql']);
        
        // Clear out the old index for this search subject
        $index_cleanup = func_db_query($db, "DELETE FROM @TABLE_PREFIX@nx3_search_index WHERE search_subject_id = ?", 
          array("i", $subject['search_subject_id']));
        
        $arr_text_data = array();
        
        // Execute stored SQL statement
        if ($result = $db->query(str_replace('@TABLE_PREFIX@', constant("table_prefix"), $subject['search_subject_sql']), MYSQLI_USE_RESULT))
        {
          while($row = $result->fetch_array())
          {
            $arr_text_data[] = array($row[0], $row[1]);
          }
        }
        else
        {
          fatal_error_handler ($db, "Error when querying search subject " . $subject['search_subject_code'] . " - " . $db->errno . " - " . $db->error);
        }
        $result->close();
        
        foreach ($arr_text_data as $row)
        {
          $object_id = $row[0];
          $text_data = $row[1];
        
          // Clean up text strings
          $text_data = strip_tags($text_data);
          $text_data = str_replace("\r", " ", $text_data);
          $text_data = str_replace("\n", " ", $text_data);
          $text_data = preg_replace("/[^a-zA-Z0-9\s]/", " ", $text_data);

          // Split keywords based on space as a delimeter
          $arr_keywords = explode(' ', $text_data);
          
          foreach ($arr_keywords as $keyword)
          {
            $keyword = str_replace(' ', '', $keyword);
            // Check if word isn't a stop word and is long enough (3 or more chars) to be added to the index.
            if (strlen($keyword) >= 3 && !isset($arr_stop_words[$keyword]))
            {
              // Insert word into search index
              $index_insert = func_db_query($db, "INSERT INTO @TABLE_PREFIX@nx3_search_index 
                (search_subject_id, search_value, search_object_id, created_date, created_by) VALUES (?,?,?,NOW(),-1)", 
                array("isi", $subject['search_subject_id'], $keyword, $object_id));
            }
          }
        }
        
        // Increment query counter
        $GLOBALS['NX3_DB_QUERY_COUNT']++;
      }
    }
    */
  }

?>