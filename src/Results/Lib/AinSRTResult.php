<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinSRTResult extends AinResult
{
    protected $summary;
    protected $complement;
    protected $topics;
    protected $text;
    protected $srt;
    protected $originalSrt;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->text=collect($this->data)->get('text');
        $this->summary=collect($this->data->get('additional'))->get('summary');
        $this->complement=collect($this->data->get('additional'))->get('complement');
        $this->topics=collect($this->data->get('additional'))->get('topics');
        $this->srt=collect($this->data->get('additional'))->get('srt');
        $this->originalSrt=collect($this->data->get('additional'))->get('original_srt');
    }

    public function getText()
    {
        return trim($this->text);
    }

    public function getSummary()
    {
        return trim($this->summary);
    }

    public function getComplement()
    {
        return trim($this->complement);
    }

    public function getTopics()
    {
        return $this->topics;
    }

    public function getSrt()
    {
        return $this->srt;
    }

    public function getOriginalSrt()
    {
        return $this->originalSrt;
    }
}
