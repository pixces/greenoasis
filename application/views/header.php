<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GREEN OASIS TOURISM L.L.C</title>
        <base href="<?=SITE_URL; ?>">
        <link rel="shortcut icon" href="<?=SITE_IMAGE; ?>favicon.ico" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Ropa+Sans|Roboto|Source+Sans+Pro:900italic,400,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>bootstrap.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>style.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>datepicker.css">
        <!-- all js scripts -->
        <script src="<?=SITE_JS; ?>jquery.1.10.2.min.js" type="text/javascript" ></script>
        <script src="<?=SITE_JS; ?>common.js" type="text/javascript"></script>
        <script src="<?=SITE_JS; ?>site.js" type="text/javascript"></script>
        <script src="<?=SITE_JS; ?>bootstrap.js" type="text/javascript"></script>
        <script src="<?=SITE_JS; ?>html5shiv.js" type="text/javascript"></script>
        <script src="<?=SITE_JS; ?>pngfix.js" type="text/javascript"></script>
        <script src="<?=SITE_JS; ?>bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?=SITE_JS; ?>ravs.JSQL.js" type="text/javascript"></script>
        <script src="<?=SITE_JS; ?>json2.js" type="text/javascript"></script>
    </head>
    <body class="" data-type="<?=$pageType; ?>">
        <!-- outer container -->
        <div class="container">
            <!-- Start: header -->
            <div class="header">
                <div class="header_col01"><img src="<?=SITE_URL; ?>/images/logo.png" width="496" height="135"/></div>
                <div class="header_col02">
                    <div class="header_col02_raw">
                        <?php  if (!isset($_SESSION['isAgentLoggedIn'])) { ?>
                        <div class="header_col02_raw1"><img src="<?=SITE_URL; ?>/images/icon01.png" width="20" height="20"/>
                            <a href="<?=SITE_URL; ?>/agent/login"><h1>Agent Login</h1></a>
                        </div>
                        <?php } else{ ?>
                            <div class="btn-group pull-right divAgentAccess">
                                <button class="btn btn-inverse"><?php echo $_SESSION['agent']['contact'];?></button>
                                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
                                    <span><i class="icon-cog"></i></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo SITE_URL;?>/agent/"><i class="icon-home"></i> My Dashboard</a></li>
                                    <li><a href="<?php echo SITE_URL;?>/agent/transactions"><i class=" icon-retweet"></i> My Transactions</a></li>
                                    <li><a href="<?php echo SITE_URL;?>/agent/update_profile"><i class="icon-user"></i> My Profile</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo SITE_URL;?>/pages/logout"><i class="icon-off"></i> Logout</a></li>
                                </ul>
                            </div>

                            
                        <?php }?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="header_col02_raw2">
                        <ul>
                            <li><a href="<?=SITE_URL; ?>/contact/" class="<?=($pageType=='contact') ? 'on' : ''; ?>">Contact</a></li>
                            <li><a href="<?=SITE_URL; ?>/packages/" class="<?=($pageType=='tour') ? 'on' : ''; ?>">Packages</a></li>
                            <li><a href="<?=SITE_URL; ?>/visa/" class="<?=($pageType=='visa') ? 'on' : ''; ?>">Visa</a></li>
                            <li><a href="<?=SITE_URL; ?>/hotel/" class="<?=($pageType=='hotel') ? 'on' : ''; ?>">Hotels</a></li>
                            <li><a href="<?=SITE_URL; ?>/about-us/" class="<?=($pageType=='about-us') ? 'on' : ''; ?>">About Us</a></li>
                            <li><a href="<?=SITE_URL; ?>" class="<?=($pageType=='home') ? 'on' : ''; ?>">Home</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- End: Header -->
        </div>

