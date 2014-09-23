<!-- Start: Main Content --->
<div class="content bg-white">
<div class="container">
<div class="heading"><h1>Hotel Booking: Confirmation</h1></div>
<div class="container-main box-shadow pull-left confirmation">
    <div class="confirmHeader">
        <h1 class="thanks">Thank You!</h1>
        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour, or randomised words which don't look even slightly believable. If you
            are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden
            in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks
            as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200
            Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks
            reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or
            non-characteristic words etc.</p>
    </div>
    <div class="bookingHotel media">
        <a class="pull-left" href="#">
            <img class="media-object img-polaroid" src="<?=SITE_URL."/public/upload/logo_".$booking['hotel']['logo']; ?>">
        </a>
        <div class="bookingInformation media-body">
            <h4>
                <span class="media-heading"><?=$booking['hotel']['name']; ?></span>
                <span class="star star<?=$booking['hotel']['stars']; ?>" title="<?=$booking['hotel']['stars']; ?>-star"></span>
            </h4>
            <span class="hotelLocation"><i class="icon-map"></i> <?=$booking['hotel']['address']; ?></span>
            <span class="hotelContact"><i class="icon-contact"></i> Phone: <?=$booking['hotel']['phone']; ?>, Fax: <?=$booking['hotel']['fax']; ?></span>
            <div class="packageInfo clearfix">
                <span class="pull-left booking-meta-date01">
                    <span class="criteria-label">Check In:</span>
                    <span class="criteria-data"><?=date('D d M, Y', strtotime($booking['reservation']['fromDate'])); ?></span>
                </span>
                <span class="pull-left booking-meta-date01 lft-border">
                    <span class="criteria-label">Check Out:</span>
                    <span class="criteria-data"><?=date('D d M, Y', strtotime($booking['reservation']['toDate'])); ?></span>
                </span>
                <span class="pull-left booking-meta-date01 lft-border">
                    <span class="criteria-label">Nights:</span>
                    <span class="criteria-data"><?=str_pad($booking['reservation']['nights'],2,'0',STR_PAD_LEFT); ?></span>
                </span>
                <span class="pull-left booking-meta-date01 lft-border">
                    <span class="criteria-label">Room[s]:</span>
                    <span class="criteria-data"><?=str_pad($booking['reservation']['room_count'],2,'0',STR_PAD_LEFT); ?></span>
                </span>
                <span class="pull-left booking-meta-date01 lft-border">
                    <span class="criteria-label">Passengers:</span>
                    <span class="criteria-data"><?=sprintf('Adults %d | Children %d',$booking['reservation']['pax_adult'],$booking['reservation']['pax_children']); ?></span>
                </span>
            </div>
            <div class="tariffInfo clearfix">
                <span class="pull-left booking-meta-date01">
                    <span class="criteria-label">Room Type:</span>
                    <span class="criteria-data"><?=$booking['tariff']['room_type']; ?></span>
                </span>

                <span class="pull-left booking-meta-date01 lft-border">
                    <span class="criteria-label">Rate Basis:</span>
                    <span class="criteria-data">BB [Bed & Breakfast]</span>
                </span>
            </div>
            <?php if ($booking['occupancy']) { ?>
            <table class="room-info">
                <tr>
                    <td class="booking-metaTblHead"><span class="criteria-label">Room Plan:</span></td>
                    <td class="booking-metaTblHead lft-border"><span class="criteria-label">Price/Night:</td>
                    <td class="booking-metaTblHead lft-border"><span class="criteria-label">No.of Nights:</td>
                    <td class="booking-metaTblHead lft-border"><span class="criteria-label">Qty:</td>
                    <td class="booking-metaTblHead lft-border"><span class="criteria-label">Price:</td>
                </tr>
                <?php foreach ($booking['occupancy'] as $plan=>$detail) { ?>
                <tr>
                    <td class="booking-metaTblData"><span class="criteria-data"><?=ucwords($detail['plan'])." Room"; ?></span></td>
                    <td class="booking-metaTblData lft-border"><span class="criteria-data"><?=$detail['unit_price']; ?></span></td>
                    <td class="booking-metaTblData lft-border"><span class="criteria-data"><?=$detail['nights']; ?></span></td>
                    <td class="booking-metaTblData lft-border"><span class="criteria-data"><?=$detail['qty']; ?></span></td>
                    <td class="booking-metaTblData lft-border"><span class="criteria-data"><?=$detail['total']; ?></span></td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="booking-metaTblTotal"></span></td>
                    <td class="booking-metaTblTotal"></span></td>
                    <td class="booking-metaTblTotal"></span></td>
                    <td class="booking-metaTblTotal lft-border top-border"><span class="criteria-label">Grand Total</span></td>
                    <td class="booking-metaTblTotal lft-border top-border"><span class="criteria-label"><?=$booking['reservation']['price']; ?></span></td>
                </tr>
            </table>
            <?php } ?>
            <div class="bookingInstructions">
                <?php if ($booking['reservation']['instructions']){ ?>
                    <span class="criteria-label">Booking Instructions:</span>
                    <ul>
                        <?php foreach(json_decode($booking['reservation']['instructions'], true) as $instr){ ?>
                            <li><?=$instr; ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <?php if ($booking['reservation']['addl_instructions']){ ?>
                    <span class="criteria-label">Special Instructions:</span>
                    <p><?=$booking['reservation']['addl_instructions']; ?></p>

                <?php } ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="sidebar pull-right">
    <?php foreach(Utils::getBanners('small') as $banner){ ?>
        <div class="widget adv300-170">
            <a href="<?=$banner['url']; ?>" class="">
                <img src="<?=$banner['image']; ?>" width="300" height="250"/>
            </a>
        </div>
    <?php } ?>
    <div class="clear"></div>
</div>
<div class="clearfix"></div>
</div>
</div>
<!-- End: Main Content --->