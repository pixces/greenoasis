<!-- Start: Main Content -->
<div id="page_booking" class="static-view content bg-white">
    <div class="container">
        <div class="heading"><h1>Agent Profile</h1></div>
        <div class="container-main box-shadow" style="width: 100%">
            <div>
                <h1 style="margin:0;padding:0;">Agent Profile:</h1>
                <p>Use the form below, to edit / update agents profile.</p>
            </div>
            <!-- display notification on all pages -->
            <?php $flash->get(); ?>
            <!-- Notification ends -->
            <div class="span10">
                <fieldset>
                    <legend>Profile</legend>
                    <form method="post" id="frmAgentProfile" name="agent_profile_form" class="form-horizontal">
                        <input type="hidden" name="agent[id]" value="<?=$agent['id']; ?>">
                        <input type="hidden" name="formAction" value="profile">
                        <div class="control-group">
                            <label class="control-label" for="inputCompany">Company Name</label>
                            <div class="controls">
                                <input name="agent[company]" class="span4 title" type="text" id="inputCompany" required="required"  disabled value="<?=$agent['company']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputContact">Contact Person</label>
                            <div class="controls">
                                <input name="agent[contact]" class="span4" type="text" id="inputContact" required="required"  disabled value="<?=$agent['contact']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Email Address</label>
                            <div class="controls">
                                <input name="agent[email]" class="span4" type="text" id="inputEmail" required="required" disabled value="<?=$agent['email']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputAddress">Company Address</label>
                            <div class="controls">
                                <textarea name="agent[address]" class="span6" id="inputAddress" rows="3" disabled required="required"><?=$agent['address']; ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputCity">City</label>
                            <div class="controls">
                                <input name="agent[city]" class="span4" type="text" id="inputCity" disabled required="required" value="<?=$agent['city']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputProvince">State/Province/County</label>
                            <div class="controls">
                                <input name="agent[province]" class="span4" type="text" id="inputProvince" disabled value="<?=$agent['province']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputCountry">Country</label>
                            <div class="controls">
                                <input name="agent[country]" class="span4" type="text" id="inputCountry" required="required" disabled value="<?=$agent['country']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputZip">Zip Code</label>
                            <div class="controls">
                                <input name="agent[zip]" class="span4" type="text" id="inputZip" disabled value="<?=$agent['zip']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPhone">Phone Number</label>
                            <div class="controls">
                                <input name="agent[phone]" class="span4" type="text" id="inputPhone" required="required" disabled value="<?=$agent['phone']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPhone">Alternate Phone Number</label>
                            <div class="controls">
                                <input name="agent[alt_phone]" class="span4" type="text" id="inputAltPhone" disabled value="<?=$agent['alt_phone']; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputFax">Fax Number</label>
                            <div class="controls">
                                <input name="agent[fax]" class="span4" type="text" id="inputFax" disabled value="<?=$agent['fax']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-primary" disabled>Update Profile</button>
                            </div>
                        </div>
                    </form>
                </fieldset>
                <fieldset>
                    <legend>Change Password</legend>
                    <h4>Valid Password Rules</h4>
                    <ul>
                        <li>Password should be within 6 - 15 characters only.</li>
                        <li>Passwords are case sensitive.</li>
                        <li>Supports all numbers and alphabets (0 - 9 & A-Z).  Only @ * $ or # special chars allowed.</li>
                    </ul>
                    <form method="post"  id="frmChangePassword" name="agent_change_password" class="form-horizontal">
                        <input type="hidden" name="agent[id]" value="<?=$agent['id']; ?>">
                        <input type="hidden" name="formAction" value="password">
                        <div class="control-group">
                            <label class="control-label" for="inputOldPassword">Old Password</label>
                            <div class="controls">
                                <input name="agent[old_password]" class="span4" type="password" id="inputOldPassword" required="required" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword">New Password</label>
                            <div class="controls">
                                <input name="agent[password]" class="span4" type="password" id="inputPassword" required="required" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputConfirm">Confirm Password</label>
                            <div class="controls">
                                <input name="agent[confirm_password]" class="span4" type="password" id="inputConfirm" required="required" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End: Main Content -->
    <script>
        //form validaiton
    $(document).ready(function(){
        jQuery.validator.addMethod("password", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9@$*#]{6,15}$/);
        },"Enter a valid value only. Please check above");
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9._\s]+$/);
        },"Valid names please.");

        $("#frmChangePassword").validate({
            debug:true,
            rules:{
                "agent[old_password]":{
                    required: true,
                    password: true
                },
                "agent[password]":{
                    required: true,
                    password: true
                },
                "agent[confirm_password]":{
                    required: true,
                    password: true,
                    equalTo: "#inputPassword"
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

        $("#frmAgentProfile").validate({
            debug:true,
            rules:{
                "agent[company]":{
                    required: true,
                    alpha: true
                },
                "agent[contact]":{
                    required: true,
                    alpha: true
                },
                "agent[email]":{
                    required: true,
                    email: true
                },
                "agent[address]":{
                    required: true
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
                },
                "agent[alt_phone]":{
                    number: true,
                    minlength:10,
                    maxlength:15
                },
                "agent[fax]":{
                    number: true,
                    minlength:10,
                    maxlength:15
                },
                "agent[zip]":{
                    alpha: true,
                    minlength:5,
                    maxlength:10
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
                    number: "Enter a valid Phone/Mobile Number. No Special characters allowed"
                },
                "agent[alt_phone]":{
                    number: "Enter a valid Phone/Mobile Number. No Special characters allowed"
                },
                "agent[fax]":{
                    number: "Enter a valid Phone/Mobile Number. No Special characters allowed"
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