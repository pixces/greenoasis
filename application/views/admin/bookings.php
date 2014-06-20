<div class="page-body-inner">
    <div>
        <div>
            <form class="form-inline pull-right">
                <label>Search by Order Number
                    <input type="text" class="span2">
                </label>
                <label>Custom</label>
                <div id="dpFrom" class="input-append date" data-date-format="dd-mm-yyyy" data-date="12-04-2014">
                    <input id="dateFrom" name="" class="span2" type="text" readonly="" value="12-04-2014" placeholder="" required="required">
                    <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
                <label>To</label>
                <div id="dpTo" class="input-append date" data-date-format="dd-mm-yyyy" data-date="12-04-2014">
                    <input id="dateTo" name="" class="span2" type="text" readonly="" value="12-04-2014" placeholder="Check In" required="required">
                    <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
            </form>
        </div>
    </div>
    <br/><br/>
    <div class="">
          
        <table class="table table-bordered">
            <thead class="well table-bordered">
                <tr>
                    <th>Sl</th>
                    <th>Order#</th>
                    <th>Date</th>
                    <th>Agent</th>
                    <th>Traveller</th>
                    <th>Hotel</th>
                    <th>Check In</th>
                    <th>Check out</th>
                    <th>Room Type</th>
                    <th>Status</th>
                    <th align="right">Price</th>
                </tr>
            </thead>
             <tbody>
            <?php
    if (empty($hotelReservations)) {

        echo "<tr><td>No Booking's Today.</td></tr>";
        
    }else{
    ?>
           
                <?php $i = 1; ?>
                <?php foreach ($hotelReservations as $reservation): ?>
                    <tr id="BK-<?=$reservation['Hotel_Reservation']['id']; ?>">
                        <td><?php echo $i++; ?></td>
                        <td><a href="#divBkingDtls" role="button" data-toggle="modal" data-remote="<?=SITE_URL."/admin/view_booking/".$reservation['Hotel_Reservation']['id']; ?>"><?php echo ''.str_pad($reservation['Hotel_Reservation']['id'],5,0,STR_PAD_LEFT); ?></a></td>
                        <td><?php echo date("F j, Y", strtotime($reservation['Hotel_Reservation']['date_added'])); ?></td>
                        <td><?php echo ucwords($reservation['agent_name']); ?></td>
                        <td><?php echo $reservation['customer_name']; ?></td>
                        <td><?php echo $reservation['hotel_name']; ?></td>
                        <td><?php echo $reservation['Hotel_Reservation']['fromDate']; ?></td>
                        <td><?php echo $reservation['Hotel_Reservation']['toDate']; ?></td>
                        <td><?php echo ucwords($reservation['Hotel_Reservation']['room_type']); ?></td>
                        <td>
                            <?php $btn = ($reservation['Hotel_Reservation']['status'] == 'request') ? 'warning' : ($reservation['Hotel_Reservation']['status'] == 'confirm' ? 'success' : 'important'); ?>
                            <?php if ($reservation['Hotel_Reservation']['status'] == 'request') { ?>
                            <div class="btn-group">
                                <button class="btn btn-<?=$btn; ?>"><?=ucwords(strtolower($reservation['Hotel_Reservation']['status'])); ?></button>
                                <button class="btn btn-<?=$btn; ?> dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0);" data-booking-id="<?php echo $reservation['Hotel_Reservation']['id']; ?> " 
                                               data-booking-price="<?php echo $reservation['Hotel_Reservation']['price'];?> " data-booking-action="approve">Approve</a>
                                        </li>
                                        <li>
                                            <a  href="javascript:void(0);"
                                               data-booking-id="<?php echo $reservation['Hotel_Reservation']['id']; ?> " data-booking-action="reject">Reject</a>
                                        </li>
                                    </ul>
                            </div>
                            <?php } else { ?>
                                <span class="label label-<?=$btn; ?>"><?=ucwords(strtolower($reservation['Hotel_Reservation']['status'])); ?></span>
                            <?php } ?>
                        </td>
                        <td align="right"><?php echo '$'.$reservation['Hotel_Reservation']['price']; ?></td>

        <!--                <td><button class="btn-small btn-success">view</button></td>
                        <td><button class="btn-small btn-primary">save</button></td>-->
                    </tr>
                <?php endforeach; ?>
                    <?php } ?>
            </tbody>
    
        </table>
    </div>
</div>
<!-- Modal -->
<div id="divBkingDtls" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Hotel Booking Details</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer"></div>
</div>