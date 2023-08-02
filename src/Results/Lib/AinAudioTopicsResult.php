<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinAudioTopicsResult extends AinResult
{

    protected $topics;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->topics=collect($this->data->get('table'));
    }

    public function getTopics():Collection
    {
        return $this->topics;
    }
}
