{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a summary of the usage of the system broken down by date, module (content) and function (action).</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Date</td><td>Content</td><td>Action</td><td>Render Time</td><td>Queries</td><td>Errors</td><td>Views</td>
  </tr>
  {section name=content_usage_log loop=$content_usage_log}
    {strip}
    <tr>
      <td>{$content_usage_log[content_usage_log].request_datetime}</td>
      <td>{$content_usage_log[content_usage_log].content}</td>
      <td>{$content_usage_log[content_usage_log].action}</td>
      <td>{$content_usage_log[content_usage_log].render_time}</td>
      <td>{$content_usage_log[content_usage_log].query_count}</td>
      <td>{$content_usage_log[content_usage_log].error_count}</td>
      <td>{$content_usage_log[content_usage_log].view_count}</td>
    </tr>
    {/strip}
  {/section}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
