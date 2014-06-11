<div class="content bg-white">
    <div class="container">
        <div class="heading">
            <h1>Hotel: Booking</h1>
        </div>
        <div class="green-span3 facet-panel">
            <div class="left-panel box-shadow">
                <div class="hotelInformation">
                    <img class="img-polaroid" src="<?=SITE_URL."/public/upload/logo_".$details['Hotel']['hotel_logo']; ?>">
                    <div class="title"><?=$details['Hotel']['hotel_name']; ?></div>
                    <div class="meta-details"><?=$details['Hotel']['hotel_address']; ?></div>
                </div>
                <h5>Package Details</h5>
                <div class="packageInformation">
                    <div class="checkIn">
                        <div class="title">Check-In</div>
                        <div class="timeAndDate">
                            <div>
                                <span class="icon-cCalendar"> </span>
                                <span class="date">
                                    <span class="day"><?=date('d', $details['package']['checkin']); ?></span> <?=date("F 'y D", $details['package']['checkin']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="checkOut">
                        <div class="title">Check-Out</div>
                        <div class="timeAndDate">
                            <div>
                                <span class="icon-cCalendar"> </span>
                                <span class="date">
                                    <span class="day"><?=date('d', $details['package']['checkout']); ?></span> <?=date("F 'y D", $details['package']['checkin']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="nights">
                        <span class="title">nights : </span>
                        <span class="value"><?=$details['package']['nights']; ?></span>
                        <span class="title" style="margin-left:20px;">room(s) : </span>
                        <span class="value"><?=$details['package']['rooms']." ".ucwords(strtolower($details['package']['roomtype'])); ?></span>
                    </div>
                    <div class="guests">
                        <span class="title">guests : </span>
                    <span class="value"><?php
                        echo sprintf("Adults %d | Children %d",
                            isset($details['package']['pax']['adult']) ? $details['package']['pax']['adult']  : 0,
                            isset($details['package']['pax']['child']) ? $details['package']['pax']['child']  : 0
                        );
                        ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="green-span9 result-panel">
            <h1>Room Pricing & Booking details</h1>
            <form method="post" name="frmBooking" id="frmBooking" action="">
                <input type="hidden" name="tariff_id" value="<?=$tariff; ?>">
                <input type="hidden" name="hotel_id" value="<?=$details['Hotel']['id']; ?>">
                <input type="hidden" name="sid" value="<?=$search_session; ?>">
                <div class="bookingPlan">
                    <span class="pull-left roomType">
                        <span class="title">Room Type:</span>
                        <span class="value"><?=$details['Hotel_Tariff']['room_type']; ?></span>
                    </span>
                    <span class="roomPlan pull-left">
                        <span class="title">Room Plan (Inclusions):</span>
                        <span class="value"><?=sprintf(" %s ( %s )",strtoupper($details['Hotel_Tariff']['meal_plan']), UTILS::getMealPlan( $details['Hotel_Tariff']['meal_plan'] ) ); ?></span>
                    </span>
                    <span class="clearfix"></span>
                </div>
                <table width="100%" cellspacing="0" cellpadding="0" class="roomInfoTable">
                    <tbody>
                        <tr>
                            <th width="15%">Room Type</th>
                            <th width="15%">Inclusions</th>
                            <th width="20%">Guests</th>
                            <th width="12%">Price/Night</th>
                            <th width="15%">No. of Night</th>
                            <th width="10%">Rooms</th>
                            <th width="15%" class="alR">Total Price</th>
                        </tr>
                        <?php foreach($details['pricing'] as $plan => $unit_price) { ?>
                        <tr id="trPlan_<?=$plan; ?>" class="hasSeprator tariff-plan" data-plan="<?=$plan; ?>" data-price="<?=$unit_price; ?>" data-nights="<?=$details['package']['nights']; ?>">
                            <td><?=ucwords(str_replace("_", " ", $plan)); ?></td>
                            <td>Room Only</td>
                            <td>Adult: 2  |  Children: 1</td>
                            <td class="clmn-unit-price">
                                <?=$unit_price; ?>
                                <input type="hidden" name="tariff[unit_price][<?=$plan; ?>]" value="<?=$unit_price; ?>">
                            </td>
                            <td class="clmn-nights">
                                <?=$details['package']['nights']; ?>
                                <input type="hidden" name="tariff[nights][<?=$plan; ?>]" value="<?=$details['package']['nights']; ?>">
                            </td>
                            <td><select id="select_<?=$plan; ?>" class="span1 qty-select" name="tariff[qty][<?=$plan; ?>]">
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
                                </select></td>
                            <td class="alR"><p class="append_bottomHalf"><strong><span class="price_sign">$&nbsp;</span><span class="price-<?=$plan; ?>" id="">0</span></strong></p></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td class="total_section" colspan="7">
                                <table width="35%" cellspacing="0" cellpadding="0" align="right">
                                    <tbody>
                                        <tr>
                                            <td class="grey alR">Subtotal</td>
                                            <td class="alR"><span class="WebRupee rupee_sign">$&nbsp;</span><span class="subtotal-price" id="">0</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="RobotoLight grand_total alR"></td>
                            <td colspan="3" class="RobotoLight grand_total alR">Grand Total</td>
                            <td class="RobotoLight grand_total alR grandTotalDetails" id="grandtotal_menuItem1" style="padding: 15px 0 0 0;"><span class="WebRupee rupee_sign">$&nbsp;</span><span class="grandTotal-price" id="">0</span></td>
                        </tr>
                        <tr>
                            <td colspan="1">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <div class="bookingAddlInfo">
                    <div class="pull-left bookingPax">
                        <div class="section-title">Primary Travelers Details</div>
                        <div class="pax-group">
                            <label>Full Name:</label>
                            <select name="pax[title]" class="span1" id="paxTitle">
                                <option>Mr.</option>
                                <option>Ms.</option>
                                <option>Mrs.</option>
                                <option>Ma.</option>
                                <option>Dr.</option>
                                <option>Er.</option>
                            </select>
                            <input type="text" id="paxFirstName" name="pax[first_name]" placeholder="First Name" class="span2" required>
                            <input type="text" id="paxLastName" name="pax[last_name]" placeholder="Last Name" class="span2">
                            <label>Email Address:</label>
                            <input type="email" id="paxEmail" name="pax[email]" placeholder="Email address" class="span5" required>
                            <label>Phone Number:</label>
                            <span class="help-block">Enter Phone number complete with Country code.</span>
                            <input type="text" id="paxPhone" name="pax[phone]" placeholder="Phone number" class="span5" required>

                        </div>
                    </div>
                    <div class="pull-right bookingInstruction">
                        <div class="section-title">Booking Instructions</div>
                        <ul>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="Please note early arrival"> Please note early arrival.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="Please note clients will arrive without voucher"> Please note clients will arrive without voucher.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="Please note late arrival (after 7 pm)"> Please note late arrival (after 7 pm).</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="Please note late check out"> Please note late check out.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="Please note passengers are Vip clients"> Please note passengers are Vip clients.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="Please provide inter-connecting rooms"> Please provide inter-connecting rooms.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="Please note passengers are honeymooners"> Please note passengers are honeymooners.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If possible please provide room on low floor"> If possible please provide room on low floor.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If this property is unavailable, please DO NOT supply me with an alternative"> If this property is unavailable, please DO NOT supply me with an alternative.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If possible please provide room on high floor"> If possible please provide room on high floor.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If possible please provide quiet room"> If possible please provide quiet room.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If possible please provide non-smoking rooms"> If possible please provide non-smoking rooms.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If possible please provide smoking room"> If possible please provide smoking room.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If possible please provide adjoining rooms"> If possible please provide adjoining rooms.</label></li>
                            <li><label class="checkbox"><input type="checkbox" name="booking[instructions][]" class="cbkBookingInstructions" value="If possible please provide room with bathtub"> If possible please provide room with bathtub.</label></li>
                        </ul>
                        <div class="section-title">Special Instructions</div>
                        <textarea cols="5" rows="3" class="span6" id="txtSplInstructions" name="booking[special_instructions]"></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="formTerms">
                    <p class="greyBg">
                        <label class="checkbox" for="tnc_input"><input id="tnc_input" class="flL" type="checkbox" name="tnc_cb" checked="checked"> I agree to all the <a href="" target="_blank">terms and conditions</a> and have reviewed the <a href="">policies</a>.</label>
                    </p>
                    <p style="text-align: right">
                        <input class="btn btn-success" type="submit" name="submit" value="Continue Booking!">
                    </p>
                </div>
            </form>
            <div class="hotel-policy">
                <h1>Policies</h1>
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
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        //calculate the bookingTariff
        BOOKING.init();

        //on change of qty drop down selection
        $(".qty-select").on('change',BOOKING.calculateTariff);

        //submit the form on click of the continue button
        $('#frmBooking').on('submit',SEARCH.booking);

    });



</script>