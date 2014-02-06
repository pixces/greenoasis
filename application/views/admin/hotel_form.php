<div class="">
    <form id="form_hotel" class="validate form-horizontal" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?=$action; ?>" />
        <?php if ($action == 'edit') { ?>
            <input type="hidden" id="page_id" name="id" value="<?=$hotel['id']; ?>" />
            <input type="hidden" id="oldLogo" name="image" value="<?=$hotel['hotel_logo']; ?>" />
            <input type="hidden" id="status" name="status" value="<?=$hotel['status']; ?>" />
        <?php } ?>
        <fieldset>
            <legend>Basic Hotel Information:</legend>
            <div class="control-group">
                <label class="control-label" for="inputName">Hotel Name</label>
                <div class="controls">
                    <input class="span6" type="text" id="inputName" placeholder="Name of the Hotel" name="hotel_name" value="<?=$hotel['hotel_name']; ?>" required >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Star Rating</label>
                <div class="controls">
                    <label class="radio inline">
                        <input type="radio" name="hotel_stars" id="inputStar0" value="0" <?=$hotel['hotel_stars'] == 0 ? 'checked' : ''; ?> >
                        None
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="hotel_stars" id="inputStar1" value="1" <?=$hotel['hotel_stars'] == 1 ? 'checked' : ''; ?>>
                        <i class="icon-star"></i>
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="hotel_stars" id="inputStar2" value="2" <?=$hotel['hotel_stars'] == 2 ? 'checked' : ''; ?>>
                        <i class="icon-star"></i><i class="icon-star"></i>
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="hotel_stars" id="inputStar3" value="3" <?=$hotel['hotel_stars'] == 3 ? 'checked' : ''; ?>>
                        <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="hotel_stars" id="inputStar4" value="4" <?=$hotel['hotel_stars'] == 4 ? 'checked' : ''; ?>>
                        <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                    </label>
                    <label class="radio inline  ">
                        <input type="radio" name="hotel_stars" id="inputStar5" value="5" <?=$hotel['hotel_stars'] == 5 ? 'checked' : ''; ?>>
                        <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputManager">Hotel Managed By</label>
                <div class="controls">
                    <input class="span6" type="text" id="inputManager" name="manager" value="<?=$hotel['manager']; ?>">
                    <span class="help-block">Name of the Group / Manager.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputAddress">Hotel Address</label>
                <div class="controls">
                    <textarea name="hotel_address" id="inputAddress" rows="2" class="span6" required><?=Utils::stripSlashesDeep($hotel['hotel_address']); ?></textarea>
                    <span class="help-block">Hotel address, with landmark.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputCity">City</label>
                <div class="controls">
                    <input type="text" id="inputCity" name="hotel_city" class="span6" value="<?=$hotel['hotel_city']; ?>" required>
                    <span class="help-block">Enter city, where hotel is located.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputArea">Area/Locality</label>
                <div class="controls">
                    <input type="text" id="inputArea" name="hotel_area" class="span6" value="<?=$hotel['hotel_area']; ?>" required>
                    <span class="help-block">Enter area within the city, where hotel is located.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Country</label>
                <div class="controls">
                    <label class="radio inline">
                        <input type="radio" name="hotel_country" id="inputCountry1" value="uae" <?=$hotel['hotel_country'] == 'uae' ? 'checked' : ''; ?>>
                        United Arab Emirates
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="hotel_country" id="inputCountry2" value="saudi" <?=$hotel['hotel_country'] == 'saudi' ? 'checked' : ''; ?>>
                        Saudi Arabia
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="hotel_country" id="inputCountry3" value="oman" <?=$hotel['hotel_country'] == 'oman' ? 'checked' : ''; ?>>
                        Oman
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="hotel_country" id="inputCountry4" value="egypt" <?=$hotel['hotel_country'] == 'egypt' ? 'checked' : ''; ?>>
                        Egypt
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPhone">Phone</label>
                <div class="controls">
                    <input class="span6" type="text" id="inputPhone" name="hotel_phone" value="<?=$hotel['hotel_phone']; ?>" required>
                    <span class="help-block">Add multiple phone numbers seperated by 'comma'.</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputFax">Fax</label>
                <div class="controls">
                    <input class="span6" type="text" id="inputFax" name="hotel_fax" value="<?=$hotel['hotel_fax']; ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                    <input class="span6" type="text" id="inputEmail" name="hotel_email" value="<?=$hotel['hotel_email']; ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputWebsite">Website</label>
                <div class="controls">
                    <input class="span6" type="text" id="inputWebsite" name="hotel_website" value="<?=$hotel['hotel_website']; ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDetails">Hotel Details</label>
                <div class="controls">
                    <textarea name="hotel_details" id="inputDetails" rows="3" class="span6" required><?=Utils::stripSlashesDeep($hotel['hotel_details']); ?></textarea>
                    <span class="help-block">Add hotel details</span>
                </div>
            </div>

            <?php if ( ($action == 'edit') && ($hotel['hotel_logo']) ) { ?>
                <div class="control-group imageDisplay">
                    <label class="control-label">Hotel Logo</label>
                    <div class="controls">
                        <div><img src="<?=SITE_UPLOAD.PREFIX_IMG_LOGO.$hotel['hotel_logo']; ?>"></div>
                        <p><a id="changeImage" class="remove-image" href="javascript:void(0);">Remove Image</a></p>
                    </div>
                </div>
            <?php } ?>

            <div class="uploadImage control-group" <?php if ($action == 'edit' && $hotel['hotel_logo'] != '') { echo 'style="display:none"'; }; ?> >
                <label class="control-label" for="inputLogo">Upload Hotel Logo</label>
                <div class="controls">
                    <input class="span6" type="file" id="inputLogo" name="image">
                    <span class="help-block">Logo preferable 250 x 750px in size. All images will be left aligned.</span>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Hotel Rules & Policies:</legend>
            <div class="control-group">
                <label class="control-label">Hotel Amenities</label>
                <div class="controls amenities">
                    <?php echo $html->checkbox('amenities',$amenities,json_decode($hotel['amenities'],true) ); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="checkInOut_policy">Checkin/Checkout Policy</label>
                <div class="controls">
                    <textarea name="policy_checkinout" id="checkInOut_policy" rows="2" class="span8"><?=Utils::stripSlashesDeep($hotel['policy_checkinout']); ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="room_terms">Room Terms</label>
                <div class="controls">
                    <textarea name="policy_room_terms" id="room_terms" rows="2" class="span8"><?=Utils::stripSlashesDeep($hotel['policy_room_terms']); ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="room_occupancy">Room Occupancy</label>
                <div class="controls">
                    <textarea name="policy_occupancy" id="room_occupancy" rows="2" class="span8"><?=Utils::stripSlashesDeep($hotel['policy_occupancy']); ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="child_policy">Child Policy</label>
                <div class="controls">
                    <textarea name="policy_child" id="child_policy" rows="2" class="span8"><?=Utils::stripSlashesDeep($hotel['policy_child']); ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="cancellation_policy">Cancellation Policy</label>
                <div class="controls">
                    <textarea name="policy_cancellation" id="cancellation_policy" rows="2" class="span8"><?=Utils::stripSlashesDeep($hotel['policy_cancellation']); ?></textarea>
                </div>
            </div>
        </fieldset>
        <div class="control-group">
            <div class="controls">
                <p class="submit"><button type="submit" class="btn btn-primary">Save Hotel Details</button></p>
            </div>
        </div>

    </form>
</div>