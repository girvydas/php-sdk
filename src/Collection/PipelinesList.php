<?php

namespace Teamgate\Collection;

class PipelinesList extends Collection
{
    protected $_model = 'pipeline';

    public function __construct($transport)
    {
        parent::__construct($transport);
        $this->_uri = 'pipelines';
    }
}