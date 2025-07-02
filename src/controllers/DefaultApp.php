<?php

class DefaultApp extends BaseController{
    public function index(){
        // echo 'Hello World from DefaultApps';
        $data=[
            'title' => 'SmartPark - Sistem Parkir Cerdas',
        ];
        $this->view('home/index', $data);
    }
}