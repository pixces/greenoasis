<div>
</div>
<ul class="list-panel">
    <?php if ($agents) {
        foreach($agents as $agent) { ?>
            <li id="agent-1" class="item media agent-item">
                <div class="media-body pull-left">
                    <section class="title"><?=$agent['company']; ?></section>
                    <section class="contact">
                        <i class="icon icon-user"></i> <strong><?=ucwords(strtolower($agent['contact'])); ?></strong> |
                        <i class="icon icon-envelope"></i> <?=$agent['phone']; ?> |
                        <a href="mailto:<?=strtolower($agent['email']); ?>"><?=strtolower($agent['email']); ?></a>
                    </section>
                    <section class="small"><i class="icon icon-map-marker"></i> <?=strtolower($agent['city']); ?>, <?=strtolower($agent['country']); ?></section>
                    <section class="contact credit">
                        <div class="total na">
                            <span class="pull-left">Total</span>
                            <span class="count">0</span>
                        </div>
                        <div class="used na">
                            <span class="pull-left">Used</span>
                            <span class="count">0</span>
                        </div>
                        <div class="grace na">
                            <span class="pull-left">Grace</span>
                            <span class="count">0</span>
                        </div>
                    </section>
                </div>

                <div class="media-meta pull-left credit">
                    Credits Balance
                    <span class="balance">0</span>
                </div>
                <div class="media-action pull-right">
                    <span><i class="icon-calendar"></i> <?=date('F d, Y', strtotime($agent['date_added'])); ?></span>
                    <span class="button-bar">
                        <?php if ($agent['status'] == 'pending') { ?>
                            <!-- display only approve & Reject Buttons //-->
                            <button class="approve btn btn-success" data-target="#myModal" data-toggle="modal" type="button" data-type="agent" data-action="approve" id="<?=$agent['id']; ?>" title="Approve this agent">Approve</button>
                            <button class="approve btn btn-danger" type="button" data-type="agent" data-action="approve" id="<?=$agent['id']; ?>" title="Reject Agent">Reject</button>
                        <?php } else { ?>
                            <?php $btnType = ($page['status'] == 'active') ? 'btn-success' : 'btn-warning'; ?>
                            <button class="change-status btn btn-small <?=$btnType; ?>" type="button" data-type="page" data-action="swap_status" id="<?=$page['id']; ?>" data-value="<?=$page['status']; ?>" title="Click to Change Status"><?=ucwords($page['status']); ?></button>
                            <a href="<?=SITE_URL; ?>/admin/pages_edit/<?=$page['id']; ?>" id="<?=$page['id']; ?>" title="Edit Page <?=$page['title']; ?>" class="btn btn-mini"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0);" id="<?=$page['id']; ?>" data-name="<?=$page['title']; ?>" class="page-delete btn btn-mini" title="Delete Page <?=$page['title']; ?>"><i class="icon-trash"></i></a>
                        <?php } ?>
                    </span>
                </div>
            </li>
        <?php } } ?>
</ul>