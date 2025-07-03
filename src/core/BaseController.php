<?php

class BaseController {
    public function view($view, $data = []){
        if(count($data)){
            extract($data);
        }

        // Tambahkan favicon secara otomatis
        $favicon = '<link rel="icon" href="'.BASEURL.'/img/favicon.ico" type="image/x-icon">';

        // Mulai output buffering   
        ob_start();        
        require_once '../src/views/'.$view.'.php';
        $content = ob_get_clean();

        // Suntikkan favicon ke dalam head
        $content = preg_replace(
            '/(<head[^>]*>)/i', 
            '$1'.$favicon, 
            $content
        );
        
        echo $content;        
    }

    public function redirect($url){
        header('Location: '.$url);
        exit;
    }

    public function model($model){
        require_once '../src/models/'.$model.'.php';
        return new $model;
    }
}