{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all menus in the database.</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Name</td><td>Item Count</td><td>Description</td>
  </tr>
  {if isset($content_list_menu)}
    {section name=content_list_menu loop=$content_list_menu}
      {strip}
      <tr class="nx3_{if $content_list_menu[content_list_menu].enabled_yn eq 'Y'}enabled{else}disabled{/if}">
        <td>{$content_list_menu[content_list_menu].menu_name}</td>
        <td>{$content_list_menu[content_list_menu].count_menu_items}</td>
        <td>{$content_list_menu[content_list_menu].menu_description}</td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="4">There are no menus defined in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
