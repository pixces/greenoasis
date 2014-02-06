<!-- Start: Main Content --->
<div id="page_<?=$page['slug']; ?>" class="static-view content bg-white">
    <div class="container">
        <div class="heading"><h1><?=$page['title']; ?></h1></div>
        <div class="container-main pull-left box-shadow">
            <!-- page static content -->
            <?php if ($page['image']) { ?>
                <!-- display image if present /-->
                <div class="media-container pull-left">
                    <img class="img-polaroid" src="<?php echo SITE_UPLOAD.PREFIX_SMALL.$page['image']; ?>" width="<?=IMG_WIDTH_SMALL; ?>" height="<?=IMG_HEIGHT_SMALL; ?>" />
                </div>
            <?php } ?>
            <!-- display page content /-->
            <div class="content">
                <?php echo $page['content']; ?>
            </div>
            <!-- display Video -->
            <?php if($page['video_url']) { ?>
            <div class="video-container">
                <iframe width="560" height="315" src="<?=$page['video_url']; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <?php } ?>
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
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->