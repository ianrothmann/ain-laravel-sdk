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
        $this->correctedText=$this->data->get('text');
        $this->originalText=$this->data->get('original');
    }

    public function getCorrectedText():string
    {
        return $this->correctedText;
    }

    public function getOriginalText():string
    {
        return $this->originalText;
    }
}
