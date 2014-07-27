          {section name=nx3_menu loop=$nx3_menu}
          {strip}
            - <a class="nx3_menu" href="{$nx3_menu[nx3_menu].menu_link}">{$nx3_menu[nx3_menu].menu_caption}</a><br/>
          {/strip}
          {/section}
