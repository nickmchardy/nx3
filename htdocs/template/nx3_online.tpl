<font size="2">There are currently
{if isset($nx3_auth_username)}
  <a href="{$SITE_URL}online/">{$nx3_online_guests}</a>
{else}
  <b>{$nx3_online_guests}</b>
{/if}
{if $nx3_online_guests eq 1}
 guest
{else}
 guests
{/if}
and
{if isset($nx3_auth_username)}
  <a href="{$SITE_URL}online/">{$nx3_online_users}</a>
{else}
  <b>{$nx3_online_users}</b>
{/if}
{if $nx3_online_users eq 1}
 user
{else}
 users
{/if}
online.</font>
<br /><br />
