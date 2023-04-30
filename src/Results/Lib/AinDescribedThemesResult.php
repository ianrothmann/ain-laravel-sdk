<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinDescribedThemesResult extends AinResult
{

    protected $themes;
    protected $multipleResults=true;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        if($this->multipleResults){
            $this->themes=$this->mapResult('table');
        }else{
            $this->themes=collect($this->data->get('table'));
        }
    }

    public function getThemes():Collection
    {
        return $this->themes;
    }
}
