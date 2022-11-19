<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinRewriteResult extends AinResult
{

    protected $newText;
    protected $originalText;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);

        if($this->multipleResults){
            $this->newText=$this->mapResult('text');
            $this->originalText=$this->mapResult('original');
        }else{
            $this->newText=$this->data->get('text');
            $this->originalText=$this->data->get('original');
        }
    }

    public function getNewText()
    {
        return $this->newText;
    }

    public function getOriginalText()
    {
        return $this->originalText;
    }
}
