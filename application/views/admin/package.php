<ul class="list-panel">
    <?php if ($packages) {
        foreach($packages as $packageDet) {
            $package = $packageDet['Package'];
            ?>
            <li id="package-<?=$package['id']; ?>" class="item-package media">
                <?php if ($package['image']) { ?>
                    <a class="pull-left" href="#">
                        <img class="img-polaroid padding2" src="<?=SITE_UPLOAD.PREFIX_THUMB.$package['image']; ?>">
                    </a>
                <?php } ?>
                <div class="media-body pull-left">
                    <section class="title"><?=ucwords(strtolower($package['title'])); ?></section>
                    <section class="media-category">
                        <span><i class="icon icon-tags"></i> <strong><?=ucwords(strtolower($package['type'])); ?> Package </strong></span>
                        <?php if ($package['category']) { ?>
                        <span> &bullet; <strong><?=$package['category']; ?></strong></span>
                        <?php } ?>
                    </section>
                    <p><?=$package['description']; ?></p>
                    <div class="media-meta-horizontal">
                        <span>Duration: <?=$package['duration']; ?></span>
                        <span>Starts from <?=$package['price']; ?> $</span>
                    </div>
                </div>
                <div class="media-action pull-right">
                    <span><i class="icon-calendar"></i> <?=date('F d, Y h:i:s', strtotime($package['date_modified'])); ?></span>
                    <span class="button-bar">
                        <span>
                            <?php $btnType = ($package['status'] == 'active') ? 'btn-success' : 'btn-warning'; ?>
                            <button class="toggle-status btn btn-small <?=$btnType; ?>" type="button" data-type="package" data-action="change_status" id="<?=$package['id']; ?>" data-value="<?=$package['status']; ?>" title="Click to Change Status"><?=ucwords($package['status']); ?></button>
                            <?php
                            $btnType = '';
                            $icon = 'icon-thumbs-down';
                            if ($package['featured'] == 1){
                                $icon = 'icon-thumbs-up icon-white';
                                $btnType = 'btn-inverse';
                            }
                            ?>
                            <button class="toggle-featured btn btn-small <?=$btnType; ?>" type="button" data-type="package" data-action="featured" id="<?=$package['id']; ?>" data-value="<?=$package['featured']; ?>" title="Make Featured"><i class="<?=$icon; ?>"></i></button>
                        </span>
                        <span>
                            <a href="<?=SITE_URL.'/admin/package_image/'.$package['id']; ?>" id="<?=$package['id']; ?>" title="Package Images" class="btn btn-mini"><i class="icon-picture"></i></a>
                            <a href="<?=SITE_URL.'/admin/package_edit/'.$package['id']; ?>" id="<?=$package['id']; ?>" title="Edit Package" class="btn btn-mini"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0);" class="delete-link btn btn-mini" id="<?=$package['id']; ?>" data-type="package" data-action="delete" data-title="<?=$package['title']; ?>" title="Delete Package"><i class="icon-trash"></i></a>
                        </span>
                    </span>
                </div>

                <div class="clearfix"></div>
            </li>
        <?php }
    } ?>
</ul>