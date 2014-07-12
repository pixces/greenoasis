<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="alert " style='display:none;'></div>
        <div class="container-main pull-left  agent-edit-section ">
            <div class="content-left">
                
                
                
                <form id="AgentEditForm" class="form-horizontal agent-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mm_form" value="registerAgent">
                    <legend>Agent Details</legend>
                    <div class="control-group">
                        <label class="control-label">Name of Company</label>
                        <div class="controls"><input name="agent[company]"  id="agent_company" type="text" class="span4" required value="<?php echo $agents['Agent']['company'];?>"></div>
                    </div>
<!--                    <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls"><input name="agent[email]"  id="agent_email" type="text" class="span4" required value="<?php echo $agents['Agent']['email'];?>"></div>
                    </div>-->
                    <div class="control-group">
                        <label class="control-label">Contact Person</label> 
                        <div class="controls"><input name="agent[contact]"  id="agent_contact" type="text" class="span4" required value="<?php echo $agents['Agent']['contact'];?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">City</label>
                        <div class="controls"><input name="agent[city]"  id="agent_city" type="text" class="span4" required value="<?php echo $agents['Agent']['city'];?>"></div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Province</label>
                        <div class="controls"><input name="agent[province]"  id="province" type="text" class="span4"  value="<?php echo $agents['Agent']['province'];?>"></div>
                    </div>
                    
                      <div class="control-group">
                        <label class="control-label">Zip</label>
                        <div class="controls"><input name="agent[zip]"  id="zip" type="text" class="span4" required  value="<?php echo $agents['Agent']['zip'];?>"></div>
                    </div>
                    
                    
                    <div class="control-group">
                        <label class="control-label">Country</label>
                        <div class="controls"><input name="agent[country]"  id="agent_country" type="text" class="span4" required value="<?php echo $agents['Agent']['country'];?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Phone Number</label>
                        <div class="controls"><input name="agent[phone]"  id="agent_phone" type="text" class="span4" required value="<?php echo $agents['Agent']['phone'];?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Alternative  Number</label>
                        <div class="controls"><input name="agent[alt_phone]"  id="agent_alt_no" type="text" class="span4" required value="<?php echo $agents['Agent']['alt_phone'];?>"></div>
                    </div>
                    
                      <div class="control-group">
                        <label class="control-label">Fax</label>
                        <div class="controls"><input name="agent[fax]"  id="agent_fax" type="text" class="span4"  value="<?php echo $agents['Agent']['fax'];?>"></div>
                    </div>
                    
                      
                      
                      <div class="control-group">
                        <label class="control-label">Status </label>
                        <div class="controls">
                            <?php $status=array('pending', 'approved', 'inactive', 'expired');?>
                            
                            <select name="agent[status]" id="agent_status">
                                <?php foreach($status as $option): ?>
                                <option value="<?php echo $option;?>"  <?php echo strcmp( $option,$agents['Agent']['status'])==0 ? "selected='selected'":'' ?>><?php echo $option;?></option>
                                <?php endforeach;?>
                            </select>
                            
                        </div>
                    </div>
                      <div class="control-group">
                        <label class="control-label">Grace Fund</label>
                        <div class="controls"><input name="agent[grace_fund]"  id="agent_gracefund" type="text" class="span4" required value="<?php echo $agents['Agent']['grace_fund'];?>"></div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="hidden" name="mm_form" value="editAgent"/>
                            <input type="hidden" name="agent[id]"  value="<?php echo $agents['Agent']['id'];?>"/>
                            <input type="submit" class="btn btn-green" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->