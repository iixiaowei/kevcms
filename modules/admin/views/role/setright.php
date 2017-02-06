<?php
use yii\helpers\Url;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            系统设置
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
               角色权限设置
            </small>
        </h1>
        <div class="widget-toolbar no-border">
            <div class="btn-group">
                <a href="<?= Url::toRoute(['/admin/role/list']) ?>"
                   class="btn btn-sm bg-color-red txt-color-white"
                   style="padding-left: 15px;"><i
                        class="glyphicon glyphicon-list"> </i> 角色列表</a>
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

            <div class="row">
                <div class="col-sm-12">
                    <div class="widget-box widget-color-pink ui-sortable-handle">
                        <div class="widget-header widget-header-small">
                            <h4 class="widget-title lighter smaller">选择权限</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-8">
                                
                            
                            <div class="easyui-panel" style="padding:5px;border:none;">
                        		<ul id="tt" class="easyui-tree" data-options="url:'/admin/role/get-rightlists?id=<?= $id; ?>',method:'get',animate:true,checkbox:true"></ul>
                        	</div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            
            <div class="space-4"></div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" id="btnSubmit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            提交
                        </button>
                        <input type="hidden" id="txt_ids" name="txt_ids" /> 
                        <input type="hidden" id="id" name="id" value="<?= $id ?>"/> 
                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            返回 
                        </button>
                    </div>
                </div>
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken() ?>" />

        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<script>
	$(function(){
		//$('#tt').tree({onlyLeafCheck:true})
		$("#btnSubmit").click(function(){
			var nodes = $('#tt').tree('getChecked');
			var s = '';
			for(var i=0; i<nodes.length; i++){
				if (s != '') s += ',';
				s += nodes[i].id;
			}
			$("#txt_ids").val( s );
			var roleid = $("#id").val();

			$.ajax({
	             type:"POST",
	             async:false,
	             url:"/admin/role/do-setright",
	             data:{ids:s,roleid:roleid},
	             dataType:'json',
	             success:function(data){
	                if(data.status==1){
	                	var d = dialog({
	                	    title: '提示',
	                	    content: data.msg,
	                	    cancel: false,
	                	    width:160,
	                	    ok: function () {
	                	    	window.location.href = SITE_URL+"/admin/role/list";
		                    }
	                	});
	                	d.showModal();
		            }else{
		            	var d = dialog({
                            content: data.msg
                        });
                        d.showModal();
                        setTimeout(function () {
                            d.close().remove();
                        }, 2000);
			        }
	             }
	         });
			
		});

		
	});
</script>