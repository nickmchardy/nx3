<p>
  Welcome to the Admin Control Panel,
  <b>{$content_admincontrolpanel_display_name}</b>.<br/>
  Please select a module below:</b>
</p>
<table cellpadding="5">
{section name=content_admincontrolpanel_module_list loop=$content_admincontrolpanel_module_list}
  {strip}
    <tr>
      <td width="40%">
        <p>
          <b><a href="{$SITE_URL}{$content_admincontrolpanel_module_list[content_admincontrolpanel_module_list].link}">
          {$content_admincontrolpanel_module_list[content_admincontrolpanel_module_list].name}</a></b>
        </p>
      </td>
      <td>
        <p>
          {$content_admincontrolpanel_module_list[content_admincontrolpanel_module_list].description}
        </p>
      </td>
    </tr>
  {/strip}
{/section}
</table>
<p>
  {include file="snippet_logout.tpl"}
</p>