<?php
use yii\helpers\Url;

?>
<div class="page-content">
    <!-- #section:settings.box -->
    <div class="ace-settings-container" id="ace-settings-container" style="display: none;">
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
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar"/>
                    <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                </div>

                <!-- /section:settings.navbar -->

                <!-- #section:settings.sidebar -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar"/>
                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                </div>

                <!-- /section:settings.sidebar -->

                <!-- #section:settings.breadcrumbs -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs"/>
                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                </div>

                <!-- /section:settings.breadcrumbs -->

                <!-- #section:settings.rtl -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl"/>
                    <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                </div>

                <!-- /section:settings.rtl -->

                <!-- #section:settings.container -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container"/>
                    <label class="lbl" for="ace-settings-add-container">
                        Inside
                        <b>.container</b>
                    </label>
                </div>

                <!-- /section:settings.container -->
            </div>
            <!-- /.pull-left -->

            <div class="pull-left width-50">
                <!-- #section:basics/sidebar.options -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover"/>
                    <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                </div>

                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact"/>
                    <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                </div>

                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight"/>
                    <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                </div>

                <!-- /section:basics/sidebar.options -->
            </div>
            <!-- /.pull-left -->
        </div>
        <!-- /.ace-settings-box -->
    </div>
    <!-- /.ace-settings-container -->

    <div class="page-header">
        <h1>
            系统设置
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                菜单管理
            </small>
        </h1>
        <div class="widget-toolbar no-border">
            <div class="btn-group">
                <a href="<?= Url::toRoute(['/admin/menu/list']) ?>"
                   class="btn btn-sm bg-color-red txt-color-white"
                   style="padding-left: 15px;"><i
                        class="glyphicon glyphicon-list"> </i> 菜单列表</a>
            </div>

            <div class="btn-group">
                <a
                    href="<?= Url::toRoute(['/admin/menu/add', 'parentid' => 0]) ?>"
                    class="btn btn-sm btn-success"> <i class="fa fa-plus"></i>
                    添加菜单
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="hidden">
                <button data-target="#sidebar2" data-toggle="collapse" type="button"
                        class="pull-left navbar-toggle collapsed">
                    <span class="sr-only">Toggle sidebar</span>
                    <i class="ace-icon fa fa-dashboard white bigger-125"></i>
                </button>

                <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
                    <ul class="nav nav-list">
                        <?= \app\components\NavMenuWidget::widget(['rightarr' => $this->params['rightarr']]) ?>
                    </ul>
                    <!-- /.nav-list -->
                </div>
                <!-- .sidebar -->
            </div>

            <form class="form-horizontal" role="form" id="form1" name="form1" action="/admin/menu/doadd" method="post">
                <!-- #section:elements.form -->
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">上级菜单</label>

                    <div class="col-sm-9">
                        <select
                            id="parentid" name="parentid">
                            <option value="0">作为一级菜单</option>
                            <?php echo $select_categorys; ?>
                        </select><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 菜单名称 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="菜单名称" id="name" name="name" class="col-xs-10 col-sm-5"><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 英文名称 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="英文名称" id="alias_name" name="alias_name"
                               class="col-xs-10 col-sm-5"><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 控制器名称 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="控制器名称" id="action" name="action"
                               class="col-xs-10 col-sm-5"><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 操作名称 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="操作名称" id="method" name="method"
                               class="col-xs-10 col-sm-5"><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 图标名称 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="图标名称" id="icon" name="icon" class="col-xs-10 col-sm-5"><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 排序 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="排序" id="listorder" name="listorder"
                               class="col-xs-10 col-sm-5"><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 一级菜单别名 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="一级菜单别名" id="focus" name="focus"
                               class="col-xs-2 col-sm-2"><i></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 选中菜单别名 </label>

                    <div class="col-sm-9">
                        <input type="text" placeholder="菜单选中别名" id="active" name="active"
                               class="col-xs-2 col-sm-2"><i></i>
                    </div>
                </div>

                <div class="space-4"></div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" id="btnSubmit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            提交
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            重置
                        </button>
                    </div>
                </div>
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken() ?>" />
            </form>


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.page-content -->
<script src="/static/assets/js/jquery.js"></script>
<script src="/static/assets/js/jquery.form.js"></script>
<script src="/static/assets/js/jquery.validate.js"></script>
<script>
    $(function () {

        validator = $("#form1").validate({
            rules: {
                parentid: "required",
                name: {
                    required: true
                },
                alias_name: "required",
                action: "required",
                method: "required",
                icon: "required",
                listorder: "required",
                focus: "required",
                active: "required"

            },
            messages: {
                parentid: "请选择上级菜单!",
                name: {
                    required: "菜单名称不能为空！"
                },
                alias_name: "英文名称不能为空！",
                action: "控制器名称不能为空！",
                method: "操作名称不能为空！",
                icon: "图标名称不能为空！",
                listorder: "排序不能为空！",
                focus: "一级菜单别名不能为空！",
                active: "选中菜单别名！"

            },
            errorPlacement: function (error, element) {
                if (error.html() != "") {

                    $('#' + element.attr("id")).parent().addClass("state-error");
                    $('#' + element.attr("id")).siblings("i").addClass("note").css({
                        "color": 'red',
                        'font-style': 'normal',
                        'margin-top': '8px',
                        'line-height': '35px',
                        'margin-left': '5px'
                    }).html(error.html());


                } else {
                    $('#' + element.attr("id")).parent().removeClass("state-error");
                    $('#' + element.attr("id")).siblings("i").removeClass("note").css({
                        "color": 'red',
                        'font-style': 'normal',
                        'margin-top': '8px',
                        'line-height': '35px',
                        'margin-left': '5px'
                    }).html("");
                }
            },
            success: function (label) {

            }
        });

        $("#btnSubmit").click(function () {
            fValidator.save();
        });

        var fValidator = {
            save: function () {
                if (validator.form()) {

                    var form = $('#form1');
                    var ajax = {
                        url:SITE_URL+"<?= Url::toRoute('menu/doadd') ?>", data: form.serialize(), type: 'POST', dataType: 'json', cache: false,
                        success: function (data, statusText) {
                            if (data.status == 1) {
                                window.location.href = SITE_URL+"/admin/menu/list";
                            }else {
                                var errMsg = "";
                                $.each(data.msg,function(name,value) {
                                   // alert(name+"--"+value);
                                    errMsg += name+"--"+value+"<br>";
                                });
                                var d = dialog({
                                    content: errMsg
                                });
                                d.showModal();
                                setTimeout(function () {
                                    d.close().remove();
                                }, 2000);
                            }

                        },
                        error: function (httpRequest, statusText, errorThrown) {
                            var d = dialog({
                                content: '数据请求时发生错误，请检查' + errorThrown
                            });
                            d.showModal();
                            setTimeout(function () {
                                d.close().remove();
                            }, 2000);
                        }
                    };
                    $.ajax(ajax);
                    return false;
                }
            }
        };

    });
</script>