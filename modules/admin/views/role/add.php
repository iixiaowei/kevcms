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
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title></title>
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
    <style>
        .error{
            border: 1px solid red!important;
        }
    </style>
</head>

<body class="no-skin" style="background: none;">
<div class="row" style="border-bottom: 1px solid #d5d5d5;">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal" role="form" id="form1" action="/admin/operator/doadd" method="post">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">角色名称</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="角色名称" name="name" id="name"  class="col-xs-10 col-sm-5"><i></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 描述 </label>

                        <div class="col-sm-9">
                            <textarea id="description" name="description" rows="3" cols="45"></textarea><i></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> 排序 </label>

                        <div class="col-sm-9">
                            <input type="text" placeholder="排序" id="listorder" name="listorder" value="0" class="col-xs-10 col-sm-1"><i></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right">状态</label>
                        <div class="col-sm-9">
                            <label>
                                <input name="is_valid" value=1 type="radio" class="ace" checked="checked" />
                                <span class="lbl"> 有效</span>
                            </label>
                             <label>
                                <input name="is_valid" value=0  type="radio" class="ace" />
                                <span class="lbl"> 无效</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-4"></div>
                </form>

            </div><!-- /.span -->
        </div><!-- /.row -->


    </div><!-- /.col -->
</div><!-- /.row -->
</body>
</html>

<script src='/static/assets/js/jquery.js'>
<script src="/static/assets/js/jquery.form.js"></script>
<script src="/static/assets/js/jquery.validate.js"></script>
<script>
function submitForm(){
      
    jQuery(function(){
       var validator = $("#form1").validate({
            rules: {
                name:{
                    required:true
                },
                description:"required",
                listorder:"required"
            },
            messages: {
                name:{
                    required:"*"
                },
                description:"*",
                listorder:"*"

            },
            errorPlacement: function(error, element) {
                if (error.html() != "") {

                    $('#' + element.attr("id")).parent().addClass("state-error");
                    $('#' + element.attr("id")).siblings("i").addClass("note").css({"color":'red'}).html( error.html() );


                } else {
                    $('#' + element.attr("id")).parent().removeClass("state-error");
                    $('#' + element.attr("id")).siblings("i").removeClass("note").css({"color":'red'}).html("");
                }
            },
            success: function(label) {

            }
        });

        var fValidator = {
            save:function(){
                
                if( validator.form() ){
                    var form = $('#form1');
                    var ajax = {
                        url:SITE_URL+"/admin/role/do-add", data: form.serialize(), type: 'POST', dataType: 'json', cache: false,
                        success: function(data, statusText) {

                            if (data.status == 1) {
                                window.parent.reLoadPage(); 
                            }
                            else{
                                alert(data.msg);
                            }

                        },
                        error: function(httpRequest, statusText, errorThrown) {
                            alert( '数据请求时发生错误，请检查' + errorThrown  );
                        }
                    };
                    $.ajax(ajax);
                    return false;
                }
            }
        };
        
        fValidator.save();

    });
}
</script>
