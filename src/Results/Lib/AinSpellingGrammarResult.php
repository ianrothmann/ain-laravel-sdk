<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinSpellingGrammarResult extends AinResult
{

    protected $correctedText;
    protected $originalText;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);

        if($this->multipleResults){
            $this->correctedText=$this->mapResult('text');
            $this->originalText=$this->mapResult('original');
        }else{
            $this->correctedText=$this->data->get('text');
            $this->originalText=$this->data->get('original');
        }
    }

    public function getCorrectedText()
    {
        return $this->correctedText;
    }

    public function getOriginalText()
    {
        return $this->originalText;
    }
}
