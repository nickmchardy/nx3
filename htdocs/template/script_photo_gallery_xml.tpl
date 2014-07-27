<?xml version="1.0" encoding="UTF-8"?>
<simpleviewergallery maxImageWidth="500" maxImageHeight="500" textColor="0xFFFFFF" frameColor="0xFFFFFF" frameWidth="1" stagePadding="0" navPadding="20" thumbnailColumns="3" thumbnailRows="3" navPosition="left" vAlign="center" hAlign="center" title="{$script_photo_gallery_title}" enableRightClickOpen="true" backgroundImagePath="" imagePath="{$script_photo_gallery_image_path}" thumbPath="{$script_photo_gallery_thumb_path}">
  {section name=script_photo_gallery_images loop=$script_photo_gallery_images}
    {strip}
      <image>
        <filename>{$script_photo_gallery_images[script_photo_gallery_images].filename}</filename>
        <caption><![CDATA[<b>{$script_photo_gallery_images[script_photo_gallery_images].title}</b> {$script_photo_gallery_images[script_photo_gallery_images].date_taken}<br/><i>{$script_photo_gallery_images[script_photo_gallery_images].description}</i>]]></caption>	
      </image>
    {/strip}
  {/section}    
</simpleviewergallery>