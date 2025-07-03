<?php

class Routes{
    public function run(){
        $router=new App();
        $router->setDefaultController('DefaultApp');
        $router->setDefaultMethod('index');

        $router->get('/parkir',['ParkirController','index']);
        $router->get('/parkir/add',['ParkirController','addView']);
        $router->get('/parkir/delete',['ParkirController','deleteView']);
        $router->post('/parkir/add-parkir',['ParkirController','add']);
        $router->post('/parkir/delete-parkir',['ParkirController','delete']);
        $router->get('/parkir/aktif',['ParkirController','aktifView']);
        $router->get('/admin/tarif',['AdminController','tarifView']);
        $router->get('/admin/laporan',['AdminController','laporanView']);
        $router->post('/admin/tarif-update',['AdminController','tarifUpdate']);
        $router->get('/admin/export-csv', ['AdminController','exportCSV']);

        $router->run();
    }
}