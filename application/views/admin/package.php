<ul class="list-panel">
    <?php if ($packages) {
        foreach($packages as $packageDet) {
            $package = $packageDet['Package'];
            ?>
            <li id="package-<?=$package['id']; ?>" class="item-package media">
                <?php if ($package['thumb_image']) { ?>
                    <a class="pull-left" href="#">
                        <img class="img-polaroid padding2" src="<?=SITE_UPLOAD.PREFIX_LOGO.$package['thumb_image']; ?>">
                    </a>
                <?php } ?>
                <div class="media-body pull-left">
                    <section class="title"><?=ucwords(strtolower($package['title'])); ?></section>
                    <p><?=$package['description']; ?></p>
                    <div class="media-meta-horizontal">
                        <span>Type: Tour Package</span>
                        <span>Category: Dow Cruise</span>
                        <span>Duration: 1 Hour</span>
                        <span>Price: 1000 AED</span>
                    </div>

                </div>
                <div class="media-action pull-right">
                    <span><i class="icon-calendar"></i> <?=date('F d, Y h:i:s', strtotime($package['date_modified'])); ?></span>
                    <span class="button-bar">
                        <?php $btnType = ($package['status'] == 'active') ? 'btn-success' : 'btn-warning'; ?>
                        <button class="toggle-status btn btn-small <?=$btnType; ?>" type="button" data-type="package" data-action="change_status" id="<?=$package['id']; ?>" data-value="<?=$package['status']; ?>" title="Click to Change Status"><?=ucwords($package['status']); ?></button>
                        <a href="<?=SITE_URL.'/admin/package_image/'.$package['id']; ?>" id="<?=$package['id']; ?>" title="Package Images" class="btn btn-mini"><i class="icon-picture"></i></a>
                        <a href="<?=SITE_URL.'/admin/package_edit/'.$package['id']; ?>" id="<?=$package['id']; ?>" title="Edit Package" class="btn btn-mini"><i class="icon-pencil"></i></a>
                        <a href="javascript:void(0);" class="delete-link btn btn-mini" id="<?=$package['id']; ?>" data-type="package" data-action="delete" data-title="<?=$package['title']; ?>" title="Delete Package"><i class="icon-trash"></i></a>
                    </span>
                </div>

                <div class="clearfix"></div>
            </li>
        <?php }
    } ?>
</ul>