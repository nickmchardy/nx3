{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all groups that have members.</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Group</td><td>User</td><td>Display</td><td>Email</td><td>Last Active</td>
  </tr>
  {if isset($content_list_security)}
    {section name=content_list_security loop=$content_list_security}
      {strip}
      <tr>
        <td class="nx3_{if $content_list_security[content_list_security].group_enabled_yn eq 'Y'}enabled{else}disabled{/if}">
          {$content_list_security[content_list_security].group_name}</td>
        <td class="nx3_{if $content_list_security[content_list_security].user_enabled_yn eq 'Y'}enabled{else}disabled{/if}">
          {$content_list_security[content_list_security].username}</td>
        <td>{$content_list_security[content_list_security].display_name}</td>
        <td>{$content_list_security[content_list_security].email}</td>
        <td>{$content_list_security[content_list_security].last_active}</td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="5">There are no users assigned to groups in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
