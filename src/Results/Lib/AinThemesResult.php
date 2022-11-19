<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinThemesResult extends AinResult
{

    protected $themes;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        if($this->multipleResults){
            $this->themes=$this->mapResult('list');
        }else{
            $this->themes=collect($this->data->get('list'));
        }
    }

    public function getThemes():Collection
    {
        return $this->themes;
    }
}
