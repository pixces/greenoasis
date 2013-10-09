<div class="content bg-white">
    <div class="container">
        <div class="heading">
            <h1>Hotel: Advance Search</h1>
        </div>
        <div class="bg-blue-grey span8">
            <form class="form-horizontal" action="<?=SITE_URL.'/hotel/search/'; ?>">
                <div class="control-group">
                    <label class="control-label" for="selectCountry">Country</label>
                    <div class="controls">
                        <select id="selectCountry" class="span4">
                            <option value="">--- Select Country ---</option>
                            <option value="bahrain">Bahrain</option>
                            <option value="oman">Oman</option>
                            <option value="qatar">Qatar</option>
                            <option value="UAE">United Arab Emirates</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectCity">City</label>
                    <div class="controls">
                        <select id="selectCity" class="span4">
                            <option value="">--- Select City ---</option>
                            <option value="bahrain">Bahrain</option>
                            <option value="oman">Oman</option>
                            <option value="qatar">Qatar</option>
                            <option value="UAE">United Arab Emirates</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dpCheckin">Stay Duration</label>
                    <div class="controls">
                        <div id="dpCheckin" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                            <input name="date_checkin" class="span2" type="text" readonly value="" placeholder="Check In" required>
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                        <div id="dpCheckout" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                            <input name="date_checkout" class="span2" type="text" readonly value="" placeholder="Check Out" required>
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="roomsNo">No. of Rooms</label>
                    <div class="controls">
                        <select id="roomsNo">
                            <option>--- Select Rooms ---</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="roomType">Room Type</label>
                    <div class="controls">
                        <select id="roomType">
                            <option>--- Room Type ---</option>
                            <option>Single Room</option>
                            <option>Double Room</option>
                            <option>Double Room with One Child</option>
                            <option>Double Room with Two Child</option>
                            <option>Twin Room</option>
                            <option>Twin Room with 1 Child</option>
                            <option>Twin Room with 2 Child</option>
                            <option>Triple Room</option>
                            <option>Quad Room</option>
                        </select>
                        <select class="span1" disabled="">
                            <option>Age</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                        <select class="span1" disabled="">
                            <option>Age</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="hotelStars">Hotel Stars</label>
                    <div class="controls">
                        <label class="radio inline">
                            <input type="radio" name="hotel_stars" id="inputStar" value="0" <?=$hotel['hotel_stars'] == 0 ? 'checked' : ''; ?> >
                            All
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
                        <label class="radio inline">
                            <input type="radio" name="hotel_stars" id="inputStar5" value="5" <?=$hotel['hotel_stars'] == 5 ? 'checked' : ''; ?>>
                            <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectRegion">Region</label>
                    <div class="controls">
                        <select id="selectRegion">
                            <option>--- Select Region ---</option>
                            <option>All Regions</option>
                            <option value="gcc">Only GCC</option>
                            <option value="intl">International</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label class="radio inline">
                            <input type="radio" name="hotel_stars" id="inputStar4" value="4" <?=$hotel['hotel_stars'] == 4 ? 'checked' : ''; ?>>
                            Display all with rates
                        </label>
                        <label class="radio inline">
                            <input type="radio" name="hotel_stars" id="inputStar5" value="5" <?=$hotel['hotel_stars'] == 5 ? 'checked' : ''; ?>>
                            Display only available
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-green"><i class="icon-search"></i> Search Hotel</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="span6">
            These are form instructions. Use these instructions for completing the forms
        </div>
    </div>
</div>
