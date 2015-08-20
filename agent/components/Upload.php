<?php
namespace agent\components;

use yii;
use yii\base\Object;
use yii\web\UploadedFile;

class Upload extends Object
{
	/**
	 * [UploadPhoto description]
	 * @param [type]  $model      [实例化模型]
	 * @param [type]  $path       [图片存储路径]
	 * @param [type]  $originName [图片源名称]
	 * @param boolean $isthumb    [是否要缩略图]
	 */
    public function UploadPhoto($model,$path,$originName,$isthumb=false){
		$root = $_SERVER['DOCUMENT_ROOT'].'/'.$path;
		//返回一个实例化对象
		$files = UploadedFile::getInstance($model,$originName);
		$folder = date('Ymd')."/";
		$pre = rand(999,9999).time();
		if($files && ($files->type == "image/jpeg" || $files->type == "image/pjpeg" || $files->type == "image/png" || $files->type == "image/x-png" || $files->type == "image/gif"))
		{
			$newName = $pre.'.'.$files->getExtension();
		}else{
			die($files->type);
		}
		if($files->size > 2000000){
			die("上传的文件太大");
		}		
		if(!is_dir($root.$folder))
		{
			if(!mkdir($root.$folder, 0777, true)){
				die('创建目录失败...');
			}else{
			//	chmod($root.$folder,0777);
			}
		}
		//echo $root.$folder.$newName;exit;
		if($files->saveAs($root.$folder.$newName))
		{
			if($isthumb){
				$this->thumbphoto($files,$path.$folder.$newName,$path.$folder.'thumb'.$newName);
				return $path.$folder.$newName.'#'.$path.$folder.'thumb'.$newName;
			}else{
				return $path.$folder.$newName;
			}
			
		}
    }
	//调用缩略图
	public function thumbphoto($model,$path,$newname){
		$im = null;
		$imagetype = strtolower($model->getExtension());
		if($imagetype == 'gif'){
			$im = imagecreatefromgif($path);
		}elseif($imagetype == 'jpg' || $imagetype == 'jpeg'){
			$im = imagecreatefromjpeg($path);
		}elseif($imagetype == 'png'){
			$im = imagecreatefrompng($path);
		}
		$this->resizeImage($im,220, 220, $newname, $model->getExtension());	
	}	
	/***
	******ÉÏ´«¶à¸öÍ¼Æ¬
	******$model=>Îª±íµ¥¶ÔÏó $pathÎªÉÏ´«Â·¾¶
	***/
    public function UploadPhotos($model,$path)
    {
		$root = $_SERVER['DOCUMENT_ROOT'].'/'.$path;
		$files = CUploadedFile::getInstances($model,'p_path');
	//	print_r($files);exit;
		$return ='';
		$n = 1;
		foreach($files as $file){
			$pre = rand(999,9999).time().$n;
			if($file && ($file->type == "image/jpeg" || $file->type == "image/pjpeg" || $file->type == "image/png" || $file->type == "image/x-png" || $file->type == "image/gif"))
			{
				$newName = $pre.'.'.$file->getExtension();
			}else{
				die('wrong type');
			}
			if(!is_dir($root))
			{
				if(!mkdir($root, 0755, true))
				{
					die('´´ÔìÎÄ¼þ¼ÐÊ§°Ü...');
				}
			}
			//echo $root.$folder.$newName;exit;
			if($file->saveAs($root.$newName))
			{		
				$return .= $path.$newName.'#';
			}
			$n++;
		}
		return $return;
    }	

    //生成缩略图
    public static function resizeImage($im, $maxwidth, $maxheight, $name,$filetype) {
		$pic_width = imagesx ( $im );
		$pic_height = imagesy ( $im );

		if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
			if ($maxwidth && $pic_width > $maxwidth) {
				$widthratio = $maxwidth / $pic_width;
				$resizewidth_tag = true;
			}
			
			if ($maxheight && $pic_height > $maxheight) {
				$heightratio = $maxheight / $pic_height;
				$resizeheight_tag = true;
			}
			
			if (isset($resizewidth_tag) && isset($resizeheight_tag)) {
				if ($widthratio < $heightratio)
					$ratio = $widthratio;
				else
					$ratio = $heightratio;
			}
			
			if (isset($resizewidth_tag) && ! isset($resizeheight_tag))
				$ratio = $widthratio;
			if (isset($resizeheight_tag) && ! isset($resizewidth_tag))
				$ratio = $heightratio;
			
			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;
			
			if (function_exists ( "imagecopyresampled" )) {
				$newim = imagecreatetruecolor ( $newwidth, $newheight );
				imagecopyresampled ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height );
			} else {
				$newim = imagecreate ( $newwidth, $newheight );
				imagecopyresized ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height );
			}
			
			imagejpeg ( $newim, $name );
			imagedestroy ( $newim );
		} else {
			$name = $name;// . $filetype;
			imagejpeg ( $im, $name );
		}
	}	
}
