<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GREEN OASIS TOURISM L.L.C</title>


<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {		
	
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
	setInterval('gallery()',6000);
	
}

function gallery() {
	
	//if no IMGs have the show class, grab the first image
	var current = ($('#gallery a.show')?  $('#gallery a.show') : $('#gallery a:first'));

	//Get next image, if it reached the end of the slideshow, rotate it back to the first image
	var next = ((current.next().length) ? ((current.next().hasClass('caption'))? $('#gallery a:first') :current.next()) : $('#gallery a:first'));	
	
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
	$('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });	
	
	//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
	$('#gallery .caption').animate({opacity: 0.7},100 ).animate({height: '100px'},500 );
	
	//Display the content
	$('#gallery .content').html(caption);
	
	
}

</script>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<link href="css/green_oasis_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="header_wrapper">
<div class="header">
<div class="header_col01"><img src="image/logo.png" width="496" height="135" /></div>
<div class="header_col02">
<div class="header_col02_raw">
<div class="header_col02_raw1"><img src="image/icon01.png" width="31" height="32" /><h1>Agent Login</h1></div>
<div class="clear"></div></div>
<div class="header_col02_raw2">
<ul>
<li><a href="#">Contact</a></li>
<li><a href="#">Tour Packages</a></li>
<li><a href="#">Visa</a></li>
<li><a href="#">Hotel Booking</a></li>
<li><a href="inner.php">About Us</a></li>
<li><a href="index.php">Home</a></li>
</ul>
</div>
<div class="clear"></div></div>
<div class="clear"></div></div>
<div class="clear"></div></div>

<div class="banner_wrapper">
<div class="banner">


<div id="gallery">

	<a href="#" class="show">
		<img src="image/001.jpg" alt="Flowing Rock" title="" alt="" rel=""/>
	</a>
	
	<a href="#">
		<img src="image/002.jpg" alt="Grass Blades" title="" alt="" rel=""/>
	</a>
	
	<a href="#">
		<img src="image/003.jpg" alt="Ladybug" title="" alt="" rel=""/>
	</a>

	<a href="#">
		<img src="image/004.jpg" alt="Lightning" title="" alt="" rel=""/>
	</a>
	

	<div class="caption"><div class="content"></div></div>
</div>


</div>
<div class="clear"></div></div>

<div class="search_wrapper">
<div class="input_001"><input type="text" value="Find a place to stay" /></div>
<div class="input_002"><input name="" type="text" value="Check in" /></div>
<div class="input_002"><input name="" type="text" value="Check out" /></div>
<div class="input_002a">

            
          <select class="text1">
            <option>Adults </option>
              <option value="1">Adults 02</option>
            </select>



</div>
<div class="input_002a"> <select class="text1">
            <option>Children</option>
              <option value="1">child 01</option>
            </select>
</div>
<div class="input_005">

  <input name="input" type="button" value="Search"  class="input_005" style="border:none" 
  onclick="window.location.href ='search.php'"/>
</div>

<div class="clear"></div>
</div>




<div >

<div class="adv_search">

<a href="changesearch.php">Advanced Search</a
</div>
<div class="clear"></div>
</div>









<div class="featHotel_wrapper">
<h1>Featured Hotel</h1>
<div class="featHotel_img_wrapper">

<div class="featHotel_img_wrapper_col_01">
<a href="booking.php"><img src="image/img01.png" width="258" height="132" /></a>
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

<div class="tourpackages_main_wrapper">
<div class="tourpackages_wrapper">
<div class="tourpackages">
<h1>Tour Packages</h1>
<div class="tourpackages_img_wrapper">
<div class="tourpackages_col">
  <img src="image/img05.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>


<div class="tourpackages_col">
  <img src="image/img06.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  
  <div class="tourpackages_col">
  <img src="image/img07.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  
  <div class="tourpackages_col">
  <img src="image/img08.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  
  <div class="tourpackages_col">
  <img src="image/img09.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  <div class="clear"></div></div>
  <div class="clear"></div></div>
  
  
  
  
  
  <div class="tourpackages">
<h1>Combo Offers</h1>
<div class="tourpackages_img_wrapper">
<div class="tourpackages_col">
  <img src="image/img10.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>


<div class="tourpackages_col">
  <img src="image/img11.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  
  <div class="tourpackages_col">
  <img src="image/img12.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  
  <div class="tourpackages_col">
  <img src="image/img13.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  
  <div class="tourpackages_col">
  <img src="image/img14.png" width="168" height="168" /> 
  <h3>2 Days 3 Nights</h3>
  <p>orem Ipsum available, but the majority have suffered alteration in some form,</p>
  </div>
  <div class="clear"></div></div>
  <div class="clear"></div></div>
  
  
  
  
  
  
  
  
  
  
  
  
  
<div class="clear"></div></div>
  
  
  
  
  
  <div class="tourpackages_02">
    <div class="tourpackages_co2">
  <img src="image/img03.png" width="300" height="170" />
<h2>Online visa for Dubai,</h2>
  <h1>@ $ 100</h1>
  </div>
  
  <div class="tourpackages_co2">
    <img src="image/advt.png" width="300" height="250" /> </div>
  
  
<div class="clear"></div></div>




<div class="clear"></div></div>












<div class="aboutus_main_wrapper">
<div class="aboutus_wrapper">
<div class="aboutus">
<h1>Why Us</h1>
<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. 
</p>
<p>Nam gravida tellus vestibulum ornare imperdiet. Pellentesque nunc mauris, venenatis quis porta id, lobortis at erat. Aliquam ac nisl facilisis, vestibulum felis eget, facilisis massa. Vestibulum molestie purus malesuada dolor gravida viverra. Aliquam at magna vitae orci consectetur condimentum et sed nunc. Sed enim dui, laoreet eu rhoncus non, ultricies sit amet metus. Vestibulum rutrum tristique nulla et fermentum. In congue ornare erat eu condimentum. Donec nibh leo, posuere vel ultricies non, posuere a felis.  </p>
<a href="#"><h2>more</h2></a>
<div class="clear"></div>
</div>
<div class="getintouch">
<h1>Get in Touch</h1>
<input name="" type="text" value="Name" />
<input name="" type="text" value="Email" />
<input name="" type="text" value="Phone" />
<input name="" type="text" value="Enter Capcha"  style="float:left; width:46%"/>
<input type="text" value="Capcha comes here" style="float:right; width:50%"/>
<textarea name=" rtrtrt" cols="" rows="" id=" rtrtrt">trtrrtrt</textarea>
<input name="" type="button" value="Go" class="aboutus_butt" />
<div class="clear"></div>
</div>
<div class="socialicons">
<h1>Quick Contact</h1>
<p>Office : +971 426 83 811</p>
<p>Mobile :+971 504 617410</p>
<p>e-mail: info@dubaigot.com</p>
<a href="#"><img src="image/icon1.png" width="28" height="28"  style=" margin-left:0px"/></a>
<a href="#"><img src="image/icon2.png" width="28" height="28" /></a>
<a href="#"><img src="image/icon3.png" width="28" height="28" /></a>
<a href="#"><img src="image/icon4.png" width="28" height="28" /></a>
<a href="#"><img src="image/icon5.png" width="28" height="28" /></a>
<div class="clear"></div></div>
<div class="clear"></div></div>
<div class="clear"></div></div>


<div class="footer_wrapper">
<div class="footer">
<div class="footer_col_01">
<ul>


<a href="#"><li>Home</li></a>
<li>|</li>
<a href="#"><li>About Us </li></a>
<li>|</li>
<a href="#"><li>UAE </li></a>
<li>|</li>

<a href="#"><li>Hotel Booking </li></a>
<li>|</li>
<a href="#"><li>Visa Application </li></a>
<li>|</li>
<a href="#"><li>Tour Packages </li></a>
<li>|</li>
<a href="#"><li>Careers </li></a>
<li>|</li>
<a href="#"><li>Testimonials </li></a>
<li>|</li>
<a href="#"><li>Contact Us</li></a>


</ul>
</div>

<div class="footer_col_01">
<ul>


<a href="#"><li>Register Your Hotel</li></a>
<li>|</li>
<a href="#"><li>Become an Agent</li></a>
<li>|</li>
<a href="#"><li>Visa Information</li></a>
<li>|</li>
<a href="#"><li>Make Payment</a>
<li>|</li>
<a href="#"><li>Advertise with Us</a>
<li>|</li>
<a href="#"><li>Terms & Conditions</a>

</ul>
</div>


<div class="footer_col_02">
<ul>
<li style="border:none">© 2013 Green Oasis</li>
<li style="padding-top:10px"><img src="image/innoveinsfooter.png" /></li>

</ul>

</div>
<div class="clear"></div></div>
<div class="clear"></div></div>



</body>
</html>


















