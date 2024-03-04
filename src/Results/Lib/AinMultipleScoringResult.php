<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinMultipleScoringResult extends AinResult
{
    protected $results;
    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->results = collect(collect($this->data)->get('table'))
            ->keyBy('item_id')
            ->map(function ($row){
                return collect($row)->only(['score','reason']);
            });
    }

    public function getResults()
    {
        return $this->results;
    }
}
