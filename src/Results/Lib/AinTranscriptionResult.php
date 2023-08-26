<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinTranscriptionResult extends AinResult
{
    protected $summary;
    protected $complement;
    protected $text;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->text=collect($this->data)->get('text');
        $this->summary=collect($this->data->get('additional'))->get('summary');
        $this->complement=collect($this->data->get('additional'))->get('complement');
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
}
