          {section name=nx3_yell_history loop=$nx3_yell_history}
          {strip}
            <font size=1><b>{$nx3_yell_history[nx3_yell_history].name}</b>: {$nx3_yell_history[nx3_yell_history].comment}</font><br/>
          {/strip}
          {/section}
          <br/>
          <a href="{$SITE_URL}yell/">View History</a>
          <hr width="70%">
          {if isset($nx3_auth_username)}
            <p>
              <font size="2"><b>Yell:</b><br/></font>
            </p>
            <form action="{$SITE_URL}yell/submit/" method="post">
              <table class="nx3_mini">
                <tr>
                  <td>
                    Name:
                  </td>
                  <td>
                    {$nx3_auth_username}
                  </td>
                </tr>
                <tr>
                  <td>
                    Msg:
                  </td>
                  <td>
                    <input type="text" name="comments" size="10" maxlength="200">
                  </td>
                </tr>
                <tr>
                  <td>
                    &nbsp;
                  </td>
                  <td>
                    <input type="submit" name="yell" value="Yell">
                    <input type="hidden" name="target" value="{$nx3_self_target}">
                  </td>
                </tr>
              </table>
            </form>
          {else}
          <!-- guest form -->
            <p>
              <font size="2"><b>Yell:</b><br/></font>
            </p>
            <form action="{$SITE_URL}yell/submit/" method="post">
              <table class="nx3_mini">
                <tr>
                  <td>
                    Name:
                  </td>
                  <td>
                    <input type="text" name="name" size="10" maxlength="100">
                  </td>
                </tr>
                <tr>
                  <td>
                    Msg:
                  </td>
                  <td>
                    <input type="text" name="comments" size="10" maxlength="100">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    Enter <b>{$nx3_yell_anti_spam_key}</b> below:
                  </td>
                </tr>
                <tr>
                  <td>
                    &nbsp;
                  </td>
                  <td>
                    <input size="6" maxlength="6" name="key">
                  </td>
                </tr>
                <tr>
                  <td>
                    &nbsp;
                  </td>
                  <td>
                    <input type="submit" name="yell" value="Yell">
                    <input type="hidden" name="target" value="{$nx3_self_target}">
                  </td>
                </tr>
              </table>
            </form>
          {/if}
