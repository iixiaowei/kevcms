<meta http-equiv='Refresh' content='<?php echo $waitSecond; ?>;URL=<?php echo $jumpUrl; ?>'>
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
<!-- /section:settings.box -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse" >
            <ul class="nav nav-list">
                <?= \app\components\NavMenuWidget::widget(['rightarr' => $this->params['rightarr']]) ?>
            </ul>
            <!-- /.nav-list -->
        </div>

        <div class="page-header">
            <h1 style="margin: 10px 0 0 20px;">
                系统提示
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>

                </small>
            </h1>
        </div>

        <div class="alert alert-danger alert-block" style="margin: 15px;">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <p class="text-align-left">
            <h2><i class="fa-fw fa fa-times font-md"></i>提示</h2>
            <p style="line-height: 25px;margin-left:30px;"><span style="font-size:15px;"><?php echo $message; ?></span><br />页面将在 <span class="wait"><?php echo $waitSecond; ?></span> 秒后自动跳转，如果不想等待请点击 <a href="<?php echo $jumpUrl; ?>">这里</a> 跳转。</p><br />
            </p>
        </div>


    </div>

</div> 

