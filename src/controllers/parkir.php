<?php

class Parkir{

    public function index(){
        echo 'Hello World from parkir index';
    }

    public function edit($id1=0, $id2=""){
        echo 'Edit form Parkir id1 = '.$id1.' dan id2 =  '.$id2;
    }
}