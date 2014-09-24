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
                    <li><a href="#tabPackageBooking" id="tabPackageBooking"  data-toggle="tab">Tour Packages</a></li>
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
                                <?php
                                if ($hotelReservations):

                                    foreach ($hotelReservations as $reservation):
                                        ?>
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
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tabVisaOrder">
                        <table class="table table-bordered">
                            <thead class="well table-bordered">
                                <tr>
                                    <th>Order #</th>
                                    <th>Order Date</th>
                                    <th>Visa Details</th>
                                    <th>Applicants</th>
                                    <th>Agent's Name</th>
                                    <th>Value</th>
                                    <th>Visa</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php
                                if ($visaInfo):
                                    foreach ($visaInfo as $visa):
                                        ?>
                                        <tr>
                                            <td><a href="#visaAppModal" class="loadVisaView" data-toggle="modal" data-application-id="<?php echo $visa['Visa_Booking']['id']; ?>" data-remote="<?= SITE_URL . "/admin/view_visadetails/" . $visa['Visa_Booking']['id'] . '?interface=agent'; ?>"><b>#<?php echo str_pad($visa['Visa_Booking']['id'], 5, 0, STR_PAD_LEFT); ?></b></a></td>
                                            <td><?php echo date("M j, Y", strtotime($visa['Visa_Booking']['date_added'])); ?></td>
                                            <td>
                                                <span><b><?= $visa['Visa']['title']; ?></b></span>
                                                <span><?= "Validity: " . $visa['Visa']['validity'] . " days"; ?></span>
                                            </td>
                                            <td>
                                                <span><a href="mailto:<?= $visa['Visa_Booking']['email']; ?>"><?php echo strtolower($visa['Visa_Booking']['email']) . " | " . $visa['Visa_Booking']['phone']; ?></a></span>
                                                <span><?= "Arrival: " . date("M j, Y", strtotime($visa['Visa_Booking']['arrival'])); ?></span>
                                                <span><?= "Pax Size: " . str_pad($visa['Visa_Booking']['pax_count'], 2, '0', STR_PAD_LEFT); ?></span>
                                            </td>
                                            <td><?php echo ucwords($visa['agent_name']) . " ( #" . $visa['Visa_Booking']['agent_id'] . " )"; ?></td>
                                            <td><?php echo ($visa['Visa_Booking']['price'] == 0) ? ' - ' : CURRENCY . " " . ($visa['Visa_Booking']['price']); ?></td>
                                            <td>
                                                <span class="download-visa-<?php echo $visa['Visa']['id'] ?>">
        <?php if (!is_null($visa['Visa_Booking']['visa_file_name'])) { ?>
                                                        <a href="<?php echo SITE_URL . '/admin/download_visa_document/' . json_decode($visa['Visa_Booking']['visa_file_name']); ?>"><i style="cursor: pointer" class="icon-download-visa-active"></i>Visa </a>
                                                    <?php } else { ?>
                                                        <!-- i style="cursor: not-allowed" class="icon-file" onclick="javascript:alert('No Visa Document To Download');"></i -->
                                                        <i class="icon-download-visa"></i>
                                                <?php } ?>
                                                </span>
                                            </td>
                                            <td>
                                        <?php $btn = ($visa['status'] == 'approved') ? 'success' : ( ($visa['status'] == 'rejected') ? 'danger' : 'warning' ); ?>
                                                <span class="badge badge-<?= $btn; ?> <?php echo $visa['Visa_Booking']['id']; ?>-status"><?= ucwords(strtolower($visa['status'])); ?></span>
                                            </td>
                                        </tr>
    <?php
    endforeach;
endif;
?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tabPackageBooking" tabindex="-1">
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
<script>
        $(document).ready(function() {
            $("#tabPackageBooking").attr("disabled", "disabled");
            $("#tabPackageBooking").css("background-color", "#F6F9F9");
        });
</script>