{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all RSS feeds (internal and external) in the database.</p>
  <div class="nx3_content_heading"><p>Internal RSS Feeds</p></div>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td width="25%">Name</td><td width="75%">Description</td>
  </tr>
  {if isset($content_list_feed)}
    {section name=content_list_feed loop=$content_list_feed}
      {strip}
      <tr class="nx3_{if $content_list_feed[content_list_feed].enabled_yn eq 'Y'}enabled{else}disabled{/if}">
        <td>{$content_list_feed[content_list_feed].feed_name}</td>
        <td>{$content_list_feed[content_list_feed].feed_description}</td>
      </tr>
      <tr>
        <td colspan="2"><p class="nx3_small">{$content_list_feed[content_list_feed].feed_sql}</p>
        <p>&nbsp;</p></td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="4">There are no internal RSS feeds defined in the database.</td>
    </tr>
  {/if}
  </table>
  <div class="nx3_content_heading"><p>External RSS Feeds</p></div>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Name</td><td>Description</td><td>Last Attempt</td><td>Last Success</td><td>Cache ON?</td>
  </tr>
  {if isset($content_list_feed_external)}
    {section name=content_list_feed_external loop=$content_list_feed_external}
      {strip}
      <tr class="nx3_{if $content_list_feed_external[content_list_feed_external].enabled_yn eq 'Y'}enabled{else}disabled{/if}">
        <td>{$content_list_feed_external[content_list_feed_external].feed_external_name}</td>
        <td>{$content_list_feed_external[content_list_feed_external].feed_external_description}</td>
        <td>{$content_list_feed_external[content_list_feed_external].last_cache_attempt}</td>
        <td>{$content_list_feed_external[content_list_feed_external].last_cache_success}</td>
        <td class="nx3_{if $content_list_feed_external[content_list_feed_external].auto_index_enabled_yn eq 'Y'}enabled{else}disabled{/if}">
          {$content_list_feed_external[content_list_feed_external].auto_index_enabled_yn}</td>
      </tr>
      <tr>
        <td colspan="5"><p>{$content_list_feed_external[content_list_feed_external].feed_external_url}</p>
        <p>&nbsp;</p>
        </td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="4">There are no external RSS feeds defined in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
