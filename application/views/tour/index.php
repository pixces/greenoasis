<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1>Packages</h1></div>
        <div class="container-main pull-left box-shadow">
            <section class="package-item-list" data-name="tours">
                <h1>Tour Packages</h1>
                <?php if($package['tours']){
                    foreach($package['tours'] as $data){
                        ?>
                        <div class="package-item pull-left">
                            <a href="<?=SITE_URL; ?>/packages/view/?pid=<?=$data['id']; ?>&city=5&pType=<?=$data['type']; ?>">
                                <img src="<?php echo SITE_UPLOAD.PREFIX_THUMB.$data['image']; ?>" width="168" height="168"/>
                                <h1><?=$data['title']; ?></h1>
                            </a>
                            <p><?=$data['details']; ?></p>
                        </div>
                    <?php
                    }
                } ?>
                <div class="clear"></div>
            </section>
            <section class="package-item-list" data-name="combo">
                <h1>Combo Offers</h1>
                <?php if($package['combo']){
                    foreach($package['combo'] as $data){
                        ?>
                        <div class="package-item pull-left">
                            <a href="<?=SITE_URL; ?>/packages/view/?pid=<?=$data['id']; ?>&city=5&pType=<?=$data['type']; ?>">
                                <img src="<?php echo SITE_UPLOAD.PREFIX_THUMB.$data['image']; ?>" width="168" height="168"/>
                                <h1><?=$data['title']; ?></h1>
                            </a>
                            <p><?=$data['details']; ?></p>
                        </div>
                    <?php
                    }
                } ?>
                <div class="clear"></div>
            </section>
        </div>
        <div class="sidebar pull-right">
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/img03.png" width="300" height="170"/>
                <div class="caption inverse">
                    <span><small>Online visa for Dubai,</small></span>
                    <span class="text-large">@ $100</span>
                </div>
            </div>
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/advt.png" width="300" height="250"/>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->