<?php

class State extends \Eloquent {
    protected $table = 'state';
    protected $guarded = array();

//    public function data()
//    {
//        return $this->hasManyThrough('App\Lga', 'App\Area','App\Street', 'App\Datas', 'stateid', 'lgaid', 'areaid',
//            'streetid');
//    }
}