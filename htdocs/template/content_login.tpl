{if $nx3_action eq ""}
  {include file="nx3_auth.tpl"}
{else}
  {if $nx3_action eq "logout"}
    <p>User logout successful.<br/><br/>
    <a href='{$SITE_URL}'>I'm impatient...</a>
    <META HTTP-EQUIV="Refresh" Content= "2; URL='{$SITE_URL}'">
    </p>
  {else}
    {if isset($content_login_fail)}
      Error! Username or password incorrect.
    {else}
      {if isset($content_login_target)}
        <p>Welcome <b>{$content_login_username}</b>, you have been logged in successfully.<br/><br/>
        <a href='{$content_login_target}'>I'm impatient...</a>
        <META HTTP-EQUIV="Refresh" Content= "2; URL='{$content_login_target}'">
        </p>
      {else}
        Currently logged in as <b>{$content_login_username}</b> - [<a href="{$SITE_URL}login/logout/">logout</a>]
        <br/><br/>
      {/if}
    {/if}
  {/if}
{/if}