<!-- Basic Styles -->
<div class="page-header">
    <h1>
        系统设置
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            后台日志
        </small>
    </h1>
</div>

<div class="widget-toolbar no-border">
    <div class="btn-group">
        <a href="javascript:void(0)"
           class="btn btn-sm bg-color-red txt-color-white"
           style="padding-left: 15px;"><i
                class="glyphicon glyphicon-list"> </i> 后台日志列表</a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <!--<h3 class="header smaller lighter blue">jQuery dataTables</h3>-->
        <div class="table-header">
            数据列表
        </div>

        <!-- <div class="table-responsive"> -->

        <!-- <div class="dataTables_borderWrap"> -->
        <div>
            <table id="dt_basic"
                   class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="30px">ID编号</th>
                    <th width="50px">模型名称</th>
                    <th width="50px">控制器名称</th>
                    <th width="50px">操作名称</th>
                    <th width="260px" style="width:260px;word-break:break-all;word-wrap:break-word;overflow:hidden;white-space：normal;">内容</th>
                    <th width="50px">操作员</th>
                    <th width="180px">操作日期</th>
                    <th width="150px">操作IP</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
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
//            "bFilter":false,
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
                {"mData": 'content'},
                {"mData": 'admin_id'},
                {"mData": 'rtime'},
                {"mData": 'ip'}
            ]

        });

        $(document).on('click', 'th input:checkbox' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            //var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }

    });
</script>