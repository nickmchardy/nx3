<p>Below you will find a list of guests &amp; users who were online or active in the past {$content_online_frequency} minutes.
</p>
<div class="nx3_content_heading">Guests</div>
<p>
  {if isset($content_online_guests)}
    <table width="80%" border="0">
      <tr>
        <td width="50%" valign="top"><b>Source Domain</b>
        </td>
        <td width="50%" valign="top"><b>Last Active</b>
        </td>
      </tr>
      {section name=content_online_guests loop=$content_online_guests}
        <tr>
          <td>{$content_online_guests[content_online_guests].name}
          </td>
          <td>{$content_online_guests[content_online_guests].datetime}
          </td>
        </tr>
      {/section}
    </table>
  {else}
    There have been no guests online in the last {$content_online_frequency} minutes.
  {/if}
</p>
<div class="nx3_content_heading">Registered Users</div>
<p>
  {if isset($content_online_users)}
    <table width="80%" border="0">
      <tr>
        <td width="50%" valign="top"><b>Display Name</b>
        </td>
        <td width="50%" valign="top"><b>Last Active</b>
        </td>
      </tr>
      {section name=content_online_users loop=$content_online_users}
        <tr>
          <td>{$content_online_users[content_online_users].name}
          </td>
          <td>{$content_online_users[content_online_users].datetime}
          </td>
        </tr>
      {/section}
    </table>
  {else}
    There have been no users online in the last {$content_online_frequency} minutes.
  {/if}
</p>
