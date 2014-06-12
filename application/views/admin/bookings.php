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
                <tr><th colspan="13">Today's Hotel Booking </th></tr>
                <tr>
                    <th>Sl</th>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Agent's Name</th>
                    <th>Customer's Name</th>
                    <th>Hotel</th>
                    <th>Check In</th>
                    <th>Check out</th>
                    <th>Room Type</th>
                    <th>Status</th>
                    <th>Amount</th>


                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                <?php foreach ($hotelReservations as $reservation): ?>
                    <tr>

                        <td><?php echo $i++; ?></td>
                        <td><?php echo $reservation['Hotel_Reservation']['id']; ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($reservation['Hotel_Reservation']['date_added'])); ?></td>
                        <td><?php echo ucwords($reservation['agent_name']); ?></td>
                        <td><?php echo $reservation['customer_name']; ?></td>
                        <td><?php echo $reservation['hotel_name']; ?></td>
                        <td><?php echo $reservation['Hotel_Reservation']['fromDate']; ?></td>
                        <td><?php echo $reservation['Hotel_Reservation']['toDate']; ?></td>
                        <td><?php echo ucwords($reservation['Hotel_Reservation']['room_type']); ?></td>
                        <td><?php echo ucwords($reservation['Hotel_Reservation']['booking_status']); ?><span class="caret"></span></td>
                        <td><?php echo $reservation['Hotel_Reservation']['price']; ?></td>
        <!--                <td><button class="btn-small btn-success">view</button></td>
                        <td><button class="btn-small btn-primary">save</button></td>-->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>