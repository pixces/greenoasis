<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1>Agent: Registration</h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="content-left">
                <h1>Agent registration process instructions</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p>Already registered? <a href="<?=SITE_URL; ?>/agent/login">Click here to Login</a></p>
                <?php if ($error){ ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    <?php echo $error; ?>
                </div>
                <?php } ?>
                <form id="AgentRegistration" class="form-horizontal agent-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mm_form" value="registerAgent">
                    <legend>Agent Details</legend>
                    <div class="control-group">
                        <label class="control-label">Name of Company</label>
                        <div class="controls"><input name="agent[company]"  id="agent_company" type="text" class="span4"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls"><input name="agent[email]"  id="agent_email" type="text" class="span4"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Contact Person</label>
                        <div class="controls"><input name="agent[contact]"  id="agent_contact" type="text" class="span4"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">City</label>
                        <div class="controls"><input name="agent[city]"  id="agent_city" type="text" class="span4"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Country</label>
                        <div class="controls"><input name="agent[country]"  id="agent_country" type="text" class="span4"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Phone Number</label>
                        <div class="controls"><input name="agent[phone]"  id="agent_phone" type="text" class="span4"></div>
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
            <?php foreach(Utils::getBanners('small') as $banner){ ?>
                <div class="widget adv300-170">
                    <a href="<?=$banner['url']; ?>" class="">
                        <img src="<?=$banner['image']; ?>" width="300" height="250"/>
                    </a>
                </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End: Main Content --->
<script>
    $(document).ready(function(){
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9._\s]+$/);
        },"Valid names please.");

        $("#AgentRegistration").validate({
            debug:true,
            rules:{
                "agent[company]":{
                    required: true,
                    alpha: true
                },
                "agent[email]":{
                    required: true,
                    email: true
                },
                "agent[contact]":{
                    required: true,
                    alpha: true
                },
                "agent[city]":{
                    required: true,
                    alpha: true
                },
                "agent[country]":{
                    required: true,
                    alpha: true
                },
                "agent[phone]":{
                    required: true,
                    number: true,
                    minlength:10,
                    maxlength:15
                }
            },
            message:{
               "agent[contact]":{
                   alpha: "Please enter a valid contact name"
               },
               "agent[city]":{
                   alpha: "Enter a valid city name"
               },
               "agent[country]":{
                   alpha: "Select Country from the list"
               },
               "agent[phone]":{
                   alpha: "Enter a valid Phone/Mobile Number. No Special characters allowed"
               }
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>