<?php
namespace Lib\Util;

trait ModelFormat{

    public function formatDate($date){
        $date = date_create($date);
        return date_format($date, 'Y-m-d');
    }

    public function basicCurrentFormatDate(){
        $date = new \DateTime('now');
        return $date->format('Y-m-d h:i:s');
    }
    
}