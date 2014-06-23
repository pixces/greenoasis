<table class="table">
    <thead class="well table-bordered">
        <tr><th colspan="6">Today's Hotel Booking <a href="<?=SITE_URL.'/admin/bookings/'; ?>" class="btn btn-primary pull-right" >More</a></th></tr>
        <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Agent's Name</th>
            <th>Hotel</th>
            <th>No.of Pax</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (empty($dashBoardData['todaysBooking'])) {
            echo "<tr><td>No Hotel Booking's Today.</td></tr>";
        } else {
            $i = 1;
            ?>
            <?php foreach ($dashBoardData['todaysBooking'] as $tbooking) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($tbooking['Hotel_Reservation']['date_added'])); ?></td>
                    <td><?php echo $tbooking['agent_name']; ?></td>
                    <td><?php echo $tbooking['hotel_name']; ?></td>
                    <td><?php echo ($tbooking['Hotel_Reservation']['pax_adult'] + $tbooking['Hotel_Reservation']['pax_children']); ?></td>
                    <td><?php echo $tbooking['Hotel_Reservation']['price'] . CURRENCY; ?></td>
                </tr>
            <?php }
        }
        ?>

    </tbody>
</table>
<table class="table">
    <thead class="well table-bordered">
        <tr><th colspan="6">Today's Visa Applications <a href="<?=SITE_URL.'/admin/visa/'; ?>" class="btn btn-primary pull-right" >More</a></th></tr>
        <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Agent's Name</th>
            <th>Customer Name</th>
            <th>No.of Applications</th>
            <th>Amount</th>
        </tr>
    </thead>
    <?php
    if (empty($dashBoardData['todaysVisa'])) {
        echo '<tr><td>No Visa Application Today.</td></tr>';
    } else {
        ?>
        <tbody>
            <?php $i = 1; ?>
    <?php foreach ($dashBoardData['todaysVisa'] as $tvisa) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($tvisa['Visa']['date_added'])); ?></td>
                    <td><?php echo $tvisa['agent_name']; ?></td>
                    <td><?php echo $tvisa['customer_name']; ?></td>
                    <td><?php echo $tvisa['Visa']['pax_count']; ?></td>
                    <td><?php echo $tvisa['price']; ?></td>
                </tr>
        <?php } ?>
        </tbody>
<?php } ?>

</table>
<!--<table class="table">
    <thead class="well table-bordered">
    <tr><th colspan="6">Today's Package Booking <button class="btn btn-primary pull-right">More</button></th></tr>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Agent's Name</th>
        <th>Hotel</th>
        <th>No.of Pax</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>01</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>02</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>03</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>04</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>05</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    </tbody>
</table>-->
<table class="table">
    <thead class="well table-bordered">
        <tr><th colspan="6">New Agent Applications <a href="<?=SITE_URL.'/admin/agents/'; ?>" class="btn btn-primary pull-right" >More</a></th></tr>
        <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Name</th>
            <th>Country</th>
            <th>Phone</th>
            <th>E-mail</th>
        </tr>
    </thead>
    <?php
    if (empty($dashBoardData['newAgent'])) {
        echo '<tr><td>No Record Exist</td></tr>';
    } else {
        ?>
        <tbody>
            <?php $i = 1; ?>
    <?php foreach ($dashBoardData['newAgent'] as $agent) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($agent['Agent']['date_added'])); ?></td>
                    <td><?php echo $agent['Agent']['contact']; ?></td>
                    <td><?php echo $agent['Agent']['country']; ?></td>
                    <td><?php echo $agent['Agent']['phone']; ?></td>
                    <td><?php echo $agent['Agent']['email']; ?></td>
                </tr>
        <?php } ?>
        </tbody>
<?php } ?>
</table>
<table class="table">
    <thead class="well table-bordered">
        <tr><th colspan="6">7 day's Hotel Booking <a href="<?=SITE_URL.'/admin/bookings/'; ?>" class="btn btn-primary pull-right" >More</a></th></tr>
        <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Agent's Name</th>
            <th>Hotel</th>
            <th>No.of Pax</th>
            <th>Amount</th>
        </tr>
    </thead>
    <?php
    if (empty($dashBoardData['lastsevendaysBooking'])) {
        echo '<tr><td>No Record Exist.</td></tr>';
    } else {
        ?>
        <tbody>
            <?php $i = 1; ?>
    <?php foreach ($dashBoardData['lastsevendaysBooking'] as $tbooking) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($tbooking['Hotel_Reservation']['date_added'])); ?></td>
                    <td><?php echo $tbooking['agent_name']; ?></td>
                    <td><?php echo $tbooking['hotel_name']; ?></td>
                    <td><?php echo ($tbooking['Hotel_Reservation']['pax_adult'] + $tbooking['Hotel_Reservation']['pax_children']); ?></td>
                    <td><?php echo $tbooking['Hotel_Reservation']['price'] . CURRENCY; ?></td>
                </tr>
        <?php } ?>
        </tbody>
<?php } ?>
</table>
<table class="table">
    <thead class="well table-bordered">
        <tr><th colspan="6">7 day's Visa Application <a href="<?=SITE_URL.'/admin/visa/'; ?>" class="btn btn-primary pull-right" >More</a></th></tr>
        <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Agent's Name</th>
            <th>Hotel</th>
            <th>No.of Pax</th>
            <th>Amount</th>
        </tr>
    </thead>
    <?php
    if (empty($dashBoardData['lastsevendaysVisa'])) {
        echo '<tr><td>No Record Exist.</td></tr>';
    } else {
        ?>
        <tbody>
            <?php $i = 1; ?>
    <?php foreach ($dashBoardData['lastsevendaysVisa'] as $tvisa) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("F j, Y, g:i a", strtotime($tvisa['Visa']['date_added'])); ?></td>
                    <td><?php echo $tvisa['agent_name']; ?></td>
                    <td><?php echo $tvisa['customer_name']; ?></td>
                    <td><?php echo $tvisa['Visa']['pax_count']; ?></td>
                    <td><?php echo $tvisa['price'] . CURRENCY; ?></td>
                </tr>
        <?php } ?>
        </tbody>
<?php } ?>
</table>
<!--<table class="table">
    <thead class="well table-bordered">
    <tr><th colspan="6">7 day's Package Booking <button class="btn btn-primary pull-right">More</button></th></tr>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Agent's Name</th>
        <th>Hotel</th>
        <th>No.of Pax</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>01</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>02</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>03</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>04</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    <tr>
        <td>05</td>
        <td>04-04-14</td>
        <td>Thomas Varghese</td>
        <td>Hotel</td>
        <td>No.of Pax</td>
        <td>Amount</td>
    </tr>
    </tbody>
</table>-->
<table class="table">
    <thead class="well table-bordered">
        <tr><th colspan="6">Low Credit Alerts <a href="<?=SITE_URL.'/admin/agents/'; ?>" class="btn btn-primary pull-right" >More</a></th></tr>
        <tr>
            <th>Sl</th>
            <th>Agent's Name</th>
            <th>Current Bal</th>
            <th>Allowed Credits</th>
            <th>Send Mail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (empty($dashBoardData['lowCreditAgents'])) {
            echo "<tr><td>No Record Exist.</td></tr>";
        } else {


            foreach ($dashBoardData['lowCreditAgents'] as $key => $data) {
                ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $data['agent_name']; ?></td>
                    <td><?php echo $data['balance'] . CURRENCY; ?></td>
                    <td><?php echo $data['allowed'] . CURRENCY; ?></td>
                    <td><button class="btn-small btn-success" data-email="<?php echo $data['email'] ?>">send</button></td>
                </tr>
            <?php }
        } ?>
    </tbody>
</table>