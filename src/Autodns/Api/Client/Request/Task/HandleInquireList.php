<?php

namespace Autodns\Api\Client\Request\Task;


use Autodns\Api\Client\Request\Task;

class HandleInquireList extends InquireList
{

    public function asArray() {
        $array = parent::asArray();
        $array['code'] = '0304';

        return $array;
    }

 
}
