<?php
use yii\helpers\Url;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            系统设置
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
               操作日志
            </small>
        </h1>
        <div class="widget-toolbar no-border">
            <div class="btn-group">
                <a href="javascript:void(0)"
                   class="btn btn-sm bg-color-red txt-color-white"
                   style="padding-left: 15px;"><i
                        class="glyphicon glyphicon-list"> </i> 日志列表</a>
            </div>
        </div>
    </div>

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
                        <?= \app\components\NavMenuWidget::widget(['rightarr'=>$this->params['rightarr']]) ?>
                    </ul><!-- /.nav-list -->
                </div><!-- .sidebar -->
            </div>


            <table id="dt_basic"
                   class="table table-striped table-bordered table-hover" style="table-layout:fixed;">
                <thead>
                <tr>
                    <th width="40px">ID</th>
                    <th width="60px">模型名称</th>
                    <th width="80px">控制器名称</th>
                    <th width="60px">操作名称</th>
                    <th width="260px" style="table-layout:fixed; width:260px;word-wrap: break-word;">内容</th>
                    <th width="50px">操作员</th>
                    <th width="180px">操作日期</th>
                    <th width="150px">操作IP</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>


        </div><!-- /.col -->
    </div><!-- /.row -->



</div>


<style>
    .dataTables_wrapper input[type="text"], .dataTables_wrapper input[type="search"], .dataTables_wrapper select {
        margin-bottom: 0 !important;
        margin-left: 0 !important;
        margin-right: 4px;
        margin-top: 0
    }
    .form-inline .input-group > .form-control {
        width: auto !important;
    }
    .dataTables_length{width:150px;float: left;}
    .dataTables_filter{width:300px;float: right;}
</style>
<script src="/static/plugin/datatables/jquery.dataTables-cust.min.js"></script>
<script src="/static/plugin/datatables/ColReorder.min.js"></script>
<script src="/static/plugin/datatables/FixedColumns.min.js"></script>
<script src="/static/plugin/datatables/ColVis.min.js"></script>
<script src="/static/plugin/datatables/ZeroClipboard.js"></script>
<script src="/static/plugin/datatables/media/js/TableTools.min.js"></script>
<script src="/static/plugin/datatables/DT_bootstrap.js"></script>
<script>
    jQuery(function($) {

        $('#dt_basic').dataTable({
            "sPaginationType" : "bootstrap_full",
            "iDisplayLength": 25 ,
            "bFilter":true,
            "bInfo": true,
            "oLanguage": {
                "sUrl": "/static/datatable_zh.txt"
            },
            "aaSorting": [[ 0, "desc" ]],
            "bProcessing": true,
            "bServerSide": true,
            "bAutoWidth": true,
            "sAjaxSource": SITE_URL+"/admin/log/log_list",
            "fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {

                oSettings.jqXHR = $.ajax( {
                    "url":  sUrl,
                    "data": aoData,
                    "success": function (json) {
                        if ( json.sError ) {
                            oSettings.oApi._fnLog( oSettings, 0, json.sError );
                        }

                        $(oSettings.oInstance).trigger('xhr', [oSettings, json]);
                        fnCallback( json );
                    },
                    "dataType": "json",
                    "cache": false,
                    "type": oSettings.sServerMethod,
                    "error": function (xhr, error, thrown) {
                        if ( error == "parsererror" ) {
                            oSettings.oApi._fnLog( oSettings, 0, "DataTables warning: JSON data from "+
                            "server could not be parsed. This is caused by a JSON formatting error." );
                        }
                    }
                } );
            },
            "aoColumns": [ //这个属性下的设置会应用到所有列，按顺序没有是空
                {"mData": 'id'}, //mData 表示发请求时候本列的列明，返回的数据中相同下标名字的数据会填充到这一列
                {"mData": 'module'},
                {"mData": 'controller'},
                {"mData": 'action'},
                {"mData": 'content','sClass':'auto_wrap'},
                {"mData": 'admin_id'},
                {"mData": 'rtime'},
                {"mData": 'ip'}
            ]

        });
    });
</script>