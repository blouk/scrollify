<?php

if(isset($_FILES) && array_key_exists('scrollify_video',$_FILES)){
  // file upload is ok let's start our stuff.
  $scrollify = new Scrollify($_FILES);
}

Class Scrollify
{
  private $upload_folder = "/home/openerp/www/www.scrollify.com/scrollify/upload/";
  private $token = '';
  private $ext = '';
  private $path_video = '';

  public function __construct($file) {  
    $this->file = $file;
    $this->ext = end(explode('.', basename($this->file['scrollify_video']['name'])));
    $this->token = $this->create_token();
    $this->move_file();
  }

  private function move_file() {
    $this->path_video = $this->upload_folder.$this->token.'.'.$this->ext;
    if ( move_uploaded_file($this->file['scrollify_video']['tmp_name'], $this->path_video) ) {
      // extract image from the movie
      $this->extract_images();
    } else {
      echo json_encode(array('error'=>'true'));
    }
  }

  private function create_token(){
    // return an unique Id ( for futur url ) 
    return uniqid();
  }
  
  private function extract_images(){
    // extract images with ffmpeg
    $command = 'ffmpeg -i '.$this->path_video.' '.$this->upload_folder.$this->token.'_%03d.jpg';
    exec($command,$error);
    
    // retrieve all imgs from this token.
    $files = glob($this->upload_folder.$this->token.'*.jpg',GLOB_NOESCAPE);
    $fileArray = array();
    foreach( $files as $file ){
      $fileArray[] = basename($file);
    }
    // return a json with all informations we need.
    $values = array (
	    'error'=>'false',
            'token'=>$this->token,
            'files'=>$fileArray
    );
    echo json_encode($values);
  }
}
?>
