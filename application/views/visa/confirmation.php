<!-- Start: Main Content --->
<div class="content bg-white" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="heading"><h1>Visa: Confirmation</h1></div>
        <div class="container-main box-shadow pull-left">
            <section class="header">
                <h1></h1>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
            </section>
            <section class="confirm-details section-body">
                <ul class="visa-info pull-left clearfix">
                    <li class="pull-left">
                        <span class="meta-label">Application No.:</span>
                        <span class="meta-details">VISA-<?=$visa['Visa_Booking']['id']; ?></span>
                    </li>
                    <li class="pull-left bigbox">
                            <span class="pull-left info-section">
                                <span class="meta-label">Package:</span>
                                <span class="meta-details"><?=ucwords($visa['Visa_Booking']['type'])." (".$visa['Visa_Booking']['validity']." days)"; ?></span>
                            </span>
                            <span class="pull-left info-section">
                                <span class="meta-label">Pax Size:</span>
                                <span class="meta-details"><?=$visa['Visa_Booking']['pax_count']." nos"; ?></span>
                            </span>
                            <span class="pull-left info-section">
                                <span class="meta-label">Expected Arrival:</span>
                                <span class="meta-details"><?=date('D d M, Y', strtotime($visa['Visa_Booking']['arrival'])); ?></span>
                            </span>
                    </li>
                </ul>
                <ul class="visa-pax-list pull-left clearfix">
                    <li class="pax-label">
                        <span>Name</span>
                        <span>Gender</span>
                        <span>Age</span>
                        <span>Nationality</span>
                        <span>Passport No.</span>
                    </li>
                    <?php foreach($visa['Visa_Pax'] as $pax){ ?>
                        <li>
                            <span><?=$pax['Visa_Pax']['fname']." ".$pax['Visa_Pax']['mname']." ".$pax['Visa_Pax']['lname']; ?></span>
                            <span><?=ucwords(strtolower($pax['Visa_Pax']['gender'])); ?></span>
                            <span>32 Yrs</span>
                            <span><?=ucwords(strtolower($pax['Visa_Pax']['nationality'])); ?></span>
                            <span><?=strtoupper($pax['Visa_Pax']['passport']); ?></span>
                        </li>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </section>
            <section class="footer">
                <h1>Visa Terms Conditions:</h1>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.<p>
                <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. </p>
            </section>
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