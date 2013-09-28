<ul class="list-panel">
    <?php if ($hotels) {
        foreach($hotels as $hotelDet) {
            $hotel = $hotelDet['Hotel'];
            ?>
            <li id="hotel-<?=$hotel['id']; ?>" class="item-hotel media">
                <?php if ($hotel['hotel_logo']) { ?>
                    <a class="pull-left" href="#">
                        <img class="img-polaroid padding2" src="<?=SITE_UPLOAD.PREFIX_LOGO.$hotel['hotel_logo']; ?>">
                    </a>
                <?php } ?>
                <div class="media-body pull-left">
                    <section class="title"><?=ucwords(strtolower($hotel['hotel_name'])); ?></section>
                    <section>
                        <?php for($i=1; $i <= $hotel['hotel_stars']; $i++){ ?>
                            <i class="icon-star"></i>
                        <?php }?>
                    </section>
                    <section class="muted"><i class="icon-map-marker"></i> <?=$hotel['hotel_address']; ?></section>
                    <p><?=UTILS::smartSubStr($hotel['hotel_details'],250); ?></p>
                    <div class="media-meta-horizontal">
                        <span><i class="icon-picture"></i> <?=$hotel['image_count']; ?> Images Added <a href="<?=SITE_URL.'/admin/hotel_image/'.$hotel['id']; ?>"><small>[Manage]</small></a></span>
                        <span><i class="icon-tags"></i> <?=($hotel['tariff_count'] == 0 ) ? 'Add Room Tariff' : 'Manage Room Tariff'; ?> <a href="<?=SITE_URL.'/admin/hotel_tariff/'.$hotel['id']; ?>"><small>[Manage]</small></a></span>
                        <span><i class="icon-briefcase"></i> No Amenities added <a href="<?=SITE_URL.'/admin/hotel_edit/'.$hotel['id']; ?>"><small>[Edit]</small></a></span>
                        <span><i class="icon-bell"></i> No Policies Added <a href="<?=SITE_URL.'/admin/hotel_edit/'.$hotel['id']; ?>"><small>[Edit]</small></a></span>
                    </div>
                </div>
                <div class="media-action pull-right">
                    <?php if($hotel['hotel_website']){ ?>
                    <span><i class="icon-globe"></i> <?=strtolower($hotel['hotel_website']); ?></span>
                    <?php } ?>
                    <span><i class="icon-calendar"></i> <?=date('F d, Y h:i:s', strtotime($hotel['date_modified'])); ?></span>
                    <span class="button-bar">
                        <?php $btnType = ($hotel['status'] == 'active') ? 'btn-success' : 'btn-warning'; ?>
                        <button class="toggle-status btn btn-small <?=$btnType; ?>" type="button" data-type="hotel" data-action="change_status" id="<?=$hotel['id']; ?>" data-value="<?=$hotel['status']; ?>" title="Click to Change Status"><?=ucwords($hotel['status']); ?></button>
                        <a href="<?=SITE_URL; ?>/admin/hotel_edit/<?=$hotel['id']; ?>" id="<?=$hotel['id']; ?>" title="Edit Page <?=$hotel['hotel_name']; ?>" class="btn btn-mini"><i class="icon-pencil"></i></a>
                        <a href="javascript:void(0);" class="delete-link btn btn-mini" id="<?=$hotel['id']; ?>" data-type="hotel" data-action="delete" data-title="<?=$hotel['hotel_name']; ?>" title="Delete hotel; <?=ucwords(strtolower($hotel['hotel_name'])); ?>"><i class="icon-trash"></i></a>
                    </span>
                </div>

                <div class="clearfix"></div>
            </li>
        <?php }
    } ?>
</ul>