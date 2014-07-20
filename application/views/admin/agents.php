<ul class="list-panel">
    <?php if ($agents) {
        foreach($agents as $agent) { ?>
            <li id="agent-<?=$agent['Agent']['id']; ?>" class="item media agent-item">
                <div class="media-body pull-left">
                    <section class="title"><?=$agent['Agent']['company']; ?></section>
                    <section class="contact">
                        <i class="icon icon-user"></i> <strong><?=ucwords(strtolower($agent['Agent']['contact'])); ?></strong> |
                        <i class="icon icon-envelope"></i> <?=$agent['Agent']['phone']; ?> |
                        <a href="mailto:<?=strtolower($agent['Agent']['email']); ?>"><?=strtolower($agent['Agent']['email']); ?></a>
                    </section>
                    <section class="small"><i class="icon icon-map-marker"></i> <?=strtolower($agent['Agent']['city']); ?>, <?=strtolower($agent['Agent']['country']); ?></section>
                    <section class="contact credit">
                        <div class="total na">
                            <span class="pull-left">Total</span>
                            <span class="count" data-count="<?php echo $agent['Summary']['total']?>"><?=sprintf("$%s",number_format($agent['Summary']['total'])); ?></span>
                        </div>

                        <div class="used <?=$agent['Summary']['balance'] < 0 ? 'red' : 'na'; ?>">
                            <span class="pull-left">Used</span>
                            <?php echo sprintf('<span class="count">$%s</span>',number_format($agent['Summary']['used'])); ?>
                        </div>

                        <div class="grace na">
                            <span class="pull-left">Grace</span>
                            <span class="count" ><?=sprintf("$%s",number_format($agent['Agent']['grace_fund'])); ?></span>
                        </div>
                    </section>
                </div>

                <div class="media-meta pull-left credit">
                    Credits Balance
                    <span class="balance">
                        <?php if ($agent['Summary']['balance'] < 0) {
                            echo sprintf("<span class='red'>($%s)</span>",number_format(str_replace("-",'',$agent['Summary']['balance'])));
                        } else {
                            echo sprintf("$%d",$agent['Summary']['balance']);
                        }
                        ?>
                    </span>
                </div>
                <div class="media-action pull-right">
                    <span><i class="icon-calendar"></i> <?=date('F d, Y', strtotime($agent['Agent']['date_added'])); ?></span>
                    <span class="button-bar">
                        <?php if ($agent['Agent']['status'] == 'pending') { ?>
                            <!-- display only approve & Reject Buttons //-->
                            <a href="<?=SITE_URL; ?>/admin/agent_approve/<?=$agent['Agent']['id']; ?>" id="<?=$agent['Agent']['id']; ?>" title="Approve Agent" class="btn btn-success">Approve</a>
                            <a href="javascript:void(0);" id="<?=$agent['Agent']['id']; ?>" data-name="<?=$agent['Agent']['title']; ?>" class="agent-delete btn btn-danger" title="Reject Agent">Reject</a>
                        <?php } else { ?>
                            <?php $btnType = ($agent['Agent']['status'] == 'approved') ? 'btn-success' : 'btn-warning'; ?>
                            <button class="toggle-status btn btn-mini <?=$btnType; ?>" type="button" data-type="agent" data-action="change_status" id="<?=$agent['Agent']['id']; ?>" data-value="<?=$agent['Agent']['status']; ?>" title="Click to Change Status"><?=ucwords($agent['Agent']['status']); ?></button>
                            <a class="btn btn-mini btn-funds" data-type="agent" data-action="add-funds" id="<?=$agent['Agent']['id']; ?>" data-name="<?=$agent['Agent']['company']; ?>" title="Add Funds" href="#divAgentModel" role="button" data-toggle="modal" date-agent-id="<?=$agent['Agent']['id']; ?>"><i class="icon-plus-sign"></i> Funds</a>
                           <a href="#agentAppModal"  class="btn btn-mini" data-toggle="modal" 
                                   data-remote="<?= SITE_URL . "/admin/edit_agent/" . $agent['Agent']['id']; ?>" title="Edit Agent Details <?=$agent['Agent']['company']; ?>"><i class="icon-pencil"></i></a>
                         <?php } ?>
                         <a href="#agentPsswRstAppModal"  class="btn btn-mini agent-password-reset" data-toggle="modal" 
                            data-remote="<?= SITE_URL . "/admin/resetAgentPassword/" . $agent['Agent']['id']; ?>" title="Reset Agent Password"><i class="icon-user" style="background-color:#ff0000"></i></a>   
                    </span>
                </div>
            </li>
        <?php } } ?>
</ul>

<!-- Modal -->
<div id="divAgentModel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Add Funds</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer"></div>
</div>

<!--starts: modal for visa application -->
<div id="agentAppModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:620px; left:49%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="color: 90c53f;" id="visaModalLabel">Edit Agent Information</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer"></div>
</div>
<!--ends: modal for visa application 

<!--Agent Password Reset Modal -->

<div id="agentPsswRstAppModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:620px; left:49%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 style="color: #90c53f;" id="visaModalLabel">Agent Reset Password</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer"></div>
</div>


<!--End of password Modal Window-->