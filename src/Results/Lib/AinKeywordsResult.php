<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinKeywordsResult extends AinResult
{

    protected $keywords;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->keywords=collect($this->data->get('list'));
    }

    public function getKeywords():Collection
    {
        return $this->keywords;
    }
}
