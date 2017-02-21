<?php
namespace app\modules\admin\controllers;

use app\modules\admin\components\BaseController;
use app\components\Util;
use app\components\Upload;
class AssetController extends BaseController
{
    public $enableCsrfValidation = false;
    public function actionPlupload()
    {
        $filetypes=array(
            'image'=>array('title'=>'Image files','extensions'=>'jpg,jpeg,png,gif,bmp4'),
            'video'=>array('title'=>'Video files','extensions'=>'mp4,avi,wmv,rm,rmvb,mkv'),
            'audio'=>array('title'=>'Audio files','extensions'=>'mp3,wma,wav'),
            'file'=>array('title'=>'Custom files','extensions'=>'txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar')
        );
        
        $image_extensions=explode(',', $filetypes['image']['extensions']);
        $file = fopen(getcwd()."/test.txt", "w");
        fwrite($file, "start");
        fclose($file);
        if($_POST){
            $file = fopen(getcwd()."/test.txt", "w");
            fwrite($file, "aa");
            fclose($file);
            $all_allowed_exts=array();
            foreach ($filetypes as $mfiletype){
                array_push($all_allowed_exts, $mfiletype['extensions']);
            }
            $all_allowed_exts=implode(',', $all_allowed_exts);
            $all_allowed_exts=explode(',', $all_allowed_exts);
            $all_allowed_exts=array_unique($all_allowed_exts);
            
            $file_extension = Util::sp_get_file_extension($_FILES['file']['name']);
            $file = fopen(getcwd()."/test.txt", "w");
            fwrite($file, $file_extension."aa");
            fclose($file);
             
            
            
        }else{
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
    
    public function actionDoupload(){
    $filetypes=array(
            'image'=>array('title'=>'Image files','extensions'=>'jpg,jpeg,png,gif,bmp4'),
            'video'=>array('title'=>'Video files','extensions'=>'mp4,avi,wmv,rm,rmvb,mkv'),
            'audio'=>array('title'=>'Audio files','extensions'=>'mp3,wma,wav'),
            'file'=>array('title'=>'Custom files','extensions'=>'txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar')
        );
        
        $image_extensions=explode(',', $filetypes['image']['extensions']);
        
        if(\Yii::$app->request->isPost){
            $all_allowed_exts=array();
            foreach ($filetypes as $mfiletype){
                array_push($all_allowed_exts, $mfiletype['extensions']);
            }
            $all_allowed_exts=implode(',', $all_allowed_exts);
            $all_allowed_exts=explode(',', $all_allowed_exts);
            $all_allowed_exts=array_unique($all_allowed_exts);
            
            $file_extension = Util::sp_get_file_extension($_FILES['file']['name']);
            $upload_max_filesize=2097152;//默认2M
            
            $app = \Yii::$app->request->post('app','default');
            $savepath=$app.'/'.date('Ymd').'/';
            //上传处理类
            $config=array(
                'rootPath' => './data/upload/',
                'savePath' => $savepath,
                'maxSize' => $upload_max_filesize,
                'saveName'   =>    array('uniqid',''),
                'exts'       =>    $all_allowed_exts,
                'autoSub'    =>    false,
            );
             
            $upload = new Upload($config);
            $info=$upload->upload();
            
            if ($info){
                //上传成功
                $oriName = $_FILES['file']['name'];
                //写入附件数据库信息
                $first=array_shift($info);
                $url= "/data/upload/$savepath".$first['savename'];
                $preview_url=$url;
                $filepath = $savepath.$first['savename'];
                echo json_encode(array('preview_url'=>$preview_url,'filepath'=>$filepath,'url'=>$url,'name'=>$oriName,'status'=>1,'message'=>'success'));
            }else{
                echo json_encode(array('name'=>'','status'=>0,'message'=>$upload->getError()));
            }
            
            
        }
    }
    
}