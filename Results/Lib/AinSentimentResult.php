<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinSentimentResult extends AinResult
{

    protected $classifications;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->classifications=collect($this->data->get('list'));
    }

    public function getSentimentClassifications():Collection
    {
        return $this->classifications->map(function($item){
            return $item['sentiment'];
        });
    }

    public function getSentimentClassificationsWithOriginals():Collection
    {
        return $this->classifications;
    }
}
