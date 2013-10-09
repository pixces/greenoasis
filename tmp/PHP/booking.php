<?php
function pagecontent (){
?>



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

<?php
}
require_once('master.php');
?>
{