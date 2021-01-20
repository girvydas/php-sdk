<?php

namespace Teamgate\Collection;

class SourcesList extends Collection
{
    protected $_model = 'source';

    public function __construct($transport)
    {
        parent::__construct($transport);
        $this->_uri = 'sources';
    }
}