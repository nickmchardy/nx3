{if $nx3_action eq "" || $nx3_action eq "savesetting"}
  {if isset($content_settings_error)}
    {if $content_settings_error eq "missing_data"}
      Error - form data is missing for fields 'field' and 'value'.
    {/if}
  {else}
    {include file="snippet_admincontrolpanel.tpl"}
    {if isset($content_setting_field) && isset($content_setting_value)}
      <div class="nx3_message"><p>
        <img src="{$SITE_URL}images/accept.png" align="absmiddle" alt="Accept" height="16" width="16"/>
        Setting <b>{$content_setting_field}</b> has been changed to <b>{$content_setting_value}</b>.
      </p></div>
    {/if}
    <p>Below is a list of all settings and their values stored in the settings table.
    Changing some of the settings below could lead to the website becoming inaccessible.</p>
    <table class="nx3_content" align="center">
    <tr class="nx3_header">
      <td>Setting</td><td>Value</td>
    </tr>
    {section name=content_settings loop=$content_settings}
      {strip}
      <tr>
        <td valign="top">
          <p>{$content_settings[content_settings].field}</p>
          <p class="nx3_small">{$content_settings[content_settings].description}</p>
        </td>
        <td valign="top"><p><form name="form_{$content_settings[content_settings].field}" action="{$nx3_postback}savesetting/" method="POST">
          <input type="hidden" name="field" value="{$content_settings[content_settings].field}"/>
          <input type="text" name="value" value="{$content_settings[content_settings].value}" size="50"/>
          <input type="submit" value="Save"/>
        </form></p>
        </td>
      </tr>
      <tr>
      <td colspan="2"><hr/>
      </td>
      </tr>
      {/strip}
    {/section}
    </table>
    {include file="snippet_admincontrolpanel.tpl"}
  {/if}
{/if}