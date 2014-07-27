          {if isset($nx3_auth_username)}
            {include file="snippet_logout.tpl"}
            <br/><br/>
          {else}
            <form name="form1" method="post" action="{$SITE_URL}login/auth/">
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td>User:</td>
                  <td><input type="text" name="username" value="" size="10"></td>
                </tr>
                <tr>
                  <td>Pass:</td>
                  <td><input type="password" name="password" value="" size="10"></td>
                </tr>
                <!--tr>
                  <td colspan=2><input type="checkbox" name="remember" CHECKED>Remember Me</td>
                </tr-->
                <tr> 
                  <td>&nbsp;</td>
                  <td>
                  <input type="submit" name="Submit" value="Login">
                  <input type="hidden" name="target" value="{$nx3_self_target}">
                  </td>
                </tr>
              </table>
            </form>
          {/if}