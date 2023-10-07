<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinPronunciationResult extends AinResult
{
    protected $success;
    protected $confidence;
    protected $accuracy;
    protected $itn;
    protected $displayText;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->success=collect($this->data)->get('success');
        $this->confidence=collect($this->data)->get('confidence');
        $this->accuracy=collect($this->data)->get('accuracy');
        $this->itn=collect($this->data)->get('maskedITN');
        $this->displayText=collect($this->data)->get('displayText');
    }

    public function getText()
    {
        return trim($this->displayText);
    }

    public function getMaskedItn()
    {
        return trim($this->itn);
    }

    public function getAccuracy()
    {
        return $this->accuracy;
    }

    public function getConfidence()
    {
        return $this->confidence;
    }

    public function wasSuccessful()
    {
        return $this->success;
    }
}
