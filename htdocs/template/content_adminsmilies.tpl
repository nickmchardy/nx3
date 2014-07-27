{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all smilies in the database.</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Target</td><td>URL</td><td>Image</td>
  </tr>
  {if isset($content_list_smilies)}
    {section name=content_list_smilies loop=$content_list_smilies}
      {strip}
      <tr class="nx3_{if $content_list_smilies[content_list_smilies].enabled_yn eq 'Y'}enabled{else}disabled{/if}">
        <td>{$content_list_smilies[content_list_smilies].target}</td>
        <td>{$content_list_smilies[content_list_smilies].url}</td>
        <td><img src="{$SITE_URL}{$content_list_smilies[content_list_smilies].url}" /></td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="4">There are no smilies defined in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
