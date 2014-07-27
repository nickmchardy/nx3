{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all resources.</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Filename</td><td>Description</td><td>Content Type</td><td>Content Expiry</td>
  </tr>
  {if isset($content_res)}
    {section name=content_res loop=$content_res}
      {strip}
      <tr class="nx3_{if $content_res[content_res].enabled_yn eq 'Y'}enabled{else}disabled{/if}">
        <td>{$content_res[content_res].res_file_name}</td>
        <td>{$content_res[content_res].res_description}</td>
        <td>{$content_res[content_res].res_content_type}</td>
        <td>{$content_res[content_res].res_content_expiry}</td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="4">There are no resources in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
