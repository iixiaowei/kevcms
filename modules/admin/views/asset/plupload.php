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
    <script src="/js/plupload/plupload.full.min.js"></script>
</head>

<body style="background-color: #fff;">
<style>
.file-upload-btn-wrapper {
	margin-bottom: 10px;
}

.file-upload-btn-wrapper .num {
	color: #999999;
	float: right;
	margin-top: 5px;
}

.file-upload-btn-wrapper .num em {
	color: #FF5500;
	font-style: normal;
}

.files-wrapper {
	border: 1px solid #CCCCCC;
}

.files-wrapper ul {
	height: 280px;
	overflow-y: scroll;
	padding-bottom: 10px;
	position: relative;
	margin: 0;
}

.files-wrapper li {
	display: inline;
	float: left;
	height: 100px;
	margin: 10px 0 0 10px;
	width: 100px;
	position: relative;
	border:1px solid #CCCCCC;
}

.files-wrapper li.selected {
	border: 1px solid #fe781e;
}
.files-wrapper li .upload-percent{
	width: 100%;
	height:100%;
	line-height: 100px;
	text-align: center;
	text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.files-wrapper li .selected-icon-wrapper{
	position: absolute;
    right: 0;
    top: 0;
    width: 20px;
    height: 20px;
    font-size: 16px;
	text-align:center;
	line-height:20px;
	color:#fe781e;
	display: none;
}
.files-wrapper li.selected .selected-icon-wrapper{
	display: block;
}
.files-wrapper li img{
	width: 100%;
	height: 100%;
    vertical-align: top;
}
</style>
<script>
	function get_selected_files(){
		var tab = $("#uploader-tabs li.active").data('tab');
		var files= [];
		if(tab=='upload-file'){
			var $files=$('#files-container li.uploaded.selected');
			if($files.length==0){
				alert('请上传文件！');
				return false;
			}
			$files.each(function(){
				var $this=$(this);
				var url = $this.data('url');
				var preview_url = $this.data('preview_url');
				var filepath = $this.data('filepath');
				var name = $this.data('name');
				var id = $this.data('id');
				files.push({url:url,preview_url:preview_url,filepath:filepath,name:name,id:id});
			});
		}
		if(tab=='network-file'){
			var url=$('#network-file-input').val();
			if(url==''){
				alert('请填写文件地址！');
				return false;
			}
			var id = "networkfile"+new Date().getTime();
			files.push({url:url,preview_url:url,filepath:url,id:id});
		}
		return files;
	}
</script>
</head>
<body>
	<div class="wrap" style="padding: 5px;">
		<ul class="nav nav-tabs" id="uploader-tabs">
			<li class="active" data-tab="upload-file"><a href="#upload-file-tab" data-toggle="tab">上传文件</a></li>
			<li data-tab="network-file"><a href="#network-file-tab" data-toggle="tab">网络文件</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="upload-file-tab">
				<div class="file-upload-btn-wrapper">
					<!--选择按钮-->
					<div id="container" style="display: inline-block;">
					<a class="btn btn-primary" id="select-files">
						选择文件
					</a>
					</div>
					<span class="num">
						<empty name="multi">
							最多上传<em>1</em>个附件,
						</empty>
						单文件最大<em><?= $upload_max_filesize_mb ?>MB</em>,
						<em style="cursor: help;" title="可上传格式：<?= $extensions ?>" data-toggle="tooltip">支持格式？</em>
					</span>
				</div>
				<div class="files-wrapper">
					<ul id="files-container">
					</ul>
				</div>
			</div>
			<div class="tab-pane" id="network-file-tab">
				请输入网络地址<br>
				<input type="text" name="info[filename]" style="width: 600px;" placeholder="http://" id="network-file-input">
			</div>
		</div>
	</div>
	<script>
		var multi=<?= $multi ?>;
		var mime_type = <?= $mime_type ?>;
		var extensions = mime_type.extensions.split(/,/);
		var mimeTypeRegExp=new RegExp('\\.(' + extensions.join('|') + ')$', 'i');
		
		 
			var uploader = new plupload.Uploader({
				runtimes : 'html5,flash,silverlight,html4',
				browse_button : 'select-files', // you can pass an id...
				container: document.getElementById('container'), // ... or DOM Element itself
				url : "{:U('asset/asset/plupload')}",
				flash_swf_url : '/js/plupload/Moxie.swf',
				silverlight_xap_url : '/js/plupload/Moxie.xap',
				filters : {
					max_file_size : '<?= $upload_max_filesize_mb ?>mb'/* ,
					mime_types: [<?= $mime_type ?>] */
				},
				multi_selection:<?php echo $multi; ?>,
				multipart_params:{
					app:'<?= $app ?>'
				},
				init: {
					PostInit: function() {
					},

					FilesAdded: function(up, files) {
						plupload.each(files, function(file) {
							var $newfile=$('\
									<li class="selected">\
										<div class="selected-icon-wrapper"><i class="fa fa-check-circle"></i></div>\
										<div class="upload-percent">0%</div>\
									</li>');
							$newfile.attr('id',file.id);
							$('#files-container').append($newfile);
							$newfile.on('click',function(){
								var $this=$(this);
								$this.toggleClass('selected');
							});
						});
						uploader.start();
					},

					UploadProgress: function(up, file) {
						$('#'+file.id).find('.upload-percent').text(file.percent+"%");
					},
					
					FileUploaded: function(up, file, response) {
						var data = JSON.parse(response.response);
						if(data.status==1){
							if(!multi) {
								$('#select-files').css('visibility','hidden');
								$('#container').css('visibility','hidden');
							}
							var $file=$('#'+file.id);
							$file.addClass('uploaded')
							.data('id',file.id)
							.data('url',data.url)
							.data('preview_url',data.preview_url)
							.data('filepath',data.filepath)
							.data('name',data.name);
							
							if(data.url.match(/\.(jpeg|gif|jpg|png|bmp|pic)$/gi)){
								var $img=$('<img/>');
								$img.attr('src',data.url);
								$file.find('.upload-percent')
								.html($img);
							}else{
								$file.find('.upload-percent').attr('title',data.name).text(data.name);
							}
						}else{
							alert(data.message);
							$('#'+file.id).remove();
						}
					},
					
					Error: function(up, err) {
					}
				}
			});
	 
			plupload.addFileFilter('mime_types', function(filters, file, cb) {
				if (!mimeTypeRegExp.test(file.name)) {
					this.trigger('Error', {
						code : plupload.FILE_EXTENSION_ERROR,
						message : plupload.translate('File extension error.'),
						file : file
					});
					alert("此文件类型不能上传!\n"+file.name);
					cb(false);
				} else {
					cb(true);
				}
			});


			uploader.init();
			
 
	</script>
</body>
</html>


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