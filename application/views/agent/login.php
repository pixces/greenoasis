<!-- Start: Main Content --->
<div class="content bg-white login">
    <div class="container">
        <div class="heading"><h1>Agent: Login</h1></div>
        <div class="container-main pull-left box-shadow">
            <div class="content-left">
                <div class="form">
                    <?php if ($error){ ?>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    <?php echo $error; ?>
                </div>
                <?php } ?>
                    <form id="AgentRegistration" action="<?=SITE_URL.'/agent/login/'; ?>" class="form-horizontal agent-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="mm_action" id="mm_action" value="doLogin" />
                    <input type="hidden" name="form_action" value="doLogin" />
                        <div class="login-left">
                            <h1>Login</h1>
                            <p>Enter login credentials. All fields are mandatory.</p>
                            <p>
                                <label for="loginUsername">Username</label>
                                <input type="text" id="loginUsername" name="agent[username]" required>
                            </p>
                            <p>
                                <label for="loginPassword">Password</label>
                                <input type="password" id="loginPassword" name="agent[password]" required>
                            </p>
                            <label class="checkbox"><input type="checkbox" name="agent[required]" value="1"> Remember Me</label>
                            <button type="submit" class="btn">Sign in</button>
                        </div>
                    </form>
                    <div class="login-with">
                        <span>or</span>
                    </div>
                    <div class="login-right">
                        <div class="new-user">
                            <h1>Not yet registered?</h1>
                            <span><a href="<?=SITE_URL; ?>/agent/register" class="btn btn-success">Click here</a></span><br>
                            <span>to register as an agent.</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
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