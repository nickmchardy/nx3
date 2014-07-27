{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all photo galleries in the database.</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Name</td><td>Image Path</td><td>Thumb Path</td><td>Hidden</td><td>Order</td>
  </tr>
  {if isset($content_list_photo_albums)}
    {section name=content_list_photo_albums loop=$content_list_photo_albums}
      {strip}
      <tr class="nx3_{if $content_list_photo_albums[content_list_photo_albums].enabled_yn eq 'Y'}enabled{else}disabled{/if}">
        <td>{$content_list_photo_albums[content_list_photo_albums].photo_gallery_name}</td>
        <td>{$content_list_photo_albums[content_list_photo_albums].image_path}</td>
        <td>{$content_list_photo_albums[content_list_photo_albums].thumb_path}</td>
        <td>{$content_list_photo_albums[content_list_photo_albums].hidden_yn}</td>
        <td>{$content_list_photo_albums[content_list_photo_albums].order_by}</td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="4">There are no photo galleries defined in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
