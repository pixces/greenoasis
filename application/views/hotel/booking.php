<div class="content bg-white">
    <div class="container">
        <div class="heading">
            <h1>Hotel: Booking</h1>
        </div>
        <div class="green-span3 facet-panel">
            <div class="left-panel box-shadow">
                <section class="hotel-info">
                    <h5>Hotel Details</h5>
                    <div class="sidebar-vertical">
                        <img class="img-polaroid" src="<?=SITE_URL."/public/upload/logo_".$details['Hotel']['hotel_logo']; ?>">
                        <h5 class="meta-title"><?=$details['Hotel']['hotel_name']; ?></h5>
                        <span class="meta-details"><?=$details['Hotel']['hotel_address']; ?></span>
                    </div>
                </section>
                <section class="package-info">
                    <h5>Package Details</h5>
                    <div class="sidebar-vertical">
                        <span class="meta-label">Check In:</span>
                        <span class="meta-details"><?=date('D d M, Y', $details['package']['checkin']); ?></span>
                    </div>
                    <div class="sidebar-vertical">
                        <span class="meta-label">Check Out:</span>
                        <span class="meta-details"><?=date('D d M, Y', $details['package']['checkout']); ?></span>
                    </div>
                    <div class="sidebar-vertical">
                        <span class="meta-label">Duration:</span>
                        <span class="meta-details"><?=$details['package']['nights']." nights"; ?></span>
                    </div>
                    <div class="sidebar-vertical">
                        <span class="meta-label">Rooms:</span>
                        <span class="meta-details"><?=$details['package']['rooms']." ".ucwords(strtolower($details['package']['roomtype'])); ?></span>
                    </div>
                    <div class="sidebar-vertical">
                        <span class="meta-label">Guest:</span>
                        <span class="meta-details">
                            <?php
                                echo sprintf("%d Adults %d Children",
                                    isset($details['package']['pax']['adult']) ? $details['package']['pax']['adult']  : 0,
                                    isset($details['package']['pax']['child']) ? $details['package']['pax']['child']  : 0
                                );
                            ?>
                        </span>
                    </div>
                </section>
            </div>
        </div>
        <div class="green-span9 result-panel">
            <section class="booking-items">
                <h5>Room Pricing & Booking details</h5>
                <div class="pull-left booking-data">
                    <span class="pull-left booking-meta-date">
                        <span class="criteria-label">Room Type:</span>
                        <span class="criteria-data"><?=$details['Hotel_Tariff']['room_type']; ?></span>
                    </span>
                    <span class="pull-left booking-meta-date lft-border">
                        <span class="criteria-label">Room Plan (Inclusions):</span>
                        <span class="criteria-data"><?=sprintf(" %s ( %s )",strtoupper($details['Hotel_Tariff']['meal_plan']), UTILS::getMealPlan( $details['Hotel_Tariff']['meal_plan'] ) ); ?></span>
                    </span>
                </div>
                <div class="clearfix"></div>
                <table class="room-info" width="100%" id="tariff-1">
                    <tr class="tbl-row-heading">
                        <th width="35%">Room Plan</th>
                        <th width="20%">Price/Night</th>
                        <th width="20%">No. of Nights</th>
                        <th width="10%">Qty</th>
                        <th class="txt-rt" width="15%">Total Price</th>
                    </tr>
                    <?php foreach($details['pricing'] as $plan => $unit_price) { ?>
                    <tr id="trPlan_<?=$plan; ?>" class="tbl-row-seperator tariff-plan" data-plan="<?=$plan; ?>" data-price="<?=$unit_price; ?>" data-nights="<?=$details['package']['nights']; ?>">
                        <td class="clmn-room-plan"><?=ucwords(str_replace("_", " ", $plan)); ?></td>
                        <td class="clmn-unit-price"><?=$unit_price; ?></td>
                        <td class="clmn-nights"><?=$details['package']['nights']; ?></td>
                        <td class="clmn-qty">
                            <select id="select_<?=$plan; ?>" class="span1 qty-select" name="qty[]">
                                <?php for($x=0;$x<=4; $x++) {
                                    $selected = "";
                                    if ($details['package']['roomtype'] == $plan ){
                                        if ($details['package']['rooms'] == $x){
                                            $selected = "selected";
                                        }
                                    }
                                ?>
                                    <option <?=$selected; ?>><?=$x; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="txt-rt price"><span class="price-<?=$plan; ?>">0</span></td>
                    </tr>
                    <?php } ?>
                    <tr class="tbl-row-subtotal">
                        <td colspan="3"></td>
                        <td class="txt-rt">Sub Total</td>
                        <td class="txt-rt price"><span class="subtotal-price">0</span></td>
                    </tr>
                    <tr class="tbl-row-grandtotal">
                        <td></td>
                        <td colspan="3" class="txt-rt">Grand Total</td>
                        <td class="txt-rt"><span class="grand-total">0</span></td>
                    </tr>
                </table>
            </section>
            <section class="passenger-information pull-left">
                <header>Travelers Details</header>
                <div class="pax-group">
                    <label class="group-title">Adult - 1</label>
                    <select name="salutaion[]" class="span1">
                        <option>Mr.</option>
                        <option>Ms.</option>
                        <option>Mrs.</option>
                        <option>Ma.</option>
                        <option>Dr.</option>
                        <option>Er.</option>
                    </select>
                    <input type="text" id="inputFName_adult" name="fname[]" placeholder="First Name" class="span2">
                    <input type="text" id="inputLName_adult" name="lname[]" placeholder="Last Name" class="span2">
                </div>
            </section>
            <section class="instructions pull-left">
                <header>Booking Instructions</header>
                <ul>
                    <li><label class="checkbox"><input type="checkbox"> Please note early arrival</label></li>
                    <li><label class="checkbox"><input type="checkbox"> Please note clients will arrive without voucher</label></li>
                    <li><label class="checkbox"><input type="checkbox"> Please note late arrival (after 7 pm)</label></li>
                    <li><label class="checkbox"><input type="checkbox"> Please note late check out</label></li>
                    <li><label class="checkbox"><input type="checkbox"> Please note passengers are Vip clients</label></li>
                    <li><label class="checkbox"><input type="checkbox"> Please provide inter-connecting rooms</label></li>
                    <li><label class="checkbox"><input type="checkbox"> Please note passengers are honeymooners</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If possible please provide room on low floor</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If this property is unavailable, please `DO NOT` supply me with an alternative</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If possible please provide room on high floor</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If possible please provide quiet room</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If possible please provide non-smoking rooms</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If possible please provide smoking room</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If possible please provide adjoining rooms</label></li>
                    <li><label class="checkbox"><input type="checkbox"> If possible please provide room with bathtub</label></li>
                </ul>
                <header>Special Instructions</header>
                <textarea cols="5" rows="3" class="span6"></textarea>
            </section>
            <div class="clearfix"></div>
            <section class="form-misc">
                <p class="greyBg">
                    <label class="checkbox" for="tnc_input"><input id="tnc_input" class="flL" type="checkbox" name="tnc_cb" checked="checked"> I agree to all the <a href="" target="_blank">terms and conditions</a> and have reviewed the <a href="">policies</a>.</label>
                </p>
                <p>
                    <button class="btn btn-success" type="button">Continue Booking!</button>
                </p>
            </section>
            <section class="hotel-policy">
                <h5>Policies</h5>
                <?php if($details['Hotel']['policy_cancellation'] != ''){ ?>
                    <div class="policy-box box-shadow">
                        <header>Cancellation Policy</header>
                        <p><?=$details['Hotel']['policy_cancellation']; ?></p>
                    </div>
                <?php } ?>
                <?php if($details['Hotel']['policy_occupancy'] != ''){ ?>
                    <div class="policy-box box-shadow">
                        <header>Occupancy Policy</header>
                        <p><?=$details['Hotel']['policy_occupancy']; ?></p>
                    </div>
                <?php } ?>
                <?php if($details['Hotel']['policy_child'] != ''){ ?>
                    <div class="policy-box box-shadow">
                        <header>Child Policy</header>
                        <p><?=$details['Hotel']['policy_child']; ?></p>
                    </div>
                <?php } ?>
            </section>
        </div>
    </div>
</div>

<script>
    $(function(){

        var subtotal = 0;

        $(".tariff-plan").each(function(){
          //calculate the row total
          var Obj = $(this);
          var plan = Obj.attr("data-plan");
          var unit_price = Obj.children(".clmn-unit-price").text();
          var nights = Obj.children(".clmn-nights").text();
          var qty = $("#select_"+plan).val();
          var total = 0;

          if (qty > 0){
                total = parseInt(unit_price) * parseInt(nights) * parseInt(qty);
          }

          subtotal += total;
          //update total to the price value
          $(".price-"+plan).html(total);
        });

        //update subtotal
        $(".subtotal-price").html(subtotal);

        //get grand total
        $(".grand-total").html(subtotal);
    });


</script>