{if isset($content_feedexternal_error)}
  {if $content_feedexternal_error eq "feed not specified"}
    <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - no RSS feed code was specified!<br />
  {/if}
{else}
  <p>
  Now viewing feed: <b>{$content_feedexternal_channel_title}</b>
  <br />
  <ul>
    {section name=content_feedexternal_list loop=$content_feedexternal_list}
      {strip}
        <li>
          <a href="{$content_feedexternal_list[content_feedexternal_list].link}">{$content_feedexternal_list[content_feedexternal_list].title}</a><br/>
          {$content_feedexternal_list[content_feedexternal_list].description}
        </li>
      {/strip}
    {/section}
  </ul>
  A total of {$content_feedexternal_item_count} items were displayed in this channel.
  </p>
{/if}