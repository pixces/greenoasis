<!-- Start: Banner --->
<div class="banner container">
    <div id="gallery">
        <a href="#" class="show"><img src="<?=SITE_URL; ?>/images/001.jpg" alt="Flowing Rock" title="" alt="" rel=""/></a>
        <a href="#"><img src="<?=SITE_URL; ?>/images/002.jpg" alt="Grass Blades" title="" alt="" rel=""/></a>
        <a href="#"><img src="<?=SITE_URL; ?>/images/003.jpg" alt="Ladybug" title="" alt="" rel=""/></a>
        <a href="#"><img src="<?=SITE_URL; ?>/images/004.jpg" alt="Lightning" title="" alt="" rel=""/></a>
        <div class="caption">
            <div class="content"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- End: Banner --->
<!-- Start: Basic Search -->
<div class="basic-search container">
    <form class="form-inline" name="basicHotelSearch" id="hotelSearch" action="<?=SITE_URL.'/hotel/search/'; ?>" method="post">
        <input type="hidden" name="search_type" id="searchType" value="basic">
        <input type="hidden" name="request_type" id="requestType" value="gethotel">
        <div class="frm-destination">
            <input type="hidden" name="area" value="">
            <label>Place to stay..</label>
            <input type="text" class="span6" id="txtLocation" name="location" data-provide="typeahead" data-source='["Bahrain, Bahrain","Manama, Bahrain","Muscat, Oman","Salalah, Oman","Doha, Qatar","Abu Dhabi, United Arab Emirates","Ajman, United Arab Emirates","Alain, United Arab Emirates","Dubai, United Arab Emirates","Fujairah, United Arab Emirates","Hatta, United Arab Emirates","Khorfakkan, United Arab Emirates","Ras Al Khaimah, United Arab Emirates","Sharjah, United Arab Emirates","Umm Al Quwain, United Arab Emirates", "Bahrain", "Qatar", "Oman", "United Arab Emirates"]' data-items="10" placeholder="Country, City, Hotel Name to stay..." required>
        </div>
        <div class="frm-date">
            <label>Check in:</label>
            <div id="dpCheckin" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                <input id="txtCheckin" name="checkin" class="span2" type="text" readonly value="<?=date('d-m-Y'); ?>" placeholder="Check In" required="required">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
        </div>
        <div class="frm-date">
            <label>Check out:</label>
            <div id="dpCheckout" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
                <input id="txtCheckout" name="checkout" class="span2" type="text" readonly value="<?=date('d-m-Y', (time()+(24*60*60))); ?>" placeholder="Check Out" required="required">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
        </div>
        <div class="frm-meta">
            <label>Rooms:</label>
            <select class="span2" name="rooms" id="txtRoomCount" required="required">
                <option value="1">1 Room</option>
                <option value="2">2 Rooms</option>
                <option value="3">3 Rooms</option>
            </select>
        </div>
        <div class="frm-meta">
            <label>Room Type:</label>
            <select class="span2" name="roomtype" id="txtRoomType" required="required">
                <option value="Sgl">Single Room</option>
                <option value="Dbl">Double Room</option>
                <option value="Tpl">Triple Room</option>
                <option value="Unit">Unit Room</option>
            </select>
        </div>
        <button class="btn btn-green frm-btn-bottom" type="submit"><i class="icon-search icon-white"></i> Search</button>
    </form>
</div>
<!-- End: Basic Search -->
<!-- Start: Featured Hotels -->
<div class="container">
    <!-- section class="featured hotel-list">
        <h1>Featured Hotels</h1>
        <div class="hotel-item-box01 pull-left" data-name="Costa Baja Resort">
            <img src="<?=SITE_URL; ?>/images/img01.png" width="258" height="132" />
            <span class="hotel-meta-details pull-left">Costa Baja Resort &amp; Spa La Paz, <br /> Baja California Sur, Mexico</span>
            <span class="hotel-meta-savings pull-left">49% SAVINGS</span>
            <div class="clearfix"></div>
        </div>
        <div class="hotel-item-box01 pull-left" data-name="Costa Baja Resort">
            <img src="<?=SITE_URL; ?>/images/img01b.png" width="258" height="132" />
            <span class="hotel-meta-details pull-left">Costa Baja Resort &amp; Spa La Paz, <br /> Baja California Sur, Mexico</span>
            <span class="hotel-meta-savings pull-left">49% SAVINGS</span>
            <div class="clearfix"></div>
        </div>
        <div class="hotel-item-box01 pull-left" data-name="Costa Baja Resort">
            <img src="<?=SITE_URL; ?>/images/img01a.png" width="258" height="132" />
            <span class="hotel-meta-details pull-left">Costa Baja Resort &amp; Spa La Paz, <br /> Baja California Sur, Mexico</span>
            <span class="hotel-meta-savings pull-left">49% SAVINGS</span>
            <div class="clearfix"></div>
        </div>
        <div class="hotel-item-box-02 pull-left" data-name="Costa Baja Resort">
            <div class="featured-hotel-meta-callout pull-left">
                <p class="meta-price big">$3,628</p>
                <p class="meta-misc">Taxes incl.</p>
                <p class="hotel-meta-savings meta-fullSpan">49%SAVINGS</p>
            </div>
            <div class="featured-hotel-meta-image pull-left">
                <img src="<?=SITE_URL; ?>/images/img02.png" width="278" height="145" />
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </section>
    <!-- End: Featured Hotels -->
    <!-- Start: Main Content -->
    <div class="content">
        <div class="content-main pull-left">
            <section class="featured featured-item-list" data-name="tours">
                <h1>Tour Packages</h1>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img05.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img06.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img07.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img08.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img09.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="clear"></div>
            </section>
            <section class="featured featured-item-list" data-name="tours">
                <h1>Tour Packages</h1>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img05.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img06.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img07.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img08.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img09.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=1">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="clear"></div>
            </section>
            <section class="featured featured-item-list" data-name="combo">
                <h1>Combo Offers</h1>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img10.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=2">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img11.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=2">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img12.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=2">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img13.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=2">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img14.png" width="168" height="168"/>
                    <h1><a href="<?=SITE_URL; ?>/packages/view/?pid=123&city=5&pType=2">2 Days 3 Nights</a></h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="clear"></div>
            </section>
        </div>
        <div class="content-sidebar pull-left">
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/img03.png" width="300" height="170"/>
                <div class="caption inverse">
                    <span><small>Online visa for Dubai,</small></span>
                    <span class="text-large">@ $100</span>
                </div>
            </div>
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/advt.png" width="300" height="250"/>
            </div>
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/img03.png" width="300" height="170"/>
                <div class="caption inverse">
                    <span><small>Online visa for Dubai,</small></span>
                    <span class="text-large">@ $100</span>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- End: Main Content -->
</div>
<!-- Start: Footer -->
<div class="footer-main">
    <div class="container">
        <div class="aboutus">
            <h1>Why Us</h1>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
            <p>Nam gravida tellus vestibulum ornare imperdiet. Pellentesque nunc mauris, venenatis quis porta id, lobortis at erat. Aliquam ac nisl facilisis, vestibulum felis eget, facilisis massa. Vestibulum molestie purus malesuada dolor gravida viverra. Aliquam at magna vitae orci consectetur condimentum et sed nunc. Sed enim dui, laoreet eu rhoncus non, ultricies sit amet metus. Vestibulum rutrum tristique nulla et fermentum. In congue ornare erat eu condimentum. Donec nibh leo, posuere vel ultricies non, posuere a felis. </p>
            <a href="<?=SITE_URL; ?>/why-us/"><h2>more</h2></a>
        </div>
        <div class="getintouch">
            <h1>Get in Touch</h1>
            <input name="" type="text" value="Name"/>
            <input name="" type="text" value="Email"/>
            <input name="" type="text" value="Phone"/>
            <input name="" type="text" value="Enter Capcha" style="float:left; width:46%"/>
            <input type="text" value="Capcha comes here" style="float:right; width:50%"/>
            <textarea name=" rtrtrt" cols="" rows="" id=" rtrtrt">trtrrtrt</textarea>
            <input name="" type="button" value="Go" class="aboutus_butt"/>
            <div class="clear"></div>
        </div>
        <div class="socialicons">
            <h1>Quick Contact</h1>
            <p>Office : <?=$contact['phone']; ?></p>
            <p>Mobile :<?=$contact['fax']; ?></p>
            <p>e-mail: <a href="mailto:<?=$contact['email']; ?>"><?=$contact['email']; ?></a></p>
            <a href="<?=$social['twitter']; ?>" target="_blank"><img src="<?=SITE_URL; ?>/images/icon1.png" width="28" height="28" style=" margin-left:0px"/></a>
            <a href="#" target="_blank"><img src="<?=SITE_URL; ?>/images/icon2.png" width="28" height="28"/></a>
            <a href="#" target="_blank"><img src="<?=SITE_URL; ?>/images/icon3.png" width="28" height="28"/></a>
            <a href="#" target="_blank"><img src="<?=SITE_URL; ?>/images/icon4.png" width="28" height="28"/></a>
            <a href="#" target="_blank"><img src="<?=SITE_URL; ?>/images/icon5.png" width="28" height="28"/></a>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<!-- put login modal code here -->