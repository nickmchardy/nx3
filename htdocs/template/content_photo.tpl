{if isset($content_photo_error)}
  <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - Photo Gallery <b>{$content_photo_gallery_code}</b> could not be found or you do not have access to this gallery.<br />
{else}
  {if $nx3_action eq "view"}
    <script type="text/javascript" src="{$content_photo_viewer_js_url}"></script>
    <div style="height: 600px; " id="nx3_flashcontent">NX3 and SimpleViewer requires JavaScript and the Adobe Flash Player. <a href="http://www.macromedia.com/go/getflashplayer/">Get Flash.</a>
    </div>
    <script type="text/javascript">
      var fo = new SWFObject("{$content_photo_viewer_swf_url}", "viewer", "100%", "100%", "8", "#333333");
      fo.addVariable("xmlDataPath", "{$content_photo_gallery_xml_url}");
      fo.write("nx3_flashcontent");	
    </script>
  {else}
    <table width="80%" border="0">
      <tr>
        <td width="60%" valign="top"><b>Gallery Name</b>
        </td>
        <td width="20%" valign="top"><b>Posted By</b>
        </td>
        <td width="20%" valign="top"><b>Date Posted</b>
        </td>
      </tr>
      {section name=content_photo_list loop=$content_photo_list}
        {strip}     
          <tr>
            <td><a href="{$SITE_URL}photo/view/{$content_photo_list[content_photo_list].gallery_code}/">{$content_photo_list[content_photo_list].gallery_name}
            </td>
            <td>{$content_photo_list[content_photo_list].created_by}
            </td>
            <td>{$content_photo_list[content_photo_list].created_date}
            </td>
          </tr>
        {/strip}
      {/section}
    </table>
    <div>&nbsp;</div>  
  {/if}
{/if}
