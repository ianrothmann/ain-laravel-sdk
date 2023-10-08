<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinPronunciationResult extends AinResult
{
    protected $success;
    protected $confidence;
    protected $overall;
    protected $accuracy;
    protected $fluency;
    protected $completeness;
    protected $lexical;
    protected $displayText;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->success=collect($this->data)->get('success');
        $this->confidence=collect($this->data)->get('confidence');
        $this->overall=collect($this->data)->get('overall');
        $this->accuracy=collect($this->data)->get('accuracy');
        $this->fluency=collect($this->data)->get('fluency');
        $this->completeness=collect($this->data)->get('completeness');
        $this->lexical=collect($this->data)->get('lexical');
        $this->displayText=collect($this->data)->get('displayText');
    }

    public function getText()
    {
        return trim($this->displayText);
    }

    public function getLexical()
    {
        return trim($this->lexical);
    }

    public function getOverallScore()
    {
        return $this->overall;
    }

    public function getAccuracy()
    {
        return $this->accuracy;
    }

    public function getFluency()
    {
        return $this->fluency;
    }

    public function getCompleteness()
    {
        return $this->completeness;
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
