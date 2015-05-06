<?php

namespace Autodns\Api\Client\Request\Task;


use Autodns\Api\Client\Request\Task;

class DomainInquireList extends InquireList
{

  
    public function asArray() {
        $array = parent::asArray();
        $array['code'] = '0105';
    

        return $array;
    }

 
}