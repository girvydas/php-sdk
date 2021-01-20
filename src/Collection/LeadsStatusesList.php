<?php

namespace Teamgate\Collection;

class LeadsStatusesList extends Collection
{
    protected $_model = 'leadsStatus';

    public function __construct($transport)
    {
        parent::__construct($transport);
        $this->_uri = 'leadsStatuses';
    }
}