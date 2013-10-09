<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>iAdmin Panel</title>
    <base href="<?=SITE_URL; ?>">
    <link rel="shortcut icon" href="<?=SITE_IMAGE; ?>favicon.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans|Roboto|Source+Sans+Pro:900italic,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>admin.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>datepicker.css">
    <script src="<?=SITE_JS; ?>jquery.1.10.2.min.js" type="text/javascript" ></script>
    <script src="<?=SITE_JS; ?>common.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>admin.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>bootstrap.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>html5shiv.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>pngfix.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>bootstrap-datepicker.js" type="text/javascript"></script>
    <!--script src="<?=SITE_JS; ?>ckeditor_standard/ckeditor.js"></script -->
</head>
<body data-name="<?=$pageType; ?>">
    <!-- Start Header //-->
    <div class="masthead-outer">
        <div class="masthead-inner">
            <div class="nav-area pull-left">
                <div class="logo">
                    <h3 class="muted">GreenOasis: Admin</h3>
                </div>
                <?php if ($pageType != 'login') { ?>
                <div class="top-nav">
                    <ul class="nav nav-pills">
                        <?php foreach ($navigation as $k=>$v) { ?>
                            <li class="<?=$k; ?> <?php echo $t = ( $pageType == $k ) ? 'active' : ''; ?>"><a
                                    class="<?=strtolower($v['name']); ?>" href="<?=$v['url']; ?>"><i></i><?=$v['name']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
            <div class="top-settings pull-right">
                <div class="btn-group">
                    <button class="btn btn-success"><i class="icon-user"></i>&nbsp; Welcome Admin</button>
                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href=""><i class="icon-edit"></i> Update Profile</a></li>
                        <li><a href=""><i class="icon-refresh"></i> Change Password</a></li>
                        <li><a href="<?=SITE_URL; ?>/admin/logout"><i class="icon-off"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- End Header -->
    <!-- Start Main //-->
    <div class="page-body-inner">
        <div>
            <div class="page-header">
                <h1><?=ucwords(strtolower($pageTitle)); ?> <small><?php if($addUrl){ ?>
                            <a class="addlink" href="<?=$addUrl; ?>"><i class="icon-plus-sign icon-white"></i> Add New</a>
                        <?php } ?></small></h1>
            </div>
            <div class="crumbs">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a> <span class="divider">/</span></li>
                    <li><a href="#">Library</a> <span class="divider">/</span></li>
                    <li class="active">Data</li>
                </ul>
            </div>
        </div>
        <!-- display notification on all pages -->
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span class="message">Default message goes here....</span>
        </div>
        <!-- Notification ends -->
        <!-- main content area start -->
        <div>
