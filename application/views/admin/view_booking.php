<?php
  switch($booking['Hotel_Reservation']['status']){
      case 'request':
          $status['text'] = 'On Request';
          $status['css'] = 'error';
          break;
      case 'confirm':
          $status['text'] = 'Approved';
          $status['css'] = 'success';
          break;
      case 'rejected':
      case 'hold':
          $status['text'] = 'Rejected';
          $status['css'] = 'error';
          break;
  }
?>
<div class="alert alert-<?=$status['css']; ?>">
    <strong>Booking <?=$status['text']; ?></strong>
</div>
<table width="100%" class="bookingInfo">
    <tr>
        <td width="35%">
            <span class="tdLabel">Booking No.#</span>
            <span class="tdContent"><?=str_pad($booking['Hotel_Reservation']['id'],5,0,STR_PAD_LEFT); ?></span>
        </td>
        <td width="30%">
            <span class="tdLabel">Booking Date</span>
            <span class="tdContent"><?=date('F d, Y', strtotime($booking['Hotel_Reservation']['date_added'])); ?></span>
        </td>
        <td width="35%">
            <span class="tdLabel">Agent</span>
            <span class="tdContent"><?=$booking['Hotel_Reservation']['agent_name']." (".$booking['Hotel_Reservation']['agent_id'].")"; ?></span>
        </td>
    </tr>
</table>
<hr />
<table width="100%" class="hotelInfo">
    <tr>
        <td width="65%">
            <span class="tdLabel">Hotel Details</span>
            <span class="tdContent"><?=$booking['Hotel']['hotel_name']; ?></span>
            <span class="tdContent"><?=$booking['Hotel']['hotel_address']; ?></span>
        </td>
        <td width="35%">
            <span class="tdLabel">Pax Details</span>
            <span class="tdContent"><?=$booking['Hotel_Reservation']['customer_name']; ?> (<?=$booking['Hotel_Reservation']['pax_adult']; ?> Adult | <?=$booking['Hotel_Reservation']['pax_children']; ?> Child)</span>
        </td>
    </tr>
</table>
<hr />
<table width="100%" class="packageInfo">
    <tr>
        <td width="35%">
            <span class="tdLabel">CheckIn:</span>
            <span class="tdContent"><?=date('F d, Y', strtotime($booking['Hotel_Reservation']['fromDate'])); ?></span>
        </td>
        <td width="30%">
            <span class="tdLabel">CheckOut:</span>
            <span class="tdContent"><?=date('F d, Y', strtotime($booking['Hotel_Reservation']['toDate'])); ?></span>
        </td>
        <td width="35%">
            <span class="tdLabel">Nights:</span>
            <span class="tdContent"><?=$booking['Hotel_Reservation']['nights']; ?></span>
        </td>
    </tr>
    <tr>
        <td width="35%">
            <span class="tdLabel">Room Type:</span>
            <span class="tdContent"><?=$booking['Hotel_Tariff']['room_type']; ?></span>
        </td>
        <td width="30%">
            <span class="tdLabel">Rate Basis:</span>
            <span class="tdContent"><?=$booking['Hotel_Tariff']['meal_plan']; ?></span>
        </td>
        <td width="35%">
            <span class="tdLabel">Room(s):</span>
            <span class="tdContent"><?=$booking['Hotel_Reservation']['room_count']; ?></span>
        </td>
    </tr>
</table>
<hr />
<?php if ($booking['Hotel_Reservation']['inclusions']) { ?>
    <table class="room-info" width="100%">
        <tr>
            <td><span class="tdLabel">Room Plan:</span></td>
            <td><span class="tdLabel">Price/Night:</td>
            <td><span class="tdLabel"># Nights:</td>
            <td><span class="tdLabel">Qty:</td>
            <td><span class="tdLabel">Price:</td>
        </tr>
        <?php foreach (json_decode($booking['Hotel_Reservation']['inclusions'], true) as $plan=>$detail) { ?>
            <tr>
                <td class="btmBrdr"><span class="tdContent"><?=ucwords($detail['plan'])." Room"; ?></span></td>
                <td class="btmBrdr"><span class="tdContent"><?=$detail['unit_price']; ?></span></td>
                <td class="btmBrdr"><span class="tdContent"><?=$detail['nights']; ?></span></td>
                <td class="btmBrdr"><span class="tdContent"><?=$detail['qty']; ?></span></td>
                <td class="btmBrdr"><span class="tdContent"><?=$detail['total']; ?></span></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="btmBrdr"></td>
            <td class="btmBrdr"></td>
            <td class="btmBrdr"></td>
            <td class="btmBrdr"><span class="criteria-label"><b>Grand Total</b></span></td>
            <td class="btmBrdr"><span class="criteria-label"><b><?=$booking['Hotel_Reservation']['price']; ?></b></span></td>
        </tr>
    </table>
<?php } ?>
<div class="bookingInstructions">
    <?php if ($booking['Hotel_Reservation']['instructions']){ ?>
        <span class="label">Booking Instructions:</span>
        <ul>
            <?php foreach(json_decode($booking['Hotel_Reservation']['instructions'], true) as $instr){ ?>
                <li><?=$instr; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <?php if ($booking['Hotel_Reservation']['addl_instructions']){ ?>
        <span class="label">Special Instructions:</span>
        <p><?=$booking['Hotel_Reservation']['addl_instructions']; ?></p>
    <?php } ?>
</div>