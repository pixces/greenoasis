    <h3 class=""><?=ucwords($action); ?> Page Details</h3>
    <div class="">
        <form id="addPage" class="validate" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_action" value="<?=$action; ?>" />
            <?php if ($action == 'edit') { ?>
            <input type="hidden" id="page_id" name="id" value="<?=$page['id']; ?>" />
            <input type="hidden" id="oldImage" name="image" value="<?=$page['image']; ?>" />
            <input type="hidden" id="status" name="status" value="<?=$page['status']; ?>" />
            <?php } ?>
        <fieldset>
            <div>
                <label for="page_title">Page Title</label>
                <input class="input-block-level" type="text" required id="page_title" type="text" value="<?=stripSlashesDeep($page['title']); ?>" name="title">
            </div>
            <div>
                <label for="title_slug">Page Slug</label>
                <input class="span6" type="text" required id="title_slug" type="text" value="<?=$page['slug']; ?>" name="slug">
            </div>
            <div>
                <label for="parent">Select Parent Page</label>
                <select class="span6" id="parent" name="parent_id">
                    <option value="0">Main Page</option>
                    <?=UTILS::createSelectOptions($pageList,$parent_id); ?>
                </select>
            </div>
            <?php if(isset($page['image']) && !empty($page['image'])) { ?>
                <div class="form-image-placeholder" style="padding-bottom: 5px">
                    <a href="javascript:void(0);" class="form-change-image"><img class="img-polaroid" src="<?=SITE_UPLOAD.IMG_THUMB.$page['image']; ?>"><br />
                    <span>Click to change image</span></a>
                </div>
                <div style="display:none" class="form-image-upload">
            <?php } else { ?>
                <div class="form-image-upload">
            <?php } ?>
                <label for="image">Upload Image (if any)</label>
                <input class="span6" type="file" id="image" name="image">
                <span class="help-block">Attach image to page.<br />Upload image preferable 300 x 350px to attach to page.<br />All images will be left aligned.</span>
            </div>
            <div>
                <label for="video">Video Url (if any)</label>
                <input class="span6" type="text" id="video" name="video_url" value="<?=stripSlashesDeep($page['video_url']); ?>">
                <span class="help-block">Add Youtube / Vimeo video link url. Video will be displayed at the end of the page.</span>
            </div>
            <div>
                <label for="content">Page Content</label>
                <textarea name="content" id="content" rows="15" class="input-block-level ckeditor"><?=stripSlashesDeep($page['content']); ?></textarea>
            </div>
        </fieldset>
        <fieldset>
            <legend>Page Meta Details</legend>

            <div>
                <label for="meta_title">Page Meta Title</label>
                <textarea name="meta_title" id="meta_title" rows="2" class="input-block-level"><?=stripSlashesDeep($page['meta_title']); ?></textarea>
            </div>
            <div>
                <label for="meta_keyword">Page Meta Keywords</label>
                <textarea name="meta_keyword" id="meta_keyword" rows="2" class="input-block-level"><?=stripSlashesDeep($page['meta_keyword']); ?></textarea>
            </div>
            <div>
                <label for="meta_description">Page Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="2" class="input-block-level"><?=stripSlashesDeep($page['meta_description']); ?></textarea>
            </div>
        </fieldset>
        <p class="submit"><button type="submit" class="btn btn-primary">Save Page</button></p>
        </form>
    </div>
</div>