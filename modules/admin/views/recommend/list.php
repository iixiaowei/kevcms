<?php
use yii\helpers\Url;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            内容管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
               推荐位管理
            </small>
        </h1>
        <div class="widget-toolbar no-border">
            <div class="btn-group">
                <a href="javascript:void(0)"
                   class="btn btn-sm bg-color-red txt-color-white"
                   style="padding-left: 15px;"><i
                        class="glyphicon glyphicon-list"> </i> 推荐位列表</a>
            </div>
            <div class="btn-group">
                <a
                    href="javascript:void(0);"
                    class="btn btn-sm btn-success" id="btnAdd"> <i class="fa fa-plus"></i>
                    添加推荐位
                </a>
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
                    <th width="80px">ID编号</th>
                    <th width="100px">推荐位名称</th>
                    <th width="120px">所属栏目</th>
                    <th width="160px" style="table-layout:fixed; width:160px;word-wrap: break-word;">排序</th>
                    <th width="160px" style="table-layout:fixed; width:160px;word-wrap: break-word;">是否有效</th>
                    <th width="120px">添加日期</th>
                    <th width="220px">管理操作</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>


        </div><!-- /.col -->
    </div><!-- /.row -->



</div>

<div id="dlg" class="easyui-dialog" title="添加推荐位" style="width:560px;height:460px;padding:10px 20px;display:none;"
     closed="true" buttons="#dlg-buttons" data-options="iconCls:'icon-save',resizable:false,modal:true">

    <form id="ff" class="easyui-form" method="post">
        <div style="margin-top: 15px;">
            <label for="name" style="width: 20%;">名称:</label>
            <input class="easyui-validatebox textbox" type="text" id="name" name="name" data-options="required:true,missingMessage:'请输入名称',invalidMessage:'请输入名称'" style="width:60%" />
        </div>
        <div style="margin-top: 15px;">
            <label for="role_id" style="width: 20%;">栏目:</label>
            <select class="easyui-validatebox" id="category_id" name=""category_id"" style="width:60%">
                <?php foreach ($categorys as $rs): ?>
                    <option value="<?= $rs['id'] ?>"><?= $rs['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-top: 15px;">
            <label for="is_valid" style="width: 20%;">是否有效:</label>
            <input type="radio" name="is_valid" value="1" checked> 有效
            <input type="radio" name="is_valid" value="0"> 无效
        </div>
        
        <div style="margin-top: 15px;">
            <label for="name" style="width: 20%;">排序:</label>
            <input class="easyui-validatebox textbox" value="0" type="text" id="sort_by" name="sort_by" data-options="required:true,missingMessage:'请输入排序',invalidMessage:'请输入排序'" style="width:60%" />
        </div>
        
        <div style="margin-top: 15px;">
            <label for="name" style="width: 20%;">缩略图:</label>
            <input type="hidden" name="smeta[thumb]" id="thumb" value="">
			<a href="javascript:upload_one_image('图片上传','#thumb');">
				 <img src="/images/default-thumbnail.png" id="thumb-preview" width="135" style="cursor: hand" />
		    </a>
			<input type="button" class="btn btn-small" onclick="$('#thumb-preview').attr('src','/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
        </div>
        <input type="hidden" name="id" />
    </form>
<div id="dlg-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveOperator()">保存</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
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
<script type="text/javascript" src="/js/common.js"></script>
<script>
    function saveOperator(){
        $('#ff').form('submit',{
            url: '/admin/operator/save',
            onSubmit: function(){
                return $(this).form('enableValidation').form('validate');
               // return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.errorMsg){
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {

                    $.messager.alert('提示','操作成功！','info',function(){
                        $('#dlg').dialog('close');
                        window.location.reload();
                    });

                }
            }
        });
    }

    function checkDel(id)
    {
    	$.messager.confirm('确认','确定删除此项?',function(r){    
    	    if (r){    

    	    	$.messager.progress(); 
    	    	$.ajax({
    	            type:"POST",
    	            async:false,
    	            url:"/admin/operator/delete",
    	            data:{id:id},
    	            dataType:'json',
    	            success:function(data){
    	            	$.messager.progress('close');

    	            	var d = dialog({
	                	    title: '提示',
	                	    content: "操作成功!",
	                	    cancel: false,
	                	    width:160,
	                	    ok: function () {
	                	    	window.location.reload();
		                    }
	                	});
	                	d.showModal();
    	            }
    	        });
    	        
    	    }    
    	});  
    
        return false;
    }
    
    function reLoadPage(){
        window.location.reload();
    }
    
    function EditRole(id){
    	$('#dlg').dialog('open').dialog('setTitle','编辑操作员');

    	var row="";

    	$.ajax({
            type:"POST",
            async:false,
            url:"/admin/operator/get-info",
            data:{id:id},
            dataType:'json',
            success:function(data){
                row = data.row;
            }
        });
    	
    	$('#ff').form('load',row);
        return false;
    }
    
    jQuery(function($) {

        $("#btnAdd").click(function(){
        	$("#name").val("");
        	$('#category_id')[0].selectedIndex = 0;
        	$('input[name=is_valid]').get(0).checked = true; 
            $('#dlg').dialog('open');
            return false;
        });
    
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
            "sAjaxSource": SITE_URL+"/admin/recommend/list-data",
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
                {"mData": 'name'},
                {"mData": 'category_name'},
                {"mData": 'sort_by','sClass':'auto_wrap'},
                {"mData": 'is_valid'},
                {"mData": 'create_at'},
                {"mData": 'opt_str',"bSortable": false}
            ]

        });
    });
</script>