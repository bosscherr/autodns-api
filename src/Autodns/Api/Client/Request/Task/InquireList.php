<?php

namespace Autodns\Api\Client\Request\Task;


use Autodns\Api\Client\Request\Task;

class InquireList implements Task
{
    /**
     * @var string[]
     */
    private $keys;
    /**
     * @var QueryInterface
     */
    private $query;

    /**
     * @var string[]
     */
    private $view;
    
    /**
     * @var string[]
     */
    private $order;
    
    public function asArray() {
        $array = array('code' => '0105');

        if ($this->view) {
            $array['view'] = $this->view;
        }
 
        if ($this->keys) {
            $array['key'] = $this->keys;
        }

        if ($this->order) {
          $array['order'] = $this->order;
        }

        if ($this->query) {
            $array['where'] = $this->query->asArray();
        }

        return $array;
    }

    /**
     * @param $view
     * @return $this
     */
    public function withView(array $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function withKeys(array $keys)
    {
        $this->keys = $keys;
        return $this;
    }

    /**
     * @param QueryInterface $query
     * @return $this
     */
    public function withQuery(QueryInterface $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param $order
     * @return $this
     */
    public function withOrder(array $order)
    {
      $this->order = $order;
      return $this;
    }

}
