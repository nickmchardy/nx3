{config_load file=default.conf section="setup"}<html>
  <head>
    <title>nisch.org | {$nx3_title}</title>
    <link rel="stylesheet" type="text/css" href="{$SITE_URL}custom/template/n4.css" />
    <link rel="stylesheet" type="text/css" href="{$SITE_URL}custom/template/nx3_base.css" />
    <meta name="description" content="{$nx3_meta_description}" />
    <meta name="keywords" content="{$nx3_meta_keywords}" />
    <link rel="shortcut icon" href="{$SITE_URL}custom/template/favicon.ico">
  {section name=nx3_feed_list loop=$nx3_feed_list}
  {strip}
    <link rel="alternate" type="application/rss+xml" title="{$nx3_feed_list[nx3_feed_list].feed_title}" href="{$nx3_feed_list[nx3_feed_list].feed_url}">
  {/strip}
  {/section}</head>
  <body bottomMargin="0" leftMargin="0" topMargin="0" rightMargin="0" marginheight="0" marginwidth="0">
    <div id="topbar" class="topbar">
      <div id="topimage" class="topimage">
        <div id="btnHome" class="menubutton" style="left: 114px; "
             onmouseover="style.backgroundImage = 'url(\'{$SITE_URL}custom/template/button-highlight.png\')';" onmouseout="style.backgroundImage = 'none';">
          <a href="{$SITE_URL}activity/"><img src="{$SITE_URL}custom/template/spacer.gif" height="100%" width="100%" border="0"></a>
        </div>
        <div id="btnBlogs" class="menubutton" style="left: 235px;"
             onmouseover="style.backgroundImage = 'url(\'{$SITE_URL}custom/template/button-highlight.png\')';" onmouseout="style.backgroundImage = 'none';">
          <a href="{$SITE_URL}article/viewtoparticles/BLOGS/0/"><img src="{$SITE_URL}custom/template/spacer.gif" height="100%" width="100%" border="0"></a>
        </div>
        <div id="btnYell" class="menubutton" style="left: 356px;"
             onmouseover="style.backgroundImage = 'url(\'{$SITE_URL}custom/template/button-highlight.png\')';" onmouseout="style.backgroundImage = 'none';">
          <a href="{$SITE_URL}yell/"><img src="{$SITE_URL}custom/template/spacer.gif" height="100%" width="100%" border="0"></a>
        </div>
        <div id="btnPhotos" class="menubutton" style="left: 477px;"
             onmouseover="style.backgroundImage = 'url(\'{$SITE_URL}custom/template/button-highlight.png\')';" onmouseout="style.backgroundImage = 'none';">
          <a href="{$SITE_URL}photo/"><img src="{$SITE_URL}custom/template/spacer.gif" height="100%" width="100%" border="0"></a>
        </div>
        <div id="btnAbout" class="menubutton" style="left: 598px;"
             onmouseover="style.backgroundImage = 'url(\'{$SITE_URL}custom/template/button-highlight.png\')';" onmouseout="style.backgroundImage = 'none';">
          <a href="{$SITE_URL}article/viewarticle/CONTENT_ABOUT/"><img src="{$SITE_URL}custom/template/spacer.gif" height="100%" width="100%" border="0"></a>
        </div>
        <div id="btnContact" class="menubutton" style="left: 719px;"
             onmouseover="style.backgroundImage = 'url(\'{$SITE_URL}custom/template/button-highlight.png\')';" onmouseout="style.backgroundImage = 'none';">
          <a href="{$SITE_URL}article/viewarticle/CONTENT_CONTACT/"><img src="{$SITE_URL}custom/template/spacer.gif" height="100%" width="100%" border="0"></a>
        </div>
      </div>
    </div>
    <div id="topspacer" class="topspacer">
    </div>
    <p>
    <table class="sidetable">
      <tr>
        <td class="frame" width=20>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="frame">&nbsp;</td><td class="frame" width=20>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td class="frame" width=20 height=20 colspan=1 background="{$SITE_URL}custom/template/tab-top-left.png">&nbsp;
        </td>
        <td class="frame" colspan=1 background="{$SITE_URL}custom/template/tab-top-middle.png">&nbsp;
        </td>    
        <td class="frame" width=20 background="{$SITE_URL}custom/template/tab-top-right.png">
          &nbsp;
        </td>
      </tr>
      <tr>
        <td class="frame" width=20 height=20 background="{$SITE_URL}custom/template/tab-middle-left.png">&nbsp;
        </td>
        <td height=20 class="contentcell">
          <!-- SIDE BAR -->
          <div class="heading"><img src="{$SITE_URL}custom/template/online.png"> Search</div>
            <form method="post" action="{$SITE_URL}search/query/">
              <input name="terms" size="16"><input type="submit" name="submit" value="Go">
            </form>
          <div class="heading"><img src="{$SITE_URL}custom/template/login.png"> Login</div>
          {include file="nx3_auth.tpl"}
          <div class="heading"><img src="{$SITE_URL}custom/template/yell.png"> Yell</div>
          {include file="nx3_yell.tpl"}
          <div class="heading"><img src="{$SITE_URL}custom/template/online.png"> Users Online</div>
          {include file="nx3_online.tpl"}
          <!--div class="heading">Photo</div>
          {* $RANDOM_PIC *}
          <div class="heading">Latest Blogs</div>
          {* $LATEST_NEWS *}-->
          <div class="heading">Menu</div>
          {include file="nx3_menu.tpl"}
          <br>
          <!-- END SIDE CONTENT -->
        </td>
        <td class="frame" width=20 height=20 background="{$SITE_URL}custom/template/tab-middle-right.png">&nbsp;
        </td>
      </tr>
      <tr>
        <td class="frame" height=20 width=20 background="{$SITE_URL}custom/template/tab-bottom-left.png">&nbsp;
        </td>
        <td class="frame" colspan=1 height=20 background="{$SITE_URL}custom/template/tab-bottom-middle.png">&nbsp;
        </td>
        <td class="frame" width=20 height=20 background="{$SITE_URL}custom/template/tab-bottom-right.png">&nbsp;
        </td>
      </tr>
    </table>    
    <table class="contenttable">
      <tr>
        <td class="frame" width=20>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="frame">&nbsp;</td><td class="frame" width=20>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td class="frame" width=20 height=20 colspan=1 background="{$SITE_URL}custom/template/tab-top-left.png">&nbsp;
        </td>
        <td class="frame" colspan=1 background="{$SITE_URL}custom/template/tab-top-middle.png">&nbsp;
        </td>    
        <td class="frame" width=20 background="{$SITE_URL}custom/template/tab-top-right.png">
          &nbsp;
        </td>
      </tr>
      <tr>
        <td class="frame" width=20 height=20 background="{$SITE_URL}custom/template/tab-middle-left.png">&nbsp;
        </td>
        <td height=20 class="contentcell">
          <!-- PAGE CONTENT -->
          <div class="content_heading">{$HEADING}</div>
          {if isset($nx3_content_template_file)}
            {include file="$nx3_content_template_file"}
          {elseif isset($nx3_module_access_denied)}
            <img src="{$SITE_URL}images/exclamation.gif" align="absmiddle" /> Error - User does not have access to module '{$nx3_module_code}'.
          {/if}
          <!-- END PAGE CONTENT -->
        </td>
        <td class="frame" width=20 height=20 background="{$SITE_URL}custom/template/tab-middle-right.png">&nbsp;
        </td>
      </tr>
      <tr>
        <td class="frame" height=20 width=20 background="{$SITE_URL}custom/template/tab-bottom-left.png">&nbsp;
        </td>
        <td class="frame" colspan=1 height=20 background="{$SITE_URL}custom/template/tab-bottom-middle.png">&nbsp;
        </td>
        <td class="frame" width=20 height=20 background="{$SITE_URL}custom/template/tab-bottom-right.png">&nbsp;
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <p align="center"><br/>
            <a href="http://www.purpletoaster.com/">
              <img border="0" src="{$SITE_URL}custom/template/purple_power.png" width="200" height="46" alt="Powered by Purple Toaster"/>
            </a><br/>&nbsp;
          </p>
        </td>
      </tr>
    </table>
    </p>
  </body>
</html>
