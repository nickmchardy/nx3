{if $nx3_action eq ""}
  {include file="snippet_admincontrolpanel.tpl"}
  <p>Below is a list of all articles in the database.</p>
  <table class="nx3_content" align="center">
  <tr class="nx3_header">
    <td>Folder</td><td>Article</td><td>Hidden</td><td>Views</td><td>Attach.</td><td>Comments</td>
  </tr>
  {if isset($content_list_articles)}
    {section name=content_list_articles loop=$content_list_articles}
      {strip}
      <tr class="nx3_{if $content_list_articles[content_list_articles].deleted_yn eq 'N'}enabled{else}disabled{/if}">
        <td><a href="{$SITE_URL}article/viewtoparticles/{$content_list_articles[content_list_articles].article_folder_code}/">
        {$content_list_articles[content_list_articles].article_folder_name}</a></td>
        <td><a href="{$SITE_URL}article/viewarticle/{$content_list_articles[content_list_articles].article_code}/">
        {$content_list_articles[content_list_articles].article_name}</a></td>
        <td>{$content_list_articles[content_list_articles].hidden_yn}</td>
        <td>{$content_list_articles[content_list_articles].view_count}</td>
        <td>{$content_list_articles[content_list_articles].attachment_count}</td>
        <td>{$content_list_articles[content_list_articles].comment_count}</td>
      </tr>
      {/strip}
    {/section}
  {else}
    <tr>
      <td colspan="6">There are no articles defined in the database.</td>
    </tr>
  {/if}
  </table>
  {include file="snippet_admincontrolpanel.tpl"}
{/if}
