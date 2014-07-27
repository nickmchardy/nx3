{if $nx3_action eq "query"}
  {if isset($content_search_results)}
    <table width="80%" border="0">
      <tr>
        <td width="25%" valign="top"><b>Subject Area</b>
        </td>
        <td width="60%" valign="top"><b>Item</b>
        </td>        
        <td width="15%" valign="top"><b>Ranking</b>
        </td>
      </tr>
      {section name=content_search_results loop=$content_search_results}
      {strip}
        <tr>
          <td>{$content_search_results[content_search_results].subject_area}
          </td>
          <td><a href="{$SITE_URL}{$content_search_results[content_search_results].link}">
          {$content_search_results[content_search_results].item}</a>
          </td>
          <td>{$content_search_results[content_search_results].frequency|string_format:"%01.0f"}%
          </td>
        </tr>
      {/strip}
      {/section}
    </table>
  {else}
    There were no results!
  {/if}
{/if}