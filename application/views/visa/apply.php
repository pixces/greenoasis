<!-- Start: Main Content --->
<div class="content bg-white">
    <div class="container">
        <div class="heading"><h1>Visa: Application</h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="content-left">
                <h1><?=$data['title']; ?></h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <form id="visaApplication" class="form-horizontal visa-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="visa[type]" value="<?=$data['type']; ?>">
                    <input type="hidden" name="visa[validity]" value="<?=$data['validity']; ?>">
                    <input type="hidden" name="visa[visa_id]" value="<?=$data['id']; ?>">

                    <div id="visaBasic" class="visa-basic">
                        <legend>Basic Details</legend>
                        <!--
                        <div class="control-group">
                            <label class="control-label">Visa Packages</label>
                            <div class="controls">
                                <select name="visa[package]" id="visa_package" class="span4">
                                    <option value="0">--- Select a Visa Package ---</option>
                                    <option value="tourist30">Tourist Visa - 30 Days</option>
                                    <option value="service14">Service Visa - 14 Days</option>
                                    <option value="visit30">Visit Visa - 30 Days</option>
                                </select>
                            </div>
                        </div>
                        -->
                        <div class="control-group">
                            <label class="control-label">No. of Persons Applying</label>
                            <div class="controls">
                                <select name="visa[count]" id="visa_count" class="span2">
                                    <option value="0">-- Select --</option>
                                    <option value="1">1 Member</option>
                                    <option value="2">2 Members</option>
                                    <option value="3">3 Members</option>
                                    <option value="4">4 Members</option>
                                    <option value="5">5 Members</option>

                                </select>
                                <span class="help-block">Enter total count of applicants. Cannot exceed 5 members.</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="dpArrival">Expected Arrival Date</label>
                            <div class="controls">
                                <div id="dpArrival" class="input-append date" data-date-format="dd-mm-yyyy" data-date="<?=date("d-m-Y"); ?>">
                                    <input name="visa[arrival]" class="span2" type="text" readonly value="" placeholder="arrival date" required>
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Phone Number</label>
                            <div class="controls"><input name="visa[phone]"  id="visa_phone" type="text" class="span4" required></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">E-mail Address</label>
                            <div class="controls">
                                <input name="visa[email]" type="text"  id="visa_email" class="span4" required>
                            </div>
                        </div>
                    </div>
                    <div class="visa-pax-list" style="display:none;">
                        <legend>Applicants Details</legend>
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

<!-- applicants details template-->
<div id="visaAppl_0" class="appl-item0" style="display: none;">
    <div class="control-group inline">
        <label class="control-label">Full Name</label>
        <div class="controls">
            <input name="pax[0][fname]" id="pax_fname_0" type="text" class="span2" placeholder="First Name" required>
            <input name="pax[0][mname]" id="pax_mname_0" type="text" class="span1" placeholder="Middle Name">
            <input name="pax[0][lname]" id="pax_lname_0" type="text" class="span2" placeholder="Last Name" required>
            <span class="help-block">Enter full name of the Applicant.</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Date of Birth</label>
        <div class="controls">
            <input name="pax[0][dob]" id="pax_dob_0" class="span2" type="text" value="" placeholder="Date of Birth" required>&nbsp;&nbsp;
            <label class="radio inline"><input type="radio" name="pax[0][gender]" id="pax_gender_0" value="male" checked="checked"> Male</label>
            <label class="radio inline"><input type="radio" name="pax[0][gender]" id="pax_gender_0" value="female"> Female</label>
            <span class="help-block">Enter date of birth for age calculation. Eg.: 09-12-1977 (for 9 December 1977).</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Nationality</label>
        <div class="controls">
            <input class="span4" name="pax[0][nationality]" id="pax_nationality_0" type="text">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Passport Number</label>
        <div class="controls"><input class="span4" name="pax[0][passport]" id="pax_passport_0" type="text" placeholder="Passport Number"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Passport Issue & Expiry</label>
        <div class="controls">
            <input name="pax[0][issue]" id="pax_issue_0" class="span2" type="text" placeholder="Issued Date" required>
            <input name="pax[0][expiry]" id="pax_expiry_0" class="span2" type="text" placeholder="Expiry Date" required>
            <span class="help-block">Enter Passport Issue & Expiry date. Eg.: 09-12-1977 (for 9 December 1977).</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Upload Documents</label>
        <div class="controls">
            <input type="file" id="image_0" name="image[0][0]">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input type="file" id="image_1" name="image[0][1]">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input type="file" id="image_2" name="image[0][2]">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input type="file" id="image_3" name="image[0][3]">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input type="file" id="image_4" name="image[0][4]">
        </div>
    </div>
</div>
<!-- end applicants details -->