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
        $this->newText=$this->data->get('text');
        $this->originalText=$this->data->get('original');
    }

    public function getNewText():string
    {
        return $this->newText;
    }

    public function getOriginalText():string
    {
        return $this->originalText;
    }
}
