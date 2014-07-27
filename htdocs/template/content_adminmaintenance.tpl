{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of processes which can be run by an admin.
  Select the process you wish to run.</p>
  <hr/>
  <div class="nx3_content_heading">Purge Usage Logs</div>
  <p>Purge logs older than 30 days. This may
  improve the performance of the site by clearing out old logs. The downside is that usage tracking over time
  for requests made over a month ago will not be available. [<a href="{$nx3_postback}purgelogs/">Execute</a>]
  </p>
  <hr/>
  <div class="nx3_content_heading">Recompile Templates</div>
  <p>
  Re-compile all templates regardless of NX3_DEBUG setting. [<a href="{$nx3_postback}recompiletemplates/">Execute</a>]
  </p>
  <hr/>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
{if $nx3_action eq "purgelogs"}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>The logs have been purged where records are older than 30 days.
  </p>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
{if $nx3_action eq "recompiletemplates"}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>The following templates have been recompiled:
  </p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Code</td><td>Name</td><td>Template File</td><td>Result</td>
  </tr>
  {section name=content_maintenance_modules loop=$content_maintenance_modules}
    {strip}
    <tr>
      <td>{$content_maintenance_modules[content_maintenance_modules].module_code}</td>
      <td>{$content_maintenance_modules[content_maintenance_modules].module_name}</td>
      <td>{$content_maintenance_modules[content_maintenance_modules].template_file}</td>
      <td>OK</td>
    </tr>
    {/strip}
  {/section}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
