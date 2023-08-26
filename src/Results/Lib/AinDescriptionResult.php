<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinDescriptionResult extends AinResult
{
    protected $text;
    protected $complement;

    protected $rawData;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->text=collect($this->data)->get('text');
        $this->complement=collect($this->data->get('additional'))->get('complement');
        $this->rawData=collect($this->data->get('additional'))->get('raw_data');
    }

    public function getDescription()
    {
        return trim($this->text);
    }

    public function getComplement()
    {
        return trim($this->complement);
    }

    public function getRawData()
    {
        return $this->rawData;
    }

}
