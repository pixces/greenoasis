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
            <?php foreach(Utils::getBanners('small') as $banner){ ?>
                <div class="widget adv300-170">
                    <a href="<?=$banner['url']; ?>" class="">
                        <img src="<?=$banner['image']; ?>" width="300" height="250"/>
                    </a>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->