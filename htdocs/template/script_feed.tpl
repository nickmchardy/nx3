<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title>{$script_feed_title}</title>
    <link>{$script_feed_link}</link>
    <description>{$script_feed_description}</description>
  {section name=script_feed_items loop=$script_feed_items}
    {strip}
      <item>
        <guid>{$script_feed_items[script_feed_items].script_feed_item_guid}</guid>
        <title>{$script_feed_items[script_feed_items].script_feed_item_title}</title>
        <link>{$script_feed_items[script_feed_items].script_feed_item_link}</link>
        <description>{$script_feed_items[script_feed_items].script_feed_item_description}</description>
        <pubDate>{$script_feed_items[script_feed_items].script_feed_item_pub_date}</pubDate>
      </item>
    {/strip}
  {/section}    
  </channel>
</rss>