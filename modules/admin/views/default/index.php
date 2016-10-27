<div class="page-content">
    <!-- #section:settings.box -->
    <div class="ace-settings-container" id="ace-settings-container">
        <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
            <i class="ace-icon fa fa-cog bigger-130"></i>
        </div>

        <div class="ace-settings-box clearfix" id="ace-settings-box">
            <div class="pull-left width-50">
                <!-- #section:settings.skins -->
                <div class="ace-settings-item">
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                            <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                            <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                            <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                        </select>
                    </div>
                    <span>&nbsp; Choose Skin</span>
                </div>

                <!-- /section:settings.skins -->

                <!-- #section:settings.navbar -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                    <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                </div>

                <!-- /section:settings.navbar -->

                <!-- #section:settings.sidebar -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                </div>

                <!-- /section:settings.sidebar -->

                <!-- #section:settings.breadcrumbs -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                </div>

                <!-- /section:settings.breadcrumbs -->

                <!-- #section:settings.rtl -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                    <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                </div>

                <!-- /section:settings.rtl -->

                <!-- #section:settings.container -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                    <label class="lbl" for="ace-settings-add-container">
                        Inside
                        <b>.container</b>
                    </label>
                </div>

                <!-- /section:settings.container -->
            </div><!-- /.pull-left -->

            <div class="pull-left width-50">
                <!-- #section:basics/sidebar.options -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                    <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                </div>

                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                    <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                </div>

                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                    <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                </div>

                <!-- /section:basics/sidebar.options -->
            </div><!-- /.pull-left -->
        </div><!-- /.ace-settings-box -->
    </div><!-- /.ace-settings-container -->

    <!-- /section:settings.box -->
    <div class="page-header">
        <h1>Two menu </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="hidden">
                <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
                    <span class="sr-only">Toggle sidebar</span>

                    <i class="ace-icon fa fa-dashboard white bigger-125"></i>
                </button>

                <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
                    <ul class="nav nav-list">
                        <li class="hover">
                            <a href="#">
                                <i class="menu-icon fa fa-tachometer"></i>
                                <span class="menu-text"> Dashboard </span>
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="hover">
                            <a href="#">
                                <i class="menu-icon fa fa-list-alt"></i>
                                <span class="menu-text">Widgets</span>
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="hover">
                            <a href="#">
                                <i class="menu-icon fa fa-calendar"></i>

													<span class="menu-text">
														Calendar
														<span title="" class="badge badge-transparent tooltip-error" data-original-title="2 Important Events">
															<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
														</span>
													</span>
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="hover">
                            <a href="#">
                                <i class="menu-icon fa fa-picture-o"></i>
                                <span class="menu-text"> Gallery </span>
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-tag"></i>
                                <span class="menu-text"> More Pages </span>

                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>

                            <ul class="submenu">
                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        User Profile
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Inbox
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Pricing Tables
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Invoice
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Timeline
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Email Templates
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Login &amp; Register
                                    </a>

                                    <b class="arrow"></b>
                                </li>
                            </ul>
                        </li>

                        <li class="hover">
                            <a class="dropdown-toggle" href="#">
                                <i class="menu-icon fa fa-file-o"></i>

													<span class="menu-text">
														Other Pages
														<span class="badge badge-primary">5</span>
													</span>

                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>

                            <ul class="submenu">
                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        FAQ
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Error 404
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Error 500
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Grid
                                    </a>

                                    <b class="arrow"></b>
                                </li>

                                <li class="hover">
                                    <a href="#">
                                        <i class="menu-icon fa fa-caret-right"></i>
                                        Blank Page
                                    </a>

                                    <b class="arrow"></b>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- /.nav-list -->
                </div><!-- .sidebar -->
            </div>

            <div class="hidden-sm hidden-xs">
                <button type="button" class="sidebar-collapse btn btn-white btn-primary" data-target="#sidebar2">
                    <i class="ace-icon fa fa-angle-double-up" data-icon1="ace-icon fa fa-angle-double-up" data-icon2="ace-icon fa fa-angle-double-down"></i>
                    Collapse/Expand Menu
                </button>
            </div>

            <div class="hidden-md hidden-lg">
                <div class="well well-sm">
                    You can place multiple toggle buttons for multiple menus anywhere inside navbar!
                </div>
            </div><!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->