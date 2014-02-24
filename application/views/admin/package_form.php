<div class="form">
    <form id="form_package" class="validate form-horizontal" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?=$action; ?>" />
        <?php if ($action == 'edit') { ?>
            <input type="hidden" id="page_id" name="id" value="<?=$package['id']; ?>" />
            <input type="hidden" id="status" name="status" value="<?=$package['status']; ?>" />
        <?php } ?>
            <div class="control-group">
                <label class="control-label" for="package_title">Package Title</label>
                <div class="controls">
                    <input class="span6" type="text" id="package_title" name="package[title]" value="" required >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_slug">Package SEF</label>
                <div class="controls">
                    <input class="span6 formTitleSlug" type="text" id="package_slug" name="package[slug]" value="<?=$hotel['hotel_name']; ?>" required >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_type">Package Type</label>
                <div class="controls">
                    <label class="radio inline">
                        <input type="radio" name="package[type]" id="package_type" value="tour" checked="checked">Tour Package
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="package[type]" id="package_type" value="combo">Combo Deal
                    </label>

                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Package Category</label>
                <div class="controls">
                    <?php echo $html->select('package[category]',$categoryOptions); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_duration">Package Duration</label>
                <div class="controls">
                    <input type="text" id="package_duration" name="package[duration]" class="span6" value="" required>
                </div>
            </div>
            <legend>Tour Overview:</legend>
            <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                    <textarea name="package[description]" id="package_description" rows="4" class="span8 ckeditor"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_inclusions">Inclusions</label>
                <div class="controls">
                    <textarea name="package[inclusions]" id="package_inclusions" rows="4" class="span8 ckeditor"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_terms">Terms & Conditions</label>
                <div class="controls">
                    <textarea name="package[terms]" id="package_terms" rows="4" class="span8 ckeditor"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="package_info">Useful Information</label>
                <div class="controls">
                    <textarea name="package[info]" id="package_info" rows="4" class="span8 ckeditor"></textarea>
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
                            <tr id="package_time-row-0">
                                <td><input class="span1" type="text" name="package[time][0][duration]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][0][start]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][0][end]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][0][reporting]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][0][pickup]" value=""></td>
                                <td><input class="span3" type="text" name="package[time][0][operation]" value=""></td>
                                <td></td>
                            </tr>
                            <tr id="package_time-row-1">
                                <td><input class="span1" type="text" name="package[time][1][duration]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][1][start]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][1][end]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][1][reporting]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][1][pickup]" value=""></td>
                                <td><input class="span3" type="text" name="package[time][1][operation]" value=""></td>
                                <td><a href=""><i class="icon-minus-sign"></i></a></td>
                            </tr>
                            <tr id="package_time-row-2">
                                <td><input class="span1" type="text" name="package[time][2][duration]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][2][start]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][2][end]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][2][reporting]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][2][pickup]" value=""></td>
                                <td><input class="span3" type="text" name="package[time][2][operation]" value=""></td>
                                <td><a href=""><i class="icon-minus-sign"></i></a></td>
                            </tr>
                            <tr id="package_time-row-3">
                                <td><input class="span1" type="text" name="package[time][3][duration]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][3][start]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][3][end]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][3][reporting]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][3][pickup]" value=""></td>
                                <td><input class="span3" type="text" name="package[time][3][operation]" value=""></td>
                                <td><a href=""><i class="icon-minus-sign"></i></a></td>
                            </tr>
                            <tr id="package_time-row-4">
                                <td><input class="span1" type="text" name="package[time][4][duration]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][4][start]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][4][end]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][4][reporting]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][4][pickup]" value=""></td>
                                <td><input class="span3" type="text" name="package[time][4][operation]" value=""></td>
                                <td><a href=""><i class="icon-minus-sign"></i></a></td>
                            </tr>
                            <tr id="package_time-row-5">
                                <td><input class="span1" type="text" name="package[time][5][duration]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][5][start]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][5][end]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][5][reporting]" value=""></td>
                                <td><input class="span2" type="text" name="package[time][5][pickup]" value=""></td>
                                <td><input class="span3" type="text" name="package[time][5][operation]" value=""></td>
                                <td><a href=""><i class="icon-plus-sign"></i></a></td>
                            </tr>
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
                            <th>Price</th>
                            <th>Price Child</th>
                            <th>Language</th>
                            <th>Vehicle Type</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="package_rate-row-0">
                            <td><input class="span2" type="text" name="package[rate][0][type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][0][transfer_type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][0][price]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][0][price_child]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][0][language]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][0][vehicle]" value=""></td>
                            <td></td>
                        </tr>
                        <tr id="package_rate-row-1">
                            <td><input class="span2" type="text" name="package[rate][1][type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][1][transfer_type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][1][price]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][1][price_child]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][1][language]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][1][vehicle]" value=""></td>
                            <td><a href=""><i class="icon-minus-sign"></i></a></td>
                        </tr>
                        <tr id="package_rate-row-2">
                            <td><input class="span2" type="text" name="package[rate][2][type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][2][transfer_type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][2][price]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][2][price_child]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][2][language]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][2][vehicle]" value=""></td>
                            <td><a href=""><i class="icon-minus-sign"></i></a></td>
                        </tr>
                        <tr id="package_rate-row-3">
                            <td><input class="span2" type="text" name="package[rate][3][type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][3][transfer_type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][3][price]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][3][price_child]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][3][language]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][3][vehicle]" value=""></td>
                            <td><a href=""><i class="icon-minus-sign"></i></a></td>
                        </tr>
                        <tr id="package_rate-row-4">
                            <td><input class="span2" type="text" name="package[rate][4][type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][4][transfer_type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][4][price]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][4][price_child]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][4][language]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][4][vehicle]" value=""></td>
                            <td><a href=""><i class="icon-minus-sign"></i></a></td>
                        </tr>
                        <tr id="package_rate-row-5">
                            <td><input class="span2" type="text" name="package[rate][5][type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][5][transfer_type]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][5][price]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][5][price_child]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][5][language]" value=""></td>
                            <td><input class="span2" type="text" name="package[rate][5][vehicle]" value=""></td>
                            <td><a href=""><i class="icon-plus-sign"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="control-group">
            <div class="controls">
                <p class="submit"><button type="submit" class="btn btn-primary">Save Hotel Details</button></p>
            </div>
        </div>

    </form>
</div>