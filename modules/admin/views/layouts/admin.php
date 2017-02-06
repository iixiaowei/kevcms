<?php
use yii\helpers\Html;
use app\components\sideBarWidget;
use yii\helpers\Url;

$session = \Yii::$app->session;
if (empty( $session['adminid'])) {
    return Url::to('/admin/public/login');
    exit;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?= Html::csrfMetaTags() ?>
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/static/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="/static/assets/css/font-awesome.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="/static/assets/css/ace-fonts.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="/static/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/static/assets/css/ace-part2.css" class="ace-main-stylesheet" />
    <![endif]-->

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/static/assets/css/ace-ie.css" />
    <link rel="stylesheet" href="/static/assets/css/admin.css" />
    <![endif]-->

    <!-- inline styles related to this page -->
    <script>var SITE_URL = '<?= Yii::$app->request->hostInfo . Yii::$app->request->baseUrl ?>';</script>
    <!-- ace settings handler -->
    <script src="/static/assets/js/ace-extra.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="/static/assets/js/html5shiv.js"></script>
    <script src="/static/assets/js/respond.js"></script>
    <![endif]-->

    <script src="/static/artDialog/lib/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="/static/artDialog/css/ui-dialog.css">
    <script src="/static/artDialog/dist/dialog-min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="/easyui/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="/easyui/demo/demo.css">
	<script type="text/javascript" src="/easyui/jquery.easyui.min.js"></script>

    <?php $this->head() ?>
</head>

<body class="no-skin">
<?php $this->beginBody() ?>
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default    navbar-collapse">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <!-- #section:basics/sidebar.mobile.toggle -->
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <!-- /section:basics/sidebar.mobile.toggle -->
        <div class="navbar-header pull-left">
            <!-- #section:basics/navbar.layout.brand -->
            <a href="#" class="navbar-brand">
                <small>
                    <i class="ace-icon fa fa-cogs"></i>
                   KevCmsV1.0
                </small>
            </a>

            <!-- /section:basics/navbar.layout.brand -->

            <!-- #section:basics/navbar.toggle -->
            <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons">
                <span class="sr-only">Toggle user menu</span>

                <img src="/static/assets/avatars/user.jpg" alt="Jason's Photo" />
            </button>

            <!-- /section:basics/navbar.toggle -->
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
            <ul class="nav ace-nav">
                <li class="transparent">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                    </a>

                    <div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#navbar-tasks">
                                        Tasks
                                        <span class="badge badge-danger">4</span>
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#navbar-messages">
                                        Messages
                                        <span class="badge badge-danger">5</span>
                                    </a>
                                </li>
                            </ul><!-- .nav-tabs -->

                            <div class="tab-content">
                                <div id="navbar-tasks" class="tab-pane in active">
                                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                                        <li class="dropdown-content">
                                            <ul class="dropdown-menu dropdown-navbar">
                                                <li>
                                                    <a href="#">
                                                        <div class="clearfix">
                                                            <span class="pull-left">Software Update</span>
                                                            <span class="pull-right">65%</span>
                                                        </div>

                                                        <div class="progress progress-mini">
                                                            <div style="width:65%" class="progress-bar"></div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <div class="clearfix">
                                                            <span class="pull-left">Hardware Upgrade</span>
                                                            <span class="pull-right">35%</span>
                                                        </div>

                                                        <div class="progress progress-mini">
                                                            <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <div class="clearfix">
                                                            <span class="pull-left">Unit Testing</span>
                                                            <span class="pull-right">15%</span>
                                                        </div>

                                                        <div class="progress progress-mini">
                                                            <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <div class="clearfix">
                                                            <span class="pull-left">Bug Fixes</span>
                                                            <span class="pull-right">90%</span>
                                                        </div>

                                                        <div class="progress progress-mini progress-striped active">
                                                            <div style="width:90%" class="progress-bar progress-bar-success"></div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="dropdown-footer">
                                            <a href="#">
                                                See tasks with details
                                                <i class="ace-icon fa fa-arrow-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- /.tab-pane -->

                                <div id="navbar-messages" class="tab-pane">
                                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                                        <li class="dropdown-content">
                                            <ul class="dropdown-menu dropdown-navbar">
                                                <li>
                                                    <a href="#">
                                                        <img src="/static/assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Alex:</span>
																		Ciao sociis natoque penatibus et auctor ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>a moment ago</span>
																	</span>
																</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <img src="/static/assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Susan:</span>
																		Vestibulum id ligula porta felis euismod ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>20 minutes ago</span>
																	</span>
																</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <img src="/static/assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Bob:</span>
																		Nullam quis risus eget urna mollis ornare ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>3:15 pm</span>
																	</span>
																</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <img src="/static/assets/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Kate:</span>
																		Ciao sociis natoque eget urna mollis ornare ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>1:33 pm</span>
																	</span>
																</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <img src="/static/assets/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Fred:</span>
																		Vestibulum id penatibus et auctor  ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>10:09 am</span>
																	</span>
																</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="dropdown-footer">
                                            <a href="inbox.html">
                                                See all messages
                                                <i class="ace-icon fa fa-arrow-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.tabbable -->
                    </div><!-- /.dropdown-menu -->
                </li>

                <!-- #section:basics/navbar.user_menu -->
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="/static/assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?= $this->params['adminname'] ?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <a href="profile.html">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?= Url::to('/admin/public/logout'); ?>">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- /section:basics/navbar.user_menu -->
            </ul>
        </div>

        <!-- /section:basics/navbar.dropdown -->
    </div><!-- /.navbar-container -->
</div>

<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <!-- #section:basics/sidebar -->
    <div id="sidebar" class="sidebar                  responsive">
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <!-- #section:basics/sidebar.layout.shortcuts -->
                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>

                <!-- /section:basics/sidebar.layout.shortcuts -->
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->
        <?= sideBarWidget::widget(['menu'=>$this->params['menu'],'active'=>$this->params['active'],'rightids'=>$this->params['rightids'],'rightarr'=>$this->params['rightarr']]); ?>
        <!-- #section:basics/sidebar.layout.minimize -->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

        <!-- /section:basics/sidebar.layout.minimize -->
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
    </div>

    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <div class="main-content-inner">
           <?= $content ?>
        </div>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <!-- #section:basics/footer -->
            <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">KevCms</span>
                             V1.0 &copy; 2016
						</span>

                &nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

							<a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

							<a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
						</span>
            </div>

            <!-- /section:basics/footer -->
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='/static/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>
<script src="/static/assets/js/bootstrap.js"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="/static/assets/js/ace/elements.scroller.js"></script>
<script src="/static/assets/js/ace/elements.colorpicker.js"></script>
<script src="/static/assets/js/ace/elements.fileinput.js"></script>
<script src="/static/assets/js/ace/elements.typeahead.js"></script>
<script src="/static/assets/js/ace/elements.wysiwyg.js"></script>
<script src="/static/assets/js/ace/elements.spinner.js"></script>
<script src="/static/assets/js/ace/elements.treeview.js"></script>
<script src="/static/assets/js/ace/elements.wizard.js"></script>
<script src="/static/assets/js/ace/elements.aside.js"></script>
<script src="/static/assets/js/ace/ace.js"></script>
<script src="/static/assets/js/ace/ace.ajax-content.js"></script>
<script src="/static/assets/js/ace/ace.touch-drag.js"></script>
<script src="/static/assets/js/ace/ace.sidebar.js"></script>
<script src="/static/assets/js/ace/ace.sidebar-scroll-1.js"></script>
<script src="/static/assets/js/ace/ace.submenu-hover.js"></script>
<script src="/static/assets/js/ace/ace.widget-box.js"></script>
<script src="/static/assets/js/ace/ace.settings.js"></script>
<script src="/static/assets/js/ace/ace.settings-rtl.js"></script>
<script src="/static/assets/js/ace/ace.settings-skin.js"></script>
<script src="/static/assets/js/ace/ace.widget-on-reload.js"></script>
<script src="/static/assets/js/ace/ace.searchbox-autocomplete.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $('#sidebar2').insertBefore('.page-content');

        $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');


        $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
            if(event_name == 'sidebar_fixed') {
                if( $('#sidebar').hasClass('sidebar-fixed') ) {
                    $('#sidebar2').addClass('sidebar-fixed');
                    $('#navbar').addClass('h-navbar');
                }
                else {
                    $('#sidebar2').removeClass('sidebar-fixed')
                    $('#navbar').removeClass('h-navbar');
                }
            }
        }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
    })
</script>

<!-- the following scripts are used in demo only for onpage help and you don't need them -->
<link rel="stylesheet" href="/static/assets/css/ace.onpage-help.css" />
<link rel="stylesheet" href="/static/docs/assets/js/themes/sunburst.css" />

<script type="text/javascript"> ace.vars['base'] = '/'; </script>
<script src="/static/assets/js/ace/elements.onpage-help.js"></script>
<script src="/static/assets/js/ace/ace.onpage-help.js"></script>
<script src="/static/docs/assets/js/rainbow.js"></script>
<script src="/static/docs/assets/js/language/generic.js"></script>
<script src="/static/docs/assets/js/language/html.js"></script>
<script src="/static/docs/assets/js/language/css.js"></script>
<script src="/static/docs/assets/js/language/javascript.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
