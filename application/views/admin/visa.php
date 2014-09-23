<ul class="list-panel">
    <?php if ($visas) {
        foreach($visas as $visa) {
            $data = $visa['Visa'];
            ?>
            <li id="visa-<?=$data['id']; ?>" class="item media">
                <a class="pull-left" href="#">
                    <img class="img-polaroid padding2" src="<?=SITE_IMAGE.'/visa-125x125-01.jpg'; ?>">
                </a>
                <div class="media-body pull-left">
                    <section class="title"><?=ucwords(strtolower($data['title'])); ?></section>
                    <section class="media-category" style="padding-bottom:5px">
                        <span><i class="icon icon-tags"></i> <strong><?=ucwords(strtolower($data['type'])); ?> Visa </strong></span>
                        <?php if ($data['duration']) { ?>
                            <span> &mdash; <strong><?=$data['duration']; ?></strong></span>
                        <?php } ?>
                    </section>
                    <div class="media-meta-horizontal">
                        <span>Duration: <?=$data['duration']; ?></span>
                        <span>Starts from <?=$data['price']; ?> $</span>
                    </div>
                </div>
                <div class="media-action pull-right">
                    <span><i class="icon-calendar"></i> <?=date('F d, Y h:i:s', strtotime($data['date_modified'])); ?></span>
                    <span class="button-bar">
                        <span>
                            <?php $btnType = ($data['status'] == 'active') ? 'btn-success' : 'btn-warning'; ?>
                            <button class="toggle-status btn btn-small <?=$btnType; ?>" type="button" data-type="visa" data-action="change_status" id="<?=$data['id']; ?>" data-value="<?=$data['status']; ?>" title="Click to Change Status"><?=ucwords($data['status']); ?></button>
                            <?php
                            $btnType = '';
                            $icon = 'icon-thumbs-down';
                            if ($data['featured'] == 1){
                                $icon = 'icon-thumbs-up icon-white';
                                $btnType = 'btn-inverse';
                            }
                            ?>
                            <a href="<?=SITE_URL.'/admin/visa_edit/'.$data['id']; ?>" id="<?=$data['id']; ?>" title="Edit Visa" class="btn btn-mini"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0);" class="delete-link btn btn-mini" id="<?=$data['id']; ?>" data-type="visa" data-action="delete" data-title="<?=$data['title']; ?>" title="Delete Visa"><i class="icon-trash"></i></a>
                        </span>
                    </span>
                </div>

                <div class="clearfix"></div>
            </li>
        <?php }
    } ?>
</ul>