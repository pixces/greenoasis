<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1>Hotel: Advance Search</h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="content-left">
                <h1>Instructions</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <form class="form-horizontal hotel-advance-search" name="advanceSearch" id="hotelSearch" action="<?=SITE_URL.'/hotel/search/'; ?>" method="post">
                    <input type="hidden" name="search_type" id="searchType" value="advance">
                    <input type="hidden" name="request_type" id="requestType" value="gethotel">
                    <input type="hidden" name="area" value="">
                    <div>
                        <label>Place to stay..</label>
                        <input type="text" class="span7" id="txtLocation" name="location" data-provide="typeahead" data-source='["Bahrain, Bahrain","Manama, Bahrain","Muscat, Oman","Salalah, Oman","Doha, Qatar","Abu Dhabi, United Arab Emirates","Ajman, United Arab Emirates","Alain, United Arab Emirates","Dubai, United Arab Emirates","Fujairah, United Arab Emirates","Hatta, United Arab Emirates","Khorfakkan, United Arab Emirates","Ras Al Khaimah, United Arab Emirates","Sharjah, United Arab Emirates","Umm Al Quwain, United Arab Emirates", "Bahrain", "Qatar", "Oman", "United Arab Emirates"]' data-items="10" placeholder="Country, City, Hotel Name to stay..." required>
                        <span class="help-block">Example block-level help text here.</span>
                    </div>
                    <div>
                        <span class="pull-left pdR15">
                            <label>Check in:</label>
                            <div id="dpCheckin" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                                <input id="txtCheckin" name="checkin" class="span2" type="text" readonly value="<?=date('d-m-Y'); ?>" placeholder="Check In" required="required">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </span>
                        <span class="pull-left pdR15">
                            <label>No. of Nights</label>
                            <select class="span1" name="nights" id="txtDaysStay" required="required">
                                <?php for($x=0; $x<=30; $x++){
                                    $selected = ($x == 2) ? 'selected="selected"' : '';
                                ?>
                                    <option value="<?=$x; ?>" <?=$selected; ?>><?=$x; ?></option>
                                <?php } ?>
                            </select>
                        </span>
                        <span class="pdR15">
                            <label>Check out:</label>
                            <div id="dpCheckout" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                                <input id="txtCheckout" name="checkout" class="span2" type="text" readonly value="<?=date('d-m-Y', (time()+(2*24*60*60))); ?>" placeholder="Check Out" required="required">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </span>
                    </div>
                    <div>
                        <span class="pull-left pdR15">
                            <label>No. of Rooms:</label>
                            <select class="span2" name="rooms" id="txtRoomCount" required="required">
                                <?php for($x=1; $x<=5; $x++){ ?>
                                    <option value="<?=$x; ?>"><?=$x." Room(s)"; ?></option>
                                <?php } ?>
                            </select>
                        </span>
                        <span>
                            <label>Room Type:</label>
                           <select class="span2" name="roomtype" id="txtRoomType" required="required">
                               <option value="Sgl">Single Room</option>
                               <option value="Dbl">Double Room</option>
                               <option value="Tpl">Triple Room</option>
                               <option value="Unit">Unit Room</option>
                           </select>
                        </span>
                        <span class="help-block">Select the checking and Checkout date.</span>
                    </div>
                    <div>
                        <span class="pull-left pdR15">
                            <label>Adults (+12 yrs):</label>
                            <select class="span2" name="adult" id="txtPaxAdult" required="required">
                                <?php for($x=1; $x<=6; $x++){ ?>
                                    <option value="<?=$x; ?>"><?=$x; ?></option>
                                <?php } ?>
                            </select>
                        </span>
                        <span>
                            <label>Children (0-12 yrs):</label>
                           <select class="span2" name="child" id="txtPaxChild" required="required">
                               <?php for($x=0; $x<=5; $x++){ ?>
                                   <option value="<?=$x; ?>"><?=$x; ?></option>
                               <?php } ?>
                           </select>
                        </span>
                    </div>
                    <div>
                        <button class="btn btn-green frm-btn-bottom" type="submit"><i class="icon-search icon-white"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="sidebar pull-right">
            <?php foreach(Utils::getBanners('small') as $banner){ ?>
                <div class="widget adv300-170">
                    <a href="<?=$banner['url']; ?>" class="">
                        <img src="<?=$banner['image']; ?>" width="300" height="250"/>
                    </a>
                </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->
