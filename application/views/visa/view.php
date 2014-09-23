<!-- Start: Main Content --->
<div class="content bg-white">
<div class="container">
<div class="heading"><h1>Visa: <?=$data['title']; ?></h1></div>
<div class="container-main pull-left box-shadow">
<div class="article-header clearfix">
    <div class="tour-gallery main-header">
        <h1><?=$data['title']; ?></h1>
        <section class="info-box clearfix">
            <span class="pull-left info-section">
                <span class="meta-label green">Visa Type:</span>
                <span class="meta-details"><?=ucwords($data['type'])." Visa (".$data['validity']." days)"; ?></span>
            </span>
            <span class="pull-left info-section">
                <span class="meta-label green">Process Duration:</span>
                <span class="meta-details"><?=$data['duration']; ?></span>
            </span>
            <span class="pull-left info-section last">
                <span class="meta-price"><?='$'.$data['price']; ?></span>
                <span class="meta-label small">Price per visa</span>
            </span>
            <span class="pull-left info-section last">
                <a href="<?php echo SITE_URL.'/visa/apply/'.$data['slug'].'/?visa='.$data['id'].'&type='.$data['type']; ?>"><button class="btn btn-success" type="button">Apply Now!</button></a>
            </span>
        </section>
        <section>
            <h3>How to apply</h3>
            <?=$data['apply']; ?>
        </section>
    </div>
    <div class="tour-rtside-panel box-shadow square vertical-nav">
        <h5>Other Visas on offer:</h5>
        <ul>
            <?php foreach($visaList as $visa){ ?>
            <li class="<?=($visa['Visa']['id'] == $data['id'])? 'active':''; ?>">
                <a href="<?php echo SITE_URL.'/visa/view/'.$visa['Visa']['slug'].'/'; ?>">
                    <span class="sidebar-list-label">
                        <?=$visa['Visa']['title']; ?>
                    </span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="article-body">
    <!-- tabbed naviagtion -->
    <div class="clearfix package-details tabbable">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Documents</a></li>
            <li><a href="#tab2" data-toggle="tab">Terms & Conditions</a></li>
            <li><a href="#tab3" data-toggle="tab">Rejection Reasons</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <section>
                    <h3>Documents & Process</h3>
                    <?=$data['document']; ?>
                </section>
            </div>
            <div class="tab-pane" id="tab2">
                <section>
                    <h3>Terms & Conditions</h3>
                    <?=$data['terms']; ?>
                </section>
            </div>
            <div class="tab-pane" id="tab3">
                <section>
                    <h3>Reasons for Rejections</h3>
                    <?=$data['rejection']; ?>
                </section>
            </div>
        </div>
    </div>
</div>
</div>
<div class="sidebar pull-right">
    <?php foreach (Utils::getBanners('small') as $banner) { ?>
        <div class="widget adv300-170">
            <a href="<?= $banner['url']; ?>" class="">
                <img src="<?= $banner['image']; ?>" width="300" height="250"/>
            </a>
        </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
</div>