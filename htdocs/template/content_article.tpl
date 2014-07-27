{if isset($content_article_error)}
  {if $content_article_error eq "folder_not_specified"}
    <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - no folder code was specified!<br />
  {/if}
  {if $content_article_error eq "folder_not_found"}
    <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - Folder <b>{$content_article_folder_code}</b> could not be found or you do not have access to this folder.<br />
  {/if}
  {if $content_article_error eq "folder_deleted"}
    <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - Folder <b>{$content_article_folder_code}</b> is deleted.<br />
  {/if}
  {if $content_article_error eq "article_not_specified"}
    <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - no article code was specified!<br />
  {/if}
  {if $content_article_error eq "article_not_found"}
    <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - Article <b>{$content_article_code}</b> could not be found or you do not have access to this article.<br />
  {/if}
  {if $content_article_error eq "article_deleted"}
    <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - Article <b>{$content_article_code}</b> is deleted.<br />
  {/if}
  {if $content_article_error eq "spam_key_mismatch"}
    <p><img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - anti-spam key does not match! You need to enter the word <b>{$content_article_anti_spam_key}</b> in the 'key' field.</p>
  {/if}
  {if $content_article_error eq "missing_data"}
    {if isset($nx3_auth_username)}
      <p><img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - Comment field is empty!</p>
    {else}
      <p><img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - Name or Comment field is empty!</p>
    {/if}
  {/if}
{else}
  {if $nx3_action eq "viewarticle"}
    {if $content_article_image_res_id != -1}
      <img src="{$SITE_URL}res/view/{$content_article_image_res_id}" align="right">
    {/if}
    {$content_article_text}
    {if $content_article_has_attachments}
      <!-- Article Attachments -->
      <div class="nx3_content_heading">Attachments</div>
      {section name=content_article_attachments loop=$content_article_attachments}
        <p>
        {if $content_article_attachments[content_article_attachments].attachment_content_type eq 'image/jpeg'}
          <img src='{$SITE_URL}articleattachment/thumbnail/{$content_article_attachments[content_article_attachments].article_attachment_id}'
            alt='{$content_article_attachments[content_article_attachments].attachment_file_name}'
            align='left'>
        {/if}
        <b>File name:</b> <a href='{$SITE_URL}articleattachment/view/{$content_article_attachments[content_article_attachments].article_attachment_id}'>
        {$content_article_attachments[content_article_attachments].attachment_file_name}</a>
        ({$content_article_attachments[content_article_attachments].file_size})<br />
        <b>Description:</b> {$content_article_attachments[content_article_attachments].description}<br /><br />
        </p>
      {/section}
    {/if}
    <p>
    <h6>This article has been viewed {$content_article_view_count} times.</h6>
    </p>
    {if $content_article_show_comments eq true}
      <!-- Article Comments -->
      <form method="post" action="{$nx3_postback}submitcomment/">
        <div class="nx3_content_heading">Add a Comment</div>
        {if isset($nx3_auth_username)}
          {* user is logged in *}
          <b>Name:</b> {$nx3_auth_username}<br />
        {else}
          {* guest form *}
          Name: <input type="text" name="name"/><br />
          Enter the word <b>{$nx3_yell_anti_spam_key}</b>: <input size="10" maxlength="10" name="key"><br />
        {/if}
        <input type="hidden" name="article_id" value="{$content_article_id}">
        <input type="hidden" name="article_code" value="{$content_article_code}">
        <textarea id="comment_text" name="comment_text" rows="5" cols="80" style="width: 80%"></textarea>
        <br />
        <input type="submit" name="save" value="Add Comment" />
      </form>
      <div class="nx3_content_heading">View Comments</div>
      {if $content_article_has_comments}
        {section name=content_article_comments loop=$content_article_comments}
          {strip}
            <a name="article_comment_{$content_article_comments[content_article_comments].article_comment_id}">
            <table border="0" cellspacing="0" cellpadding="0" width="90%">
              <tr>
                <td width="100" valign="top">
                  <div class="nx3_activity_event_avatar">
                    <img src="{$SITE_URL}avatar/view/{$content_article_comments[content_article_comments].user_id}/" alt="{$content_article_comments[content_article_comments].display_name}'s avatar">
                  </div>
                  <div class="nx3_caption">
                  <a href="{$SITE_URL}profile/view/{$content_article_comments[content_article_comments].user_id}/">{$content_article_comments[content_article_comments].display_name}</a>
                  </div>
                </td>
                <td width="12" class="nx3_content_middle_cell" valign="top">&nbsp;
                </td>
                <td class="nx3_content_cell" valign="top">
                  <div class="nx3_content_cell_header">
                    {$content_article_comments[content_article_comments].display_name} commented
                  </div>
                  <div class="nx3_content_cell">
                    <img src="{$SITE_URL}images/quote.png" align="left"> {$content_article_comments[content_article_comments].comment_text}&nbsp;
                  </div>
                  <div class="nx3_content_cell_footer">{$content_article_comments[content_article_comments].date_posted}</div>
                </td>
              </tr>
            </table>
            <div>&nbsp;</div>          
          {/strip}
        {/section}
      {else}
        There are no comments to display.
      {/if}
    {/if}
  {/if}
  {if $nx3_action eq "browsefolder"}
    <p>Current Folder = <b>{$content_article_folder_name}</b>
    </p>
    <p>
    {section name=content_article_folder_hierarchy loop=$content_article_folder_hierarchy}
      {strip}
        <a href="{$SITE_URL}article/browsefolder/{$content_article_folder_hierarchy[content_article_folder_hierarchy].article_folder_code}/">{$content_article_folder_hierarchy[content_article_folder_hierarchy].article_folder_name}</a>\
      {/strip}
    {/section}
    </p>
    {section name=content_article_browse_folder loop=$content_article_browse_folder}
      {strip}
        {if $content_article_browse_folder[content_article_browse_folder].object_type eq "ARTICLE"}
          <img src="{$SITE_URL}images/file.png" align="absmiddle" /> <a href="{$SITE_URL}article/viewarticle/{$content_article_browse_folder[content_article_browse_folder].code}/">{$content_article_browse_folder[content_article_browse_folder].name}</a><br />
        {else}
          <img src="{$SITE_URL}images/folder.png" align="absmiddle" /> <a href="{$SITE_URL}article/browsefolder/{$content_article_browse_folder[content_article_browse_folder].code}/">{$content_article_browse_folder[content_article_browse_folder].name}</a><br />
        {/if}
      {/strip}
    {/section}
  {/if}
  {if $nx3_action eq "viewtoparticles"}
    <table width="100%" border="0">
      <tr>
        <td width="50%" valign="top">
          <p align="left">
            {if $content_article_prev_start_at >= 0}
            <a href="{$SITE_URL}article/viewtoparticles/{$content_article_folder_code}/{$content_article_prev_start_at}"><img src="{$SITE_URL}images/arrow_left.png" border="0" align="absmiddle"> Previous {$content_article_events_to_show}</a>
            {/if}
          </p>
        </td>
        <td width="50%" valign="top">
          <p align="right">
            <a href="{$SITE_URL}article/viewtoparticles/{$content_article_folder_code}/{$content_article_next_start_at}/">Next {$content_article_events_to_show} <img src="{$SITE_URL}images/arrow_right.png" border="0" align="absmiddle"></a>        
          </p>
        </td>
      </tr>
    </table>
    <div>&nbsp;</div>
    <table width="80%" border="0">
      <tr>
        <td width="50%" valign="top"><b>Title</b>
        </td>
        <td width="20%" valign="top"><b>Posted By</b>
        </td>
        <td width="20%" valign="top"><b>Date Posted</b>
        </td>
        <td width="10%" valign="top"><b>Comments</b>
        </td>        
      </tr>
      {section name=content_article_list loop=$content_article_list}
      {strip}
        <tr>
          <td><a href="{$SITE_URL}article/viewarticle/{$content_article_list[content_article_list].content_article_code}/">{$content_article_list[content_article_list].content_article_name}
          </td>
          <td>{$content_article_list[content_article_list].content_article_created_by}
          </td>
          <td>{$content_article_list[content_article_list].content_article_created_date}
          </td>
          <td>{$content_article_list[content_article_list].content_article_comment_count}
          </td>
        </tr>
      {/strip}
      {/section}
    </table>
    <div>&nbsp;</div>
    <table width="100%" border="0">
      <tr>
        <td width="50%" valign="top">
          <p align="left">
            {if $content_article_prev_start_at >= 0}
            <a href="{$SITE_URL}article/viewtoparticles/{$content_article_folder_code}/{$content_article_prev_start_at}"><img src="{$SITE_URL}images/arrow_left.png" border="0" align="absmiddle"> Previous {$content_article_events_to_show}</a>
            {/if}
          </p>
        </td>
        <td width="50%" valign="top">
          <p align="right">
            <a href="{$SITE_URL}article/viewtoparticles/{$content_article_folder_code}/{$content_article_next_start_at}/">Next {$content_article_events_to_show} <img src="{$SITE_URL}images/arrow_right.png" border="0" align="absmiddle"></a>        
          </p>
        </td>
      </tr>
    </table>
    <div>&nbsp;</div>
  {elseif $nx3_action eq "submitcomment"}
    <p>Success, hang on...<br/><br/>
    <a href='{$nx3_postback}viewarticle/{$content_article_code}/'>I'm impatient...</a>
    <META HTTP-EQUIV="Refresh" Content= "2; URL='{$nx3_postback}viewarticle/{$content_article_code}/'">
    </p>
  {/if}
{/if}