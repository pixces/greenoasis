<div class="hotel-detail-box">
    <header class="section-title"><?=$model['title']; ?></header>
    <p><?=$model['type']; ?></p>
    <p><?=$model['category']; ?></p>
</div>

<section class="image-form-wrapper box-shadow pull-left">
    <header class="section-title">Upload Image</header>
    <?php if($imgCount >= MAX_IMAGE_COUNT){ ?>
        <h5>Maximum Image upload reached.</h5>
        <p>A maximum of <?=MAX_IMAGE_COUNT; ?> images can be uploaded for a hotel.</p>
        <p>There are <strong><?=$imgCount; ?> images</strong> already added for hotel<br><strong>"<?=$hotel['hotel_name']; ?>"</strong></p>
    <?php } else { ?>
    <p>Add the form below to upload image for this hotel.</p>
    <ul>
        <li>Maximum 10 images allowed.</li>
        <li>Image size not to exceed 1 MB each.</li>
        <li>Image dimension not to exceed 800 x 800px</li>
    </ul>
    <form class="image-upload vertical" name="image-upload" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="package_id" value="<?=$model['id']; ?>">
        <input type="hidden" name="form_action" value="uploadImage">
        <div>
            <label>Image Caption</label>
            <input type="text" class="span5" placeholder="Enter image caption.." name="image_caption">
        </div>
        <div>
            <label>Upload Image</label>
            <input type="file" placeholder="Type something…" name="image" required>
            <span class="help-block">Browse to upload image.</span>
        </div>
        <button type="submit" class="btn btn-primary">Submit Image</button>
    </form>
    <?php } ?>
</section>
<section class="manage-image">
    <header class="section-title">Manage Image</header>
    <p>Manage all uploaded images. You can remove the image and add new image using the form alongside.</p>
    <p>There are <?=$imageCount; ?> images added.</p>
    <?php if ($imageList) {
        foreach ($imageList as $image) { ?>
    <div id="package_image-<?=$image['id']; ?>" class="pull-left">
        <img class="img-polaroid" src="<?=SITE_UPLOAD.PREFIX_THUMB.$image['image_name']; ?>" width="<?=IMG_WIDTH_THUMB; ?>" height="<?=IMG_HEIGHT_THUMB; ?>">
        <a class="delete-link btn btn-mini" href="#" id="<?=$image['id']; ?>" data-type="package_image" data-action="delete" date-value="<?=$image['id']; ?>" data-title="<?=$image['image_caption']; ?>" title="Delete image <?=$image['image_caption']; ?>"><i class="icon-trash"></i> Delete</a>
    </div>
    <?php } } ?>
</section>