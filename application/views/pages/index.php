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
    <form class="form-inline">
        <input type="text" class="span4" name="location" data-provide="typeahead" data-source='["Dubai","Jordan"]' data-items="2" placeholder="Find a place to stay..." required>
        <div id="dpCheckin" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
            <input name="date_checkin" class="span2" type="text" readonly value="" placeholder="Check In" required>
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
        <div id="dpCheckout" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date('d-m-Y'); ?>">
            <input name="date_checkout" class="span2" type="text" readonly value="" placeholder="Check Out" required>
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
        <select class="span2">
            <option>Rooms</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
        <select class="span2">
            <option>Room Type</option>
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
        <button class="btn btn-green" type="button"><i class="icon-search icon-white"></i> Search</button>
    </form>
</div>
<!-- End: Basic Search -->
<!-- Start: Featured Hotels -->
<div class="container">
    <section class="featured hotel-list">
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
                    <h1>Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img06.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img07.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img08.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img09.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="clear"></div>
            </section>
            <section class="featured featured-item-list" data-name="combo">
                <h1>Combo Offers</h1>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img10.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img11.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img12.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img13.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
                    <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
                </div>
                <div class="featured-items pull-left">
                    <img src="<?=SITE_URL; ?>/images/img14.png" width="168" height="168"/>
                    <h1>2 Days 3 Nights</h1>
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
            <a href="#"><h2>more</h2></a>
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
            <p>Office : +971 426 83 811</p>
            <p>Mobile :+971 504 617410</p>
            <p>e-mail: info@dubaigot.com</p>
            <a href="#"><img src="<?=SITE_URL; ?>/images/icon1.png" width="28" height="28" style=" margin-left:0px"/></a>
            <a href="#"><img src="<?=SITE_URL; ?>/images/icon2.png" width="28" height="28"/></a>
            <a href="#"><img src="<?=SITE_URL; ?>/images/icon3.png" width="28" height="28"/></a>
            <a href="#"><img src="<?=SITE_URL; ?>/images/icon4.png" width="28" height="28"/></a>
            <a href="#"><img src="<?=SITE_URL; ?>/images/icon5.png" width="28" height="28"/></a>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>