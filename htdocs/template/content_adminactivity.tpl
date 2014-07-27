{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all activity targets (eg blogs, comments, external feeds, etc) in the database.</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td width="25%">Name</td><td width="75%">Description</td>
  </tr>
  {if isset($content_list_activity)}
    {section name=content_list_activity loop=$content_list_activity}
      {strip}
      <tr class="nx3_{if $content_list_activity[content_list_activity].enabled_yn eq 'Y'}enabled{else}disabled{/if}">
        <td>{$content_list_activity[content_list_activity].activity_name}</td>
        <td>{$content_list_activity[content_list_activity].activity_description}</td>
      </tr>
      <tr>
        <td colspan="2">{$content_list_activity[content_list_activity].activity_sql}</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="4">There are no activity targets defined in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
