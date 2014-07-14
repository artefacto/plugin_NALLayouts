<?php
$showcasePosition = isset($options['showcase-position'])
    ? html_escape($options['showcase-position'])
    : 'none';
$showcaseFile = $showcasePosition !== 'none' && !empty($attachments);
$galleryPosition = isset($options['gallery-position'])
    ? html_escape($options['gallery-position'])
    : 'left';

    $size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'square_thumbnail';
?>
<?php if ($showcaseFile): ?>
<div class="gallery-showcase <?php echo $showcasePosition; ?> with-<?php echo $galleryPosition; ?>">
    <?php
        $attachment = array_shift($attachments);
        echo $this->exhibitAttachment($attachment, array('imageSize' => 'fullsize'));
    ?>
</div>
<?php endif; ?>
<div class="gallery <?php if ($showcaseFile) echo "with-showcase $galleryPosition"; ?>">
<div style="text-align:left;"><?php echo $text; ?></div>
<?php foreach ($attachments as $attachment): ?>
    <?php $item = $attachment->getItem(); ?>
    <?php $file = $attachment->getFile(); ?>
    <div class="exhibit-item exhibit-gallery-item">
        <?php $altText = "Thumbnail for item, linking to full sized image."; ?>
        <?php if  ($description = (metadata($item, array("Dublin Core", "Description")))): ?>
            <?php $altText =  $description; ?>
        <?php endif; ?> 
        <?php echo file_markup($file, array('imageSize'=>$size, 'imgAttributes'=>array('alt' =>  "$altText", 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>

        <?php if ($attachment['caption']): ?>
        	<div class="exhibit-item-caption">
            	<?php echo $attachment['caption'] ?>
        	</div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
    </div>
</div>
