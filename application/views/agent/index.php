<!-- Start: Main Content --->
<div id="page_booking" class="static-view content bg-white">
    <div class="container">
        <div class="heading"><h1>Booking</h1></div>
        <div class="container-main  box-shadow" style="width:100%;">
            <!---Starts: Modal for Hotel booking -->
            <div id="hotelBookingModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Hotel Booking Details</h3>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer"></div>
            </div>
            <!---Ends: Modal for Hotel booking -->

            <!--starts: modal for visa application -->
            <div id="visaAppModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:620px; left:49%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 style="color: 90c53f;" id="visaModalLabel">Visa Application Details</h3>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer"></div>
            </div>
            <!--ends: modal for visa application -->
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tabHotelBooking" data-toggle="tab">Hotel Bookings</a></li>
                    <li><a href="#tabVisaOrder" data-toggle="tab">Visa Requests</a></li>
                    <li><a href="#tabPackageBooking" data-toggle="tab">Tour Packages</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabHotelBooking">
                        <table class="table table-bordered">
                            <thead class="well table-bordered">
                                <tr>
                                    <th>Sl</th>
                                    <th>Order#</th>
                                    <th>Date</th>
                                    <th>Customer's Name</th>
                                    <th>Hotel</th>
                                    <th>Check In</th>
                                    <th>Check out</th>
                                    <th>Room Type</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($hotelReservations as $reservation): ?>
                                    <tr id="BK-<?= $reservation['Hotel_Reservation']['id']; ?>">
                                        <td><?php echo $i++; ?></td>
                                        <td><a href="#hotelBookingModal" role="button" data-toggle="modal" data-remote="<?= SITE_URL . "/agent/viewBooking/" . $reservation['Hotel_Reservation']['id']; ?>"><?php echo '' . str_pad($reservation['Hotel_Reservation']['id'], 5, 0, STR_PAD_LEFT); ?></a></td>
                                        <td><?php echo date("F j, Y", strtotime($reservation['Hotel_Reservation']['date_added'])); ?></td>
                                        <td><?php echo ucwords(strtolower($reservation['customer_name'])); ?></td>
                                        <td><?php echo ucwords(strtolower($reservation['hotel_name'])); ?></td>
                                        <td><?php echo $reservation['Hotel_Reservation']['fromDate']; ?></td>
                                        <td><?php echo $reservation['Hotel_Reservation']['toDate']; ?></td>
                                        <td><?php echo ucwords($reservation['Hotel_Reservation']['room_type']); ?></td>
                                        <td align="right"><?php echo '$' . $reservation['Hotel_Reservation']['price']; ?></td>
                                        <td>
                                            <?php $btn = ($reservation['Hotel_Reservation']['status'] == 'request') ? 'warning' : ($reservation['Hotel_Reservation']['status'] == 'confirm' ? 'success' : 'important'); ?>
                                            <span class="badge badge-<?= $btn; ?>"><?= ucwords(strtolower($reservation['Hotel_Reservation']['status'])); ?></span>
                                        </td>
                                        <!--
                                        <td><button class="btn-small btn-success">view</button></td>
                                        <td><button class="btn-small btn-primary">save</button></td>
                                        -->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tabVisaOrder">
                        <table class="table table-bordered">
                            <thead class="well table-bordered">
                                <tr>
                                    <th>Order#</th>
                                    <th>Date</th>
                                    <th>Customer's Name</th>
                                    <th>Passport Details</th>
                                    <th>Package</th>
                                    <th>Pax Count</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($visaInfo as $visa): ?>
                                    <tr id="VS-<?= $visa['Visa']['id']; ?>">
                                        <td><a href="#visaAppModal" role="button" data-toggle="modal" data-remote="<?= SITE_URL . "/agent/viewVisa/" . $visa['Visa']['id']; ?>"># <?php echo '' . str_pad($visa['Visa']['id'], 5, 0, STR_PAD_LEFT); ?></a></td>
                                        <td><?php echo date("M d, Y", strtotime($visa['Visa']['date_added'])); ?></td>
                                        <td><?php echo ucwords($visa['customer_name']); ?></td>
                                        <td><?php
                                                if (isset($visa['Visa_Pax'][0]['Visa_Pax']['passport'])){
                                                    echo $visa['Visa_Pax'][0]['Visa_Pax']['passport']. " - ". date('M d, Y', strtotime($visa['Visa_Pax'][0]['Visa_Pax']['expiry']));
                                                }
                                            ?></td>
                                        <td><?php echo sprintf('%s days - %s',$visa['Visa']['validity'],$visa['Visa']['type']); ?></td>
                                        <td><?php echo $visa['Visa']['pax_count']." nos."; ?></td>
                                        <td><?php echo CURRENCY . $visa['price']; ?></td>
                                        <td>
                                            <?php $btn = ($visa['status'] == 'approved') ? 'success' : ( ($visa['status'] == 'rejected') ? 'danger' : 'warning' ); ?>
                                            <span  class="badge badge-<?= $btn; ?> <?php echo $visa['Visa']['id']; ?>-text-status"><?= ucwords(strtolower($visa['status'])); ?></span>
                                        </td>
                                        <td> <span class="download-visa-<?php echo $visa['Visa']['id'] ?>">
                                                <?php if ($visa['status'] == "approved") { ?>
                                                    <a href="<?php echo SITE_URL . '/agent/download_visa_document/' . json_decode($visa['Visa']['visa_file_name']); ?>"><i style="cursor: pointer" class="icon-download-alt"></i> Visa</a>
                                                <?php } else { ?>
                                                    <span> - </span>
                                                <?php } ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tabPackageBooking">
                        <table class="table well">
                            <thead class="well table-bordered">
                                <tr>
                                    <th>Sl</th>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Customer's Name</th>
                                    <th>Package</th>
                                    <th>No.of People</th>
                                    <th>Tour Date</th>
                                    <th>Amount</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>01258</td>
                                    <td>04-04-14</td>
                                    <td>Thomas Varghese</td>
                                    <td>Package Name</td>
                                    <td>04</td>
                                    <td>12-04-14</td>
                                    <td>$1,245</td>
                                    <td><button class="btn-small btn-green">view</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->
<div class="footer-sub">


