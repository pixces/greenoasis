<div>
</div>
<ul class="list-panel">
    <?php if ($pages) {
        foreach($pages as $page) { ?>
    <li id="page-<?=$page['id']; ?>" class="item media">
        <?php if ($page['image']) { ?>
        <a class="pull-left" href="#">
            <img class="img-polaroid padding2" src="<?=SITE_UPLOAD.'tn_'.$page['image']; ?>">
        </a>
        <?php } ?>
        <div class="media-body pull-left">
            <section class="title"><?=stripslashes($page['title']); ?></section>
            <section class="muted"><i class="icon-globe"></i> <?=SITE_URL.ucwords($page['url']); ?></section>
            <p><?=UTILS::smartSubStr($page['content'],250); ?></p>
        </div>
        <div class="media-action pull-right">
            <?php if($page['video_url']){ ?>
            <span><i class="icon-film"></i> <?=$page['video_url']; ?></span>
            <? } ?>
            <span><i class="icon-calendar"></i> <?=date('F d, Y h:i:s', strtotime($page['date_modified'])); ?></span>
            <span class="button-bar">
                <?php $btnType = ($page['status'] == 'active') ? 'btn-success' : 'btn-warning'; ?>
                <button class="toggle-status btn btn-small <?=$btnType; ?>" type="button" data-type="page" data-action="change_status" id="<?=$page['id']; ?>" data-value="<?=$page['status']; ?>" title="Click to Change Status"><?=ucwords($page['status']); ?></button>
                <a href="<?=SITE_URL; ?>/admin/pages_edit/<?=$page['id']; ?>" id="<?=$page['id']; ?>" title="Edit Page <?=$page['title']; ?>" class="btn btn-mini"><i class="icon-pencil"></i></a>
                <a href="javascript:void(0);" class="delete-link btn btn-mini" id="<?=$page['id']; ?>" data-type="page" data-action="delete" data-title="<?=$page['title']; ?>" title="Delete Page <?=ucwords(strtolower($page['title'])); ?>"><i class="icon-trash"></i></a>
            </span>
        </div>
    </li>
    <?php } } ?>
</ul>