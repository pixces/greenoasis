<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1>Visas</h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="content-left row-fluid">
                <?php if ($visalist){
                    foreach($visalist as $visa){
                        $data = $visa['Visa'];
                ?>
                        <div class="visa-item pull-left">
                            <img class="pull-left img-rounded" src="<?php echo SITE_IMAGE.'visa-125x125-01.jpg'; ?>" />
                            <div class="pull-left metadata">
                                <a href="<?php echo SITE_URL.'/visa/view/'.$data['slug'].'/'; ?>">
                                    <h1><?=$data['title']; ?></h1>
                                </a>
                                <span class="block">
                                    <span><?=$data['duration']." Processing time"; ?></span>
                                </span>
                                <span class="block">
                                    <span class="visa-price"><?='$'.$data['price']; ?><small>per visa</small></span>
                                </span>
                                <a href="<?php echo SITE_URL.'/visa/view/'.$data['slug'].'/'; ?>"><button class="btn btn-success" type="button">Apply Now!</button></a>
                            </div>
                        </div>
                <?php }
                } ?>
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