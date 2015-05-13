<?php

namespace Autodns\Api\Client\Request\Task;
use Autodns\Api\Client\Request\Task;


/**
 * Class DomainUpdate
 * @package Autodns\Api\Client\Request\Task
 */
class DomainUpdate implements Task
{
    private $domainData = array();
    private $replyTo;


    /**
     * @param array $domainData
     * @return $this
     */
    public function fill(array $domainData)
    {
        $this->domainData = $domainData;
        return $this;
    }

    public function replyTo($replyTo) {
        $this->replyTo = $replyTo;
        return $this;
    }
    
    

    function __call( $name, $arguments ) {
        $fields = array(
            'name',
            'ctid',
            'ownerc',
            'adminc',
            'techc',
            'zonec',
            'nserver',

            'dnssec',
            'confirm_order',
            'zone',
            'use_trustee',
       
        );
        if ( in_array( $name, $fields ) ) {
            $this->domainData[ $name ] = $arguments[0];
            return $this;
        }
        trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
    }

    /**
     * @return array
     */
    public function asArray()
    {
        $array = array(
            'code' => '0102',
            'domain' => $this->domainData
        );

        if ( $this->replyTo ) {
            $array['reply_to'] = $this->replyTo;
        }

        return $array;
    }
}