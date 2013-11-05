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
                <h5>Booking Details & Prices</h5>
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
                    <tr class="tbl-row-seperator">
                        <td>Single</td>
                        <td>100 AED</td>
                        <td>2</td>
                        <td>
                            <select class="span1">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </td>
                        <td class="txt-rt clmn-price"><span class="row-price">200</span></td>
                    </tr>
                    <tr class="tbl-row-seperator">
                        <td>Double</td>
                        <td>100 AED</td>
                        <td>2</td>
                        <td>
                            <select class="span1">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </td>
                        <td class="txt-rt clmn-price"><span class="row-price">200</span></td>
                    </tr>
                    <tr class="tbl-row-seperator">
                        <td>Triple</td>
                        <td>100 AED</td>
                        <td>2</td>
                        <td>
                            <select class="span1">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </td>
                        <td class="txt-rt clmn-price"><span class="row-price">200</span></td>
                    </tr>
                    <tr id="row-aEbed" class="tbl-row-seperator">
                        <td>Adult Extra Bed</td>
                        <td>100 AED</td>
                        <td>2</td>
                        <td>
                            <select class="span1">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </td>
                        <td class="txt-rt clmn-price"><span class="row-price">200</span></td>
                    </tr>
                    <tr class="tbl-row-seperator">
                        <td>Child Extra Bed</td>
                        <td>100 AED</td>
                        <td>2</td>
                        <td>
                            <select class="span1">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </td>
                        <td class="txt-rt clmn-price"><span class="row-price">200</span></td>
                    </tr>
                    <tr class="tbl-row-seperator">
                        <td>Child Breakfast</td>
                        <td>100 AED</td>
                        <td>2</td>
                        <td>
                            <select class="span1">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </td>
                        <td class="txt-rt clmn-price"><span class="row-price">200</span></td>
                    </tr>
                    <tr class="tbl-row-subtotal">
                        <td colspan="3"></td>
                        <td class="txt-rt">Sub Total</td>
                        <td class="txt-rt clmn-price"><span class="row-price">200</span></td>
                    </tr>
                    <tr class="tbl-row-grandtotal">
                        <td></td>
                        <td colspan="3" class="txt-rt">Grand Total</td>
                        <td class="txt-rt">200</td>
                    </tr>
                </table>
            </section>
            <section class="passenger-information pull-left">
                <h5>Travelers Details</h5>
                <table class="pax-info">
                    <tr>
                        <td></td>
                        <td>Full Name</td>
                    </tr>
                    <tr>
                        <td><label>Adult</label></td>
                        <td><input type="text" class="span4"></td>
                    </tr>
                    <tr>
                        <td><label>Child</label></td>
                        <td><input type="text" class="span4"></td>
                    </tr>
                </table>
            </section>
            <section class="instructions pull-left">
                <h5>Instructions</h5>
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
                <h5>Addl. Special Instructions</h5>
                <textarea cols="5" rows="3" class="span6"></textarea>
            </section>
            <div class="clearfix"></div>
        </div>
    </div>
</div>