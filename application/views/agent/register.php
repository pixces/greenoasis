<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1>Agent: Registration</h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="content-left">
                
                <?php if ($error){ ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    <?php echo $error; ?>
                </div>
                <?php } ?>
                <form id="AgentRegistration" class="form-horizontal agent-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mm_form" value="registerAgent">
                    <legend>Agent Registration Form</legend>
                    <div class="control-group">
                        <label class="control-label">Name of Company</label>
                        <div class="controls"><input name="agent[company]"  id="agent_company" type="text" class="span4" required></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls"><input name="agent[email]"  id="agent_email" type="text" class="span4" required></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Contact Person</label>
                        <div class="controls"><input name="agent[contact]"  id="agent_contact" type="text" class="span4" required></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">City</label>
                        <div class="controls"><input name="agent[city]"  id="agent_city" type="text" class="span4" required></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Country</label>
                        <div class="controls"><input name="agent[country]"  id="agent_country" type="text" class="span4" required></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Phone Number</label>
                        <div class="controls"><input name="agent[phone]"  id="agent_phone" type="text" class="span4" required></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="submit" class="btn btn-green" value="Submit Application">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="sidebar pull-right">
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/img03.png" width="300" height="170"/>
                <div class="caption inverse">
                    <span><small>Online visa for Dubai,</small></span>
                    <span class="text-large">@ $100</span>
                </div>
            </div>
            <div class="widget adv300-170">
                <img src="<?=SITE_URL; ?>/images/advt.png" width="300" height="250"/>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->