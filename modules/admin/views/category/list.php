<?php
use yii\helpers\Url;
?>
<style>
td{text-align:left;}
</style>
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

    <div class="page-header">
        <h1>
            内容管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
            栏目管理
            </small>
        </h1>
        <div class="widget-toolbar no-border">
            <div class="btn-group">
                <a href="javascript:void(0)"
                   class="btn btn-sm bg-color-red txt-color-white"
                   style="padding-left: 15px;"><i
                        class="glyphicon glyphicon-list"> </i> 栏目列表</a>
            </div>

            <div class="btn-group">
                <a
                    href="javascript:void(0);" onclick="showDialog(0);"
                    class="btn btn-sm btn-success"> <i class="fa fa-plus"></i>
                    添加栏目
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


            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        <label class="position-relative">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>编号ID</th>
                    <th>栏目名称</th>
                    <th class="hidden-480">排序</th>

                    <th>
                                        是否有效
                    </th>
                    <th class="hidden-480">添加日期</th>

                    <th>管理操作</th>
                </tr>
                </thead>
                <tbody>
                <?= $categorys;?>
                </tbody>
            </table>


        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

<div id="dlg" class="easyui-dialog" title="添加栏目" style="width:560px;height:280px;padding:10px 20px;display:none;"
     closed="true" buttons="#dlg-buttons" data-options="iconCls:'icon-save',resizable:false,modal:true">

    <form id="ff" class="easyui-form" method="post">
        <div style="margin-top: 15px;">
            <label for="name" style="width: 20%;">名称:</label>
            <input class="easyui-validatebox textbox" type="text" id="name" name="name" data-options="required:true,missingMessage:'请输入名称',invalidMessage:'请输入名称'" style="width:60%" />
        </div>
        <div style="margin-top: 15px;">
            <label for="parentid" style="width: 20%;">所属栏目:</label>
            <select class="easyui-validatebox" id="parentid" name="parentid" style="width:60%">
               <option value="0">作为一级菜单</option>
               <?= $select_categorys ?>
            </select>
        </div>
        <div style="margin-top: 15px;">
            <label for="sort_by" style="width: 20%;">排序:</label>
            <input class="easyui-validatebox textbox" type="text" id="sort_by" value='0' name="sort_by" data-options="required:true,missingMessage:'请输入排序',invalidMessage:'请输入排序'" style="width:60%" />
        </div>
        <div style="margin-top: 15px;">
            <label for="is_valid" style="width: 20%;">是否有效:</label>
            <input type="radio" name="is_valid" value="1" checked> 有效
            <input type="radio" name="is_valid" value="0"> 无效
        </div>
        <input type="hidden" name="id" />
    </form>
<div id="dlg-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveCategory()">保存</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
</div>
</div>


<script>
	function showDialog(id){
		 if(id==0){
			 $('#ff').form('reset');
			 $('#dlg').dialog('open');
		 }else{
			 $('#dlg').dialog('open').dialog('setTitle','编辑栏目');
		     var row="";
		    	$.ajax({
		            type:"POST",
		            async:false,
		            url:"/admin/category/get-info",
		            data:{id:id},
		            dataType:'json',
		            success:function(data){
		                row = data.row;
		            }
		        });
		    	
		    	$('#ff').form('load',row);
		 }
         return false;
	}

	function sDialog(id){
		$('#ff').form('reset');

		$("#parentid option[value="+id+"]").attr("selected", true);   
		$('#dlg').dialog('open');
		return false;
	}

	function saveCategory(){
        $('#ff').form('submit',{
            url: '/admin/category/save',
            onSubmit: function(){
                return $(this).form('enableValidation').form('validate');
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
    	            url:"/admin/category/delete",
    	            data:{id:id},
    	            dataType:'json',
    	            success:function(data){
    	            	$.messager.progress('close');
						if(data.status==1){
							$.messager.alert('提示','删除成功','info',function(){
								window.location.reload();
							});    
						}else if(data.status==0){
							$.messager.alert('提示',data.message,'info');
						}
    	            	
	                	 
    	            }
    	        });
    	        
    	    }    
    	});  
    
        return false;
    }

</script>