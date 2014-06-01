<div>

</div>
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
                            <span class="count"><?=sprintf("$%s",number_format($agent['Summary']['total'])); ?></span>
                        </div>

                        <div class="used <?=$agent['Summary']['balance'] < 0 ? 'red' : 'na'; ?>">
                            <span class="pull-left">Used</span>
                            <?php echo sprintf('<span class="count">$%s</span>',number_format($agent['Summary']['used'])); ?>
                        </div>

                        <div class="grace na">
                            <span class="pull-left">Grace</span>
                            <span class="count"><?=sprintf("$%s",number_format($agent['Agent']['grace_fund'])); ?></span>
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
                            <a href="#agentFundModal" data-toggle="modal" class="btn btn-mini" data-type="agent" data-action="add-funds" title="Add Funds"><i class="icon-plus-sign"></i> Funds</a>
                            <a href="#agentEditModal" data-toggle="modal" id="<?=$agent['Agent']['id']; ?>" title="Edit Agent Details <?=$agent['Agent']['company']; ?>" class="btn btn-mini"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0);" id="<?=$agent['Agent']['id']; ?>" data-name="<?=$agent['Agent']['company']; ?>" class="agent-delete btn btn-mini" title="Delete Agent <?=$agent['Agent']['company']; ?>"><i class="icon-trash"></i></a>
                        <?php } ?>
                    </span>
                </div>
            </li>
        <?php } } ?>
</ul>
<!--Begin:Modal for agent fund-->
        <div id="agentFundModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="agentFundModalLabel" aria-hidden="true">
                <div class="modal-header well">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 style="color: 90c53f;" id="agentFundModalLabel">Agent Funds</h3>
                </div>
                <div class="modal-body well">
                    <form id="AgentAddFund" class="form-horizontal agent-form" method="post">
                        <input type="hidden" name="agent_id" value="<?=$agent['Agent']['id']; ?>">
                    <h2><?=$agent['Agent']['company']; ?></h2>

                    <div class="control-group">
                        <label class="control-label">Add Fund</label>
                        <div class="controls"><input name="addFund" id="" type="text" class="span4" required=""></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </div>
                    </form>
                </div>
              </div>
        <!--End:Modal for agent fund-->
        <!--Begin:Agent Edit Modal-->
        <div id="agentEditModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="agentEditModalLabel" aria-hidden="true">
                <div class="modal-header well">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 style="color: 90c53f;" id="agentEditModalLabel">Edit Agent Info : <?=$agent['Agent']['company']; ?></h3>
                </div>
                <div class="modal-body well">
                    <form id="AgentEdit<?=$agent['Agent']['id']; ?>" class="form-horizontal agent-form" method="post" >
                    <input type="hidden" name="mm_form" value="registerAgent">
                    
                    <div class="control-group">
                        <label class="control-label">Name of Company</label>
                        <div class="controls"><input name="agent[company]" id="agent_company" type="text" class="span4" required=""></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls"><input name="agent[email]" id="agent_email" type="text" class="span4" required=""></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Contact Person</label>
                        <div class="controls"><input name="agent[contact]" id="agent_contact" type="text" class="span4" required=""></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">City</label>
                        <div class="controls"><input name="agent[city]" id="agent_city" type="text" class="span4" required=""></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Country</label>
                        <div class="controls"><input name="agent[country]" id="agent_country" type="text" class="span4" required=""></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Phone Number</label>
                        <div class="controls"><input name="agent[phone]" id="agent_phone" type="text" class="span4" required=""></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </div>
                </form>
                </div>
              </div>
        <!--End:Agent Edit Modal-->
        <script>
            $(function(){

                $('#AgentAddFund').submit(function(){
                    alert("form submited");

                    return false;
                });


            })
        </script>