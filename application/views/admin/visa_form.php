<div class="form">
    <form id="form_package" class="validate form-horizontal" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?=$action; ?>" />
        <?php if ($action == 'edit') { ?>
            <input type="hidden" id="page_id" name="visa[id]" value="<?=$model['id']; ?>" />
            <input type="hidden" id="status" name="visa[status]" value="<?=$model['status']; ?>" />
        <?php } ?>
            <div class="control-group">
                <label class="control-label" for="visa_title">Visa Title</label>
                <div class="controls">
                    <input class="span6" type="text" id="visa_title" name="visa[title]" value="<?=$model['title']; ?>" required >
                    <span class="help-block">Visa Title /or Visa Category.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_slug">Package Slug</label>
                <div class="controls">
                    <input class="span6 formTitleSlug" type="text" id="visa_slug" name="visa[slug]" value="<?=$model['slug']; ?>" required >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_type">Visa Type</label>
                <div class="controls">
                    <label class="radio inline">
                        <?php $checked = ($model['type'] == 'tourist') ? 'Checked = "checked"' : ''; ?>
                        <input type="radio" name="visa[type]" id="visa_type" value="tourist" <?=$checked; ?>>Tourist Visa
                    </label>
                    <label class="radio inline">
                        <?php $checked = ($model['type'] == 'service') ? 'Checked = "checked"' : ''; ?>
                        <input type="radio" name="visa[type]" id="visa_type" value="service" <?=$checked; ?>>Service Visa
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_validity">Visa Validity</label>
                <div class="controls">
                    <input class="span6" type="text" id="visa_validity" name="visa[validity]" value="<?=$model['validity']; ?>" required >
                    <span class="help-block">Validity of Visa in Days.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_duration">Process Duration</label>
                <div class="controls">
                    <input type="text" id="visa_duration" name="visa[duration]" class="span6" value="<?=$model['duration']; ?>" required>
                    <span class="help-block">Visa processing time.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_price">Visa Price</label>
                <div class="controls">
                    <input type="text" id="visa_price" name="visa[price]" class="span6" value="<?=$model['price']; ?>" required>
                    <span class="help-block">Cost per Visa (in dollors).</span>
                </div>
            </div>
            <legend>Visa Overview:</legend>
            <div class="control-group">
                <label class="control-label" for="visa_apply">How to apply</label>
                <div class="controls">
                    <textarea name="visa[apply]" id="visa_apply" rows="4" class="span8 ckeditor"><?=$model['apply']; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_documents">Documentations Required</label>
                <div class="controls">
                    <textarea name="visa[document]" id="visa_documents" rows="4" class="span8 ckeditor"><?=$model['document']; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_terms">Terms & Conditions</label>
                <div class="controls">
                    <textarea name="visa[terms]" id="visa_terms" rows="4" class="span8 ckeditor"><?=$model['terms']; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="visa_rejection">Reasons for Rejection</label>
                <div class="controls">
                    <textarea name="visa[rejection]" id="visa_rejection" rows="4" class="span8 ckeditor"><?=$model['rejection']; ?></textarea>
                </div>
            </div>
        <div class="control-group">
            <div class="controls">
                <p class="submit"><button type="submit" class="btn btn-primary"><?=ucwords(strtolower($action)); ?> Details</button></p>
            </div>
        </div>
    </form>
</div>