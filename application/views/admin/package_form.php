<div class="form">
    <form id="form_package" class="validate form-horizontal" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?=$action; ?>" />
        <?php if ($action == 'edit') { ?>
            <input type="hidden" id="page_id" name="package[id]" value="<?=$model['Package']['id']; ?>" />
            <input type="hidden" id="status" name="package[status]" value="<?=$model['Package']['status']; ?>" />
        <?php } ?>
            <div class="control-group">
                <label class="control-label" for="package_title">Package Title</label>
                <div class="controls">
                    <input class="span6" type="text" id="package_title" name="package[title]" value="<?=$model['Package']['title']; ?>" required >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_slug">Package SEF</label>
                <div class="controls">
                    <input class="span6 formTitleSlug" type="text" id="package_slug" name="package[slug]" value="<?=$model['Package']['slug']; ?>" required >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_type">Package Type</label>
                <div class="controls">
                    <label class="radio inline">
                        <?php $checked = ($model['Package']['type'] == 'tour') ? 'Checked = "checked"' : ''; ?>
                        <input type="radio" name="package[type]" id="package_type" value="tour" <?=$checked; ?>>Tour Package
                    </label>
                    <label class="radio inline">
                        <?php $checked = ($model['Package']['type'] == 'combo') ? 'Checked = "checked"' : ''; ?>
                        <input type="radio" name="package[type]" id="package_type" value="combo" <?=$checked; ?>>Combo Deal
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Package Category</label>
                <div class="controls">
                    <?php echo $html->select('package[category]',$categoryOptions, $model['Package']['category']); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_duration">Package Duration</label>
                <div class="controls">
                    <input type="text" id="package_duration" name="package[duration]" class="span6" value="<?=$model['Package']['duration']; ?>" required>
                </div>
            </div>
            <legend>Tour Overview:</legend>
            <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                    <textarea name="package[description]" id="package_description" rows="4" class="span8 ckeditor"><?=$model['Package']['description']; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_inclusions">Inclusions</label>
                <div class="controls">
                    <textarea name="package[inclusions]" id="package_inclusions" rows="4" class="span8 ckeditor"><?=$model['Package']['inclusions']; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_exclusion">Exclusion</label>
                <div class="controls">
                    <textarea name="package[exclusions]" id="package_exclusion" rows="4" class="span8 ckeditor"><?=$model['Package']['exclusions']; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_terms">Terms & Conditions</label>
                <div class="controls">
                    <textarea name="package[terms]" id="package_terms" rows="4" class="span8 ckeditor"><?=$model['Package']['terms']; ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_info">Useful Information</label>
                <div class="controls">
                    <textarea name="package[info]" id="package_info" rows="4" class="span8 ckeditor"><?=$model['Package']['info']; ?></textarea>
                </div>
            </div>
            <legend>Package Timings:</legend>
            <div class="control-group">
                <div class="controls">
                    <!-- will have table for time entry //-->
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Duration</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Reporting Time</th>
                                <th>Pickup</th>
                                <th>Operation Days</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=0;
                            if ($model['Package_Time']) {
                                foreach($model['Package_Time'] as $time){
                        ?>
                            <tr id="package_time-row-<?=$i; ?>">
                                <input type="hidden" name="package[time][<?=$i; ?>][id]" value="<?=$time['Package_Time']['id']; ?>">
                                <td><input class="span1" type="text" name="package[time][<?=$i; ?>][duration]" value="<?=$time['Package_Time']['duration']; ?>"></td>
                                <td><input class="span2" type="text" name="package[time][<?=$i; ?>][start]" value="<?=$time['Package_Time']['start']; ?>"></td>
                                <td><input class="span2" type="text" name="package[time][<?=$i; ?>][end]" value="<?=$time['Package_Time']['end']; ?>"></td>
                                <td><input class="span2" type="text" name="package[time][<?=$i; ?>][reporting]" value="<?=$time['Package_Time']['reporting']; ?>"></td>
                                <td><input class="span2" type="text" name="package[time][<?=$i; ?>][pickup]" value="<?=$time['Package_Time']['pickup']; ?>"></td>
                                <td><input class="span3" type="text" name="package[time][<?=$i; ?>][operation]" value="<?=$time['Package_Time']['operation']; ?>"></td>
                                <td></td>
                            </tr>
                            <?php
                                $i++;} }
                                for($t = $i; $t < (5+$i); $t++){
                            ?>
                                <tr id="package_time-row-<?=$t; ?>">
                                    <td><input class="span1" type="text" name="package[time][<?=$t; ?>][duration]" value=""></td>
                                    <td><input class="span2" type="text" name="package[time][<?=$t; ?>][start]" value=""></td>
                                    <td><input class="span2" type="text" name="package[time][<?=$t; ?>][end]" value=""></td>
                                    <td><input class="span2" type="text" name="package[time][<?=$t; ?>][reporting]" value=""></td>
                                    <td><input class="span2" type="text" name="package[time][<?=$t; ?>][pickup]" value=""></td>
                                    <td><input class="span3" type="text" name="package[time][<?=$t; ?>][operation]" value=""></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <legend>Package Rates:</legend>
            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                    <!-- will have table for rate entry //-->
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Rate Type</th>
                            <th>Transfer Type</th>
                            <th>Pax Unit</th>
                            <th>Price</th>
                            <th>Price Child</th>
                            <th>Language</th>
                            <th>Vehicle Type</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $z=0;
                            if ($model['Package_Rate']) {
                            foreach($model['Package_Rate'] as $rate){
                        ?>
                        <tr id="package_rate-row-<?=$z; ?>">
                            <input type="hidden" name="package[rate][<?=$z; ?>][id]" value="<?=$rate['Package_Rate']['id']; ?>">
                            <td><input class="span2" type="text" name="package[rate][<?=$z; ?>][type]" value="<?=$rate['Package_Rate']['type']; ?>"></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$z; ?>][transfer_type]" value="<?=$rate['Package_Rate']['transfer_type']; ?>"></td>
                            <td><input class="span1" type="text" name="package[rate][<?=$z; ?>][pax_unit]" value="<?=$rate['Package_Rate']['pax_unit']; ?>"></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$z; ?>][price]" value="<?=$rate['Package_Rate']['price']; ?>"></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$z; ?>][price_child]" value="<?=$rate['Package_Rate']['price_child']; ?>"></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$z; ?>][language]" value="<?=$rate['Package_Rate']['language']; ?>"></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$z; ?>][vehicle]" value="<?=$rate['Package_Rate']['vehicle']; ?>"></td>
                            <td></td>
                        </tr>
                        <?php
                            $z++;} }
                            for($t = $z; $t < (5+$z); $t++){
                        ?>
                        <tr id="package_rate-row-<?=$t; ?>">
                            <td><input class="span2" type="text" name="package[rate][<?=$t; ?>][type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$t; ?>][transfer_type]" value=""></td>
                            <td><input class="span1" type="text" name="package[rate][<?=$t; ?>][pax_unit]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$t; ?>][price]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$t; ?>][price_child]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$t; ?>][language]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][<?=$t; ?>][vehicle]" value=""></td>
                            <td><a href=""><i class="icon-minus-sign"></i></a></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="control-group">
            <div class="controls">
                <p class="submit"><button type="submit" class="btn btn-primary"><?=ucwords(strtolower($action)); ?> Details</button></p>
            </div>
        </div>

    </form>
</div>