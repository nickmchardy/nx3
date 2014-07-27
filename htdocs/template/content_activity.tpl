{if isset($content_activity_list)}
  <table width="100%" border="0">
    <tr>
      <td width="50%" valign="top">
        <p align="left">
          {if $content_activity_prev_start_at >= 0}
          <a href="{$SITE_URL}activity/view/{$content_activity_prev_start_at}"><img src="{$SITE_URL}images/arrow_left.png" border="0" align="absmiddle"> Previous {$content_activity_events_to_show}</a>
          {/if}
        </p>
      </td>
      <td width="50%" valign="top">
        <p align="right">
          <a href="{$SITE_URL}activity/view/{$content_activity_next_start_at}/">Next {$content_activity_events_to_show} <img src="{$SITE_URL}images/arrow_right.png" border="0" align="absmiddle"></a>        
        </p>
      </td>
    </tr>
  </table>
  <div>&nbsp;</div>
  {section name=content_activity_list loop=$content_activity_list}
  {strip}
  <table border="0" cellspacing="0" cellpadding="0" width="90%">
    <tr>
      <td width="100" valign="top">
        <div class="nx3_activity_event_avatar">
          <img src="{$SITE_URL}avatar/view/{$content_activity_list[content_activity_list].content_activity_user_id}/">
        </div>
        <div class="nx3_caption">
        <a href="{$SITE_URL}profile/view/{$content_activity_list[content_activity_list].content_activity_user_id}/">{$content_activity_list[content_activity_list].content_activity_user_name}</a>
        </div>
      </td>
      <td width="12" class="nx3_content_middle_cell" valign="top">&nbsp;
      </td>
      <td class="nx3_content_cell" valign="top">
        <div class="nx3_content_cell_header">
          {$content_activity_list[content_activity_list].content_activity_user_name} {$content_activity_list[content_activity_list].content_activity_message}
        </div>
        <div class="nx3_content_cell">
          <img src="{$SITE_URL}images/quote.png" align="left"> {$content_activity_list[content_activity_list].content_activity_summary}&nbsp;
          <a class="nx3_small" href="{$content_activity_list[content_activity_list].content_activity_link}">Read More...</a>
        </div>
        <div class="nx3_content_cell_footer">{$content_activity_list[content_activity_list].content_activity_datetime}</div>
      </td>
      <td class="nx3_content_cell" valign="top" width="80">
        <div class="nx3_content_cell_right">
          <img src="{$SITE_URL}{$content_activity_list[content_activity_list].content_activity_icon}" alt="Source: {$content_activity_list[content_activity_list].content_activity_module}">
        </div>
      </td>   
    </tr>
  </table>
  <div>&nbsp;</div>
  {/strip}
  {/section}
  <table width="100%" border="0">
    <tr>
      <td width="50%" valign="top">
        <p align="left">
          {if $content_activity_prev_start_at >= 0}
          <a href="{$SITE_URL}activity/view/{$content_activity_prev_start_at}"><img src="{$SITE_URL}images/arrow_left.png" border="0" align="absmiddle"> Previous {$content_activity_events_to_show}</a>
          {/if}
        </p>
      </td>
      <td width="50%" valign="top">
        <p align="right">
          <a href="{$SITE_URL}activity/view/{$content_activity_next_start_at}/">Next {$content_activity_events_to_show} <img src="{$SITE_URL}images/arrow_right.png" border="0" align="absmiddle"></a>        
        </p>
      </td>
    </tr>
  </table>
{else}
  <p>No activity has been defined in this site or you do not have access to any of the defined activity.
{/if}