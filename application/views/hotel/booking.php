<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>GREEN OASIS TOURISM L.L.C</title>


    <script src="<?=SITE_JS; ?>jquery.1.10.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            //Execute the slideShow
            slideShow();

        });

        function slideShow() {

            //Set the opacity of all images to 0
            $('#gallery a').css({opacity: 0.0});

            //Get the first image and display it (set it to full opacity)
            $('#gallery a:first').css({opacity: 1.0});

            //Set the caption background to semi-transparent
            $('#gallery .caption').css({opacity: 0.7});

            //Resize the width of the caption according to the image width
            $('#gallery .caption').css({width: $('#gallery a').find('img').css('width')});

            //Get the caption of the first image from REL attribute and display it
            $('#gallery .content').html($('#gallery a:first').find('img').attr('rel'))
                .animate({opacity: 0.7}, 400);

            //Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
            setInterval('gallery()', 6000);

        }

        function gallery() {

            //if no IMGs have the show class, grab the first image
            var current = ($('#gallery a.show') ? $('#gallery a.show') : $('#gallery a:first'));

            //Get next image, if it reached the end of the slideshow, rotate it back to the first image
            var next = ((current.next().length) ? ((current.next().hasClass('caption')) ? $('#gallery a:first') : current.next()) : $('#gallery a:first'));

            //Get next image caption
            var caption = next.find('img').attr('rel');

            //Set the fade in effect for the next image, show class has higher z-index
            next.css({opacity: 0.0})
                .addClass('show')
                .animate({opacity: 1.0}, 1000);

            //Hide the current image
            current.animate({opacity: 0.0}, 1000)
                .removeClass('show');

            //Set the opacity to 0 and height to 1px
            $('#gallery .caption').animate({opacity: 0.0}, { queue: false, duration: 0 }).animate({height: '1px'}, { queue: true, duration: 300 });

            //Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
            $('#gallery .caption').animate({opacity: 0.7}, 100).animate({height: '100px'}, 500);

            //Display the content
            $('#gallery .content').html(caption);


        }

    </script>

    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>style_tmp.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>green_oasis_style_tmp.css">
</head>

<body>
<div class="header_wrapper">
    <div class="header">
        <div class="header_col01"><img src="<?=SITE_URL; ?>/images/logo.png" width="496" height="135"/></div>
        <div class="header_col02">
            <div class="header_col02_raw">
                <div class="header_col02_raw1"><img src="<?=SITE_URL; ?>/images/icon01.png" width="31" height="32"/>

                    <h1>Agent Login</h1></div>
                <div class="clear"></div>
            </div>
            <div class="header_col02_raw2">
                <ul>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Tour Packages</a></li>
                    <li><a href="#">Visa</a></li>
                    <li><a href="booking.php">Hotel Booking</a></li>
                    <li><a href="../../application/views/pages/display.php">About Us</a></li>
                    <li><a href="../../application/views/pages/index.php">Home</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


<div class="search_wrapper">
    <div class="input_001"><input type="text" value="Find a place to stay"/></div>
    <div class="input_002"><input name="" type="text" value="Check in"/></div>
    <div class="input_002"><input name="" type="text" value="Check out"/></div>
    <div class="input_002a">


        <select class="text1">
            <option>Adults</option>
            <option value="1">Adults 02</option>
        </select>


    </div>
    <div class="input_002a"><select class="text1">
            <option>Children</option>
            <option value="1">child 01</option>
        </select>
    </div>
    <div class="input_005">

        <input name="input" type="button" value="Search" class="input_005" style="border:none"
               onclick="window.location.href ='search.php'"/>
    </div>

    <div class="clear"></div>
</div>


<div>

    <div class="adv_search">

        <a href="changesearch.php">Advanced Search</a
    </div>
    <div class="clear"></div>
</div>
<div class="featHotel_wrapper">
    <h1>Featured Hotel</h1>

    <div class="featHotel_img_wrapper">
        <div class="featHotel_img_wrapper_col_01">
            <img src="<?=SITE_URL; ?>/images/img01.png" width="258" height="132"/>

            <div class="featHotel_img_wrapper_col_01_mainraw01">
                <div class="featHotel_img_wrapper_col_01_mainraw01_col01"><p>Costa Baja Resort &amp; Spa La Paz, <br/>
                        Baja California Sur, Mexico</p></div>
                <div class="featHotel_img_wrapper_col_01_mainraw01_col02">
                    <P>49%</P>

                    <P>SAVINGS</P></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="featHotel_img_wrapper_col_01">
            <img src="<?=SITE_URL; ?>/images/img01a.png" width="258" height="132"/>

            <div class="featHotel_img_wrapper_col_01_mainraw01">
                <div class="featHotel_img_wrapper_col_01_mainraw01_col01"><p>Costa Baja Resort &amp; Spa La Paz, <br/>
                        Baja California Sur, Mexico</p></div>
                <div class="featHotel_img_wrapper_col_01_mainraw01_col02"><P>49%</P>

                    <P>SAVINGS</P></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="featHotel_img_wrapper_col_01">
            <img src="<?=SITE_URL; ?>/images/img01b.png" width="258" height="132"/>

            <div class="featHotel_img_wrapper_col_01_mainraw01">
                <div class="featHotel_img_wrapper_col_01_mainraw01_col01"><p>Costa Baja Resort &amp; Spa La Paz, <br/>
                        Baja California Sur, Mexico</p></div>
                <div class="featHotel_img_wrapper_col_01_mainraw01_col02"><P>49%</P>

                    <P>SAVINGS</P></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="featHotel_img_wrapper_col_02">
            <div class="featHotel_img_wrapper_col_02_raw1">
                <h1>$3,628</h1>

                <h2>Taxes incl.</h2></div>
            <div class="featHotel_img_wrapper_col_02_raw2">
                <h3>49%SAVINGS</h3></div>
            <div class="clear"></div>
        </div>
        <div class="featHotel_img_wrapper_col_03"><img src="<?=SITE_URL; ?>/images/img02.png" width="278" height="145"/>
        </div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


<div class="tourpackages_main_wrapper">




<div id="container_a">
    <div id="title">
        <h1>Booking :: Add</h1></div>
</div>


<div id="container">
<div class="col_left2">
    <div class="row1_booking">
        <div class="label4">
            <label>Booking Summery</label>
        </div>
    </div>

    <div class="row2">
        <div class="thumb">
            <img src="image/hotel-logo01.png" width="80" height="80" /> </div>
        <div class="clear"></div>
    </div>

    <div class="row1_booking2">
            <span class="blu"><strong>Arabian Park Hotel</strong> ,  <br />
            BUR DUBAI, UAE.</span>
    </div>

    <div class="row2">
        <div class="label5">In</div>
        <div class="label6">: 13-Sep-2013</div>

        <div class="label5">Out</div>
        <div class="label6">: 14-Sep-2013</div>

        <div class="label5">Nights</div>
        <div class="label6">: 1</div>

        <div class="label5">Single</div>
        <div class="label6">: 185.40 AED</div>

        <div class="label5">Double</div>
        <div class="label6">: 206.00 AED</div>

        <div class="label5">Adult HB</div>
        <div class="label6">: 85.00 AED</div>

        <div class="label5">Room type</div>
        <div class="label6">: Standard</div>

        <div class="label5">Rate Basis</div>
        <div class="label6">: Bd</div>
        <div class="clear"></div>
    </div>


</div>

<div class="col_right">
    <div class="row1"></div>
    <div class="row3">
        <div class="label2">
            <label>Description </label>
        </div>
        <div class="label2">
            <label>Quantity </label>
        </div>
        <div class="label2">
            <label>Price</label></div>
        <div class="label2">
            <label>Rate breakedown </label>
        </div>

        <div class="clear"></div>
    </div>

    <div class="row3">
        <input type="text" class="text3" value="Single" />
        <input type="text" class="text3" value="0" />
        <input type="text" class="text3" value="00.00" />
        <input type="text" class="text3" value="Rate Breakedown" />
        <input name="Available" type="button" class="available" id="Available" value="Available" />
        <input name="Book" type="button" class="book" id="Book" value="Book" />

        <div class="clear"></div>
    </div>

    <div class="row3">
        <input type="text" class="text3" value="Double" />
        <input type="text" class="text3" value="0" />
        <input type="text" class="text3" value="00.00" />
        <input type="text" class="text3" value="Rate Breakedown" />
        <input name="Available" type="button" class="available" id="Available" value="Available" />
        <input name="Book" type="button" class="book" id="Book" value="Book" />

        <div class="clear"></div>
    </div>

    <div class="row3">
        <input type="text" class="text3" value="Adult HB" />
        <input type="text" class="text3" value="1" />
        <input type="text" class="text3" value="00.00" />
        <input type="text" class="text3" value="Rate Breakedown" />
        <input name="Available" type="button" class="available" id="Available" value="Available" />
        <input name="Book" type="button" class="book" id="Book" value="Book" />

        <div class="clear"></div>
    </div>

    <div class="row3">
        <div class="clear"></div>
    </div>

    <div class="row3a">
        <div class="label2">
            <label>Name</label>
        </div>
        <select class="text4">
            <option selected="selected">Mr.</option>
            <option value="1">Mrs.</option>
        </select>
        <input type="text" class="text5" value="First Name" />
        <input type="text" class="text5" value="Second Name" />

        <div class="clear"></div>
    </div>

    <div class="row3">
        <div class="label2">
            <label>Adult</label>
        </div>
        <select class="text4">
            <option>01</option>
            <option value="1">02</option>
            <option>03</option>
        </select>

        <div class="label2a">
            <label>Children</label>
        </div>
        <select class="text4">
            <option>01</option>
            <option value="1">02</option>
            <option>03</option>
        </select>

        <div class="label2a">
            <label>Add Transfer</label></div>
        <select class="text4">
            <option>01</option>
            <option value="1">02</option>
            <option>03</option>
        </select>



        <div class="clear"></div>
    </div>

    <div class="row3">
        <div class="clear"></div>
    </div>

    <div class="row2">

        <form id="form1" name="form1" method="post" action="">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Please note early arrival	</label><br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Please note clients will arrive without voucher </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Please note late arrival (after 7 pm) </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Please note late check out </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Please note passengers are Vip clients </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Please provide inter-connecting rooms </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Please note passengers are honeymooners </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">If possible please provide room on low floor </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">If this property is unavailable, please do NOT supply me with an alternative </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">If possible please provide room on high floor </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">If possible please provide quiet room </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            If possible please provide non-smoking rooms
            <label for="checkbox"> </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            If possible please provide smoking room
            <label for="checkbox"> </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">If possible please provide adjoining rooms </label>
            <br />
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">If possible please provide room with bathtub </label>
            <br />
        </form>

        <div class="clear"></div>
    </div>

    <div class="row3">
        <div class="clear"></div>
    </div>
    <div class="row3">
        <span class="blu">* Requests cannot be guaranteed and are subject to availability on arrival</span>
        <div class="clear"></div>
    </div>

    <div class="input_005_booking">
        <input name="Book" type="button" class="instruction" id="Book" value="Other Instructions" onclick="window.location.href ='ratelist.php'" />

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>


<div class="clear"></div></div>



<div class="aboutus_main_wrapper">
    <div class="aboutus_wrapper">
        <div class="aboutus">
            <h1>Why Us</h1>

            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour, or randomised words which don't look even slightly believable. If you
                are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden
                in the middle of text.
            </p>

            <p>Nam gravida tellus vestibulum ornare imperdiet. Pellentesque nunc mauris, venenatis quis porta id,
                lobortis at erat. Aliquam ac nisl facilisis, vestibulum felis eget, facilisis massa. Vestibulum molestie
                purus malesuada dolor gravida viverra. Aliquam at magna vitae orci consectetur condimentum et sed nunc.
                Sed enim dui, laoreet eu rhoncus non, ultricies sit amet metus. Vestibulum rutrum tristique nulla et
                fermentum. In congue ornare erat eu condimentum. Donec nibh leo, posuere vel ultricies non, posuere a
                felis. </p>
            <a href="#"><h2>more</h2></a>

            <div class="clear"></div>
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
            <a href="#"><img src="<?=SITE_URL; ?>/images/icon1.png" width="28" height="28"
                             style=" margin-left:0px"/></a>
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


<div class="footer_wrapper">
    <div class="footer">
        <div class="footer_col_01">
            <ul>


                <a href="#">
                    <li>Home</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>About Us</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>UAE</li>
                </a>
                <li>|</li>

                <a href="#">
                    <li>Hotel Booking</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Visa Application</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Tour Packages</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Careers</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Testimonials</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Contact Us</li>
                </a>
                <br/>


                <a href="#">
                    <li>Register Your Hotel</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Become an Agent</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Visa Information</li>
                </a>
                <li>|</li>
                <a href="#">
                    <li>Make Payment
                </a>
                <li>|</li>
                <a href="#">
                    <li>Advertise with Us
                </a>
                <li>|</li>
                <a href="#">
                    <li>Terms & Conditions
                </a>

            </ul>
        </div>
        <div class="footer_col_02">
            <ul>
                <li style="border:none">© 2013 Green Oasis</li>
                <li><img src="<?=SITE_URL; ?>/images/innoveinsfooter.png"/></li>

            </ul>

        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


</body>
</html>