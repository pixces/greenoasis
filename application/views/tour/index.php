<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1>Packages</h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="pkgNav navShadow">
                <span class="<?php echo ($packageList['holiday']['data']) ? 'active' : ''; ?>"><a href="<?=SITE_URL; ?>/packages/holiday">Holiday Packages</a></span>
                <span class="<?php echo ($packageList['tour']['data']) ? 'active' : ''; ?>"><a href="<?=SITE_URL; ?>/packages/tour">Tour Packages</a></span>
                <span class="last<?php echo ($packageList['combo']['data']) ? ' active' : ''; ?>"><a href="<?=SITE_URL; ?>/packages/combo">Combo Deals</a></span>
            </div>

            <?php foreach($packageList as $type => $data){
                if ($data['data']){
            ?>
            <section class="package-item-list" data-name="<?=$type; ?>">
                <h1><?=$data['label']; ?></h1>
                <?php foreach($data['data'] as $package){ ?>
                        <div class="package-item pull-left">
                            <a href="<?=SITE_URL; ?>/packages/view/?pid=<?=$package['id']; ?>&city=5&pType=<?=$package['type']; ?>">
                                <img src="<?php echo SITE_UPLOAD.PREFIX_THUMB.$package['image']; ?>" width="168" height="168"/>
                                <h1><?=$package['title']; ?></h1>
                            </a>
                            <p><?=$package['details']; ?></p>
                        </div>
                    <?php } ?>
                <div class="clear"></div>
            </section>
            <?php } } ?>
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