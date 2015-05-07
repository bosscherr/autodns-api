<?php

namespace Autodns\Api\Client\Request\Task;


use Autodns\Api\Client\Request\Task;

class CancelationInquireList extends InquireList
{

    public function asArray() {
        $array = parent::asArray();
        $array['code'] = '0103104';

        return $array;
    }

 
}
