<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREEN OASIS TOURISM L.L.C</title>
    <base href="<?=SITE_URL; ?>">
    <link rel="shortcut icon" href="<?=SITE_IMAGE; ?>favicon.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans|Roboto|Source+Sans+Pro:900italic,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>style.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>green_oasis_style.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>datepicker.css">
</head>
<body>
<!-- outer container -->
<div class="container">
    <!-- start: page header -->
    <div class="header">
        <div class="header_col01"><img src="<?=SITE_URL; ?>/images/logo.png" width="496" height="135"/></div>
        <div class="header_col02">
            <div class="header_col02_raw">
                <div class="header_col02_raw1"><img src="<?=SITE_URL; ?>/images/icon01.png" width="31" height="32"/>
                    <h1>Agent Login</h1></div>
                <div class="clearfix"></div>
            </div>
            <div class="header_col02_raw2">
                <ul>
                    <li><a href="<?=SITE_URL; ?>/contact-us/">Contact</a></li>
                    <li><a href="<?=SITE_URL; ?>/tours/">Packages</a></li>
                    <li><a href="<?=SITE_URL; ?>/visa/">Visa</a></li>
                    <li><a href="<?=SITE_URL; ?>/hotel/">Hotel Booking</a></li>
                    <li><a href="<?=SITE_URL; ?>/about-us/">About Us</a></li>
                    <li><a href="<?=SITE_URL; ?>" class="on">Home</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end: page header -->
    <!-- Start: banner -->
    <div class="banner">
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
    <!-- end : banner -->
    <!-- start: Basic Hotel Search -->
    <div class="basic-search">
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
    <!-- end: Basic Hotel Search -- >
    <!-- start: Featured Hotels -- >
    <div class="featHotel_wrapper">
        <h1>Featured Hotel</h1>
        <div class="featHotel_img_wrapper">

            <div class="featHotel_img_wrapper_col_01">
                <img src="image/img01.png" width="258" height="132" />
                <div class="featHotel_img_wrapper_col_01_mainraw01">
                    <div class="featHotel_img_wrapper_col_01_mainraw01_col01"><p>Costa Baja Resort &amp; Spa La Paz, <br />
                            Baja California Sur, Mexico</p></div>
                    <div class="featHotel_img_wrapper_col_01_mainraw01_col02">
                        <P>49%</P><P>SAVINGS</P></div></div>
                <div class="clear"></div></div>

            <div class="featHotel_img_wrapper_col_01">
                <img src="image/img01a.png" width="258" height="132" />
                <div class="featHotel_img_wrapper_col_01_mainraw01">
                    <div class="featHotel_img_wrapper_col_01_mainraw01_col01"><p>Costa Baja Resort &amp; Spa La Paz, <br />
                            Baja California Sur, Mexico</p></div>
                    <div class="featHotel_img_wrapper_col_01_mainraw01_col02"><P>49%</P><P>SAVINGS</P></div></div>
                <div class="clear"></div></div>

            <div class="featHotel_img_wrapper_col_01">
                <img src="image/img01b.png" width="258" height="132" />
                <div class="featHotel_img_wrapper_col_01_mainraw01">
                    <div class="featHotel_img_wrapper_col_01_mainraw01_col01"><p>Costa Baja Resort &amp; Spa La Paz, <br />
                            Baja California Sur, Mexico</p></div>
                    <div class="featHotel_img_wrapper_col_01_mainraw01_col02"><P>49%</P><P>SAVINGS</P></div></div>
                <div class="clear"></div></div>
            <div class="featHotel_img_wrapper_col_02">
                <div class="featHotel_img_wrapper_col_02_raw1">
                    <h1>$3,628</h1><h2>Taxes incl.</h2></div>
                <div class="featHotel_img_wrapper_col_02_raw2">
                    <h3>49%SAVINGS</h3></div>
                <div class="clear"></div></div>
            <div class="featHotel_img_wrapper_col_03"><img src="image/img02.png" width="278" height="145" /></div>

            <div class="clear"></div></div>
        <div class="clear"></div></div>
    <!-- end: Featured Hotels -- >
</div>
<!-- outer container ends -->
<script src="<?=SITE_JS; ?>jquery.1.10.2.min.js" type="text/javascript" ></script>
<script src="<?=SITE_JS; ?>common.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>site.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>bootstrap.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>html5shiv.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>pngfix.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>bootstrap-datepicker.js" type="text/javascript"></script>
</body>
</html>