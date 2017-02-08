<?php
namespace app\modules\admin\controllers;

use app\modules\admin\components\BaseController;
class AssetController extends BaseController
{
    
    public function actionPlupload()
    {
        $filetypes=array(
            'image'=>array('title'=>'Image files','extensions'=>'jpg,jpeg,png,gif,bmp4'),
            'video'=>array('title'=>'Video files','extensions'=>'mp4,avi,wmv,rm,rmvb,mkv'),
            'audio'=>array('title'=>'Audio files','extensions'=>'mp3,wma,wav'),
            'file'=>array('title'=>'Custom files','extensions'=>'txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar')
        );
        
        $image_extensions=explode(',', $filetypes['image']['extensions']);
        
        $filetype = \Yii::$app->request->get('filetype','image');
        $mime_type=array();
        if(array_key_exists($filetype, $filetypes)){
            $mime_type=$filetypes[$filetype];
        }else{
            $this->error('上传文件类型配置错误！');
        }
        
        $multi= \Yii::$app->request->get('multi',0);
        $app=\Yii::$app->request->get('app','');
        $upload_max_filesize=10240;
        $extensions = $filetypes[$filetype]['extensions'];
        
        return $this->renderPartial('plupload',[
            'extensions'=>$extensions,
            'upload_max_filesize'=>$upload_max_filesize,
            'upload_max_filesize_mb'=>intval($upload_max_filesize/1024),
            'mime_type'=>json_encode($mime_type),
            'multi'=>$multi,
            'app'=>$app
        ]);
    }
    
}