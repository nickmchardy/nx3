{if $nx3_action eq ""}
  {section name=content_yell_list loop=$content_yell_list}
    {strip}
      <font size=1><b>{$content_yell_list[content_yell_list].name}</b>: {$content_yell_list[content_yell_list].comment}<br/></font>
    {/strip}
  {/section}
{/if}

{if $nx3_action eq "submit"}
  {if isset($content_yell_error)}
    {if $content_yell_error eq "spam_key_mismatch"}
      Error - anti-spam key does not match! You need to enter the word <b>{$content_yell_anti_spam_key}</b> in the 'key' field.
    {else}
      {if isset($nx3_auth_username)}
        Error - Message field is empty!
      {else}
        Error - Name or Message field is empty!
      {/if}
    {/if}
  {else}
    <p>Success, hang on...<br/><br/>
    <a href='{$content_yell_target}'>I'm impatient...</a>
    <META HTTP-EQUIV="Refresh" Content= "2; URL='{$content_yell_target}'">
    </p>
  {/if}
{/if}