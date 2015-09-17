<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Image extends Eloquent {

	protected $table = 'images';
	public $timestamps = true;

	use ValidatingTrait;
	use SoftDeletingTrait;

	protected $rules = array(
        'parent_id' => 'required',
        'name' => 'required'
    );

    protected $maxSize = 2097152;


	protected $dates = ['deleted_at'];
	protected $fillable = array('parent_id', 'name', 'category', 'position', 'active' );
	protected $visible = array('parent_id', 'name', 'category',  'position', 'active', 'title');

	public function getMaxSize(){
		return $this->maxSize;
	}
	public function upload($name, $category, $order = null){

			$images = Input::file($name);
            $orderFicticio = $order+1;
    		if($order === null)
                $file = $images;
            else
                $file = $images[$order];
            $extension = $file->getClientOriginalExtension();
            if($category == 'home-sliders')
                $required_height = 334;
            else
                $required_height = 500;
            $required_width = 750;
            $upload_path = public_path() . '/images/upload/'.$category.'/';
            
            list($width, $height) = getimagesize($file);
            $final_name = $order.uniqid().'.'.$extension;

            $msg = "La imagen ".$orderFicticio." debe ser ";
            if($file->getSize() > $this->getMaxSize()){
                return array(
                        "success" => false,
                        "msg" => $msg."menor a un 2mb"
                    );
            }
            if($extension != 'jpg' && $extension != 'png'){
                return array(
                        "success" => false,
                        "msg" => $msg." .jpg or .png"
                    );
            }
            if($width != $required_width || $height != $required_height){
                return array(
                        "success" => false,
                        "msg" => $msg.$required_width." x ".$required_height." px"
                    );
            }
            if($file->move($upload_path,  $final_name)){
                return array(
                        "success" => true,
                        "msg"     => $final_name
                    );
            }else{
                return array(
                        "success" => false,
                        "msg" => $order." image could not be uploaded"
                    );
            }

    }

    public function uploadFromBase64($name, $category, $order = null){

          $images = Input::get('finalB64Input'.$name.$order);
          $debug = 'finalB64Input'.$name.$order.'   ='.$images;
          
          $extension = strtolower(substr($images, 11, strpos($images, ';')-11));
          $img = str_replace('data:image/'.$extension.';base64,', '', $images);
          $img = str_replace(' ', '+', $img);
          $data = base64_decode($img);
          
            $orderFicticio = $order+1;
            if($order === null)
                $file = $images;
            else
                $file = $images[$order];
            
            if($category == 'home-sliders')
                $required_height = 334;
            else
                $required_height = 500;
            $required_width = 750;
            $upload_path = public_path() . '/images/upload/'.$category.'/';
            $final_name = $order.uniqid().'.'.$extension;
            //dd($final_name);
            //dd($upload_path.$final_name, $data);
            if(file_put_contents($upload_path.$final_name, $data)){

                $msg = "La imagen ".$orderFicticio." debe ser ";
                if(filesize($upload_path.$final_name) > $this->getMaxSize()){
                    return array(
                            "success" => false,
                            "msg" => $msg."menor a un 2mb"
                        );
                }
                if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
                    return array(
                            "success" => false,
                            "msg" => $msg." .jpg or .png"
                        );
                }
                list($width, $height) = getimagesize($upload_path.$final_name);
                //dd($width.' '.$height);
                if($width != $required_width || $height != $required_height){
                    return array(
                            "success" => false,
                            "msg" => $msg.$required_width." x ".$required_height." px"
                        );
                }
                return array(
                        "success" => true,
                        "msg"     => $final_name,
                        'debug' => $debug
                    );
            }else{
                return array(
                        "success" => false,
                        "msg" => $order." imagen no pudo ser subida",
                        'debug' => $debug
                    );
            }
    }

}