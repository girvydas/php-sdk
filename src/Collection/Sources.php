<?php

namespace Teamgate\Collection;

class Sources extends Collection
{
    protected $_uri = 'sources';

    public function fetchRelation($objectUri, $id)
    {
        $this->_uri = $objectUri . '/' . (int) $id . '/' . 'sources';
        return $this;
    }
}