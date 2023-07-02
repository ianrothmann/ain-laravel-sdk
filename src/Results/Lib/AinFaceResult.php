<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinFaceResult extends AinResult
{
    protected $faceCount;
    protected $text;
    protected $complement;
    protected $faceData;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->text=collect($this->data->get('text'));
        $this->faceCount=collect($this->data->get('additional'))->get('face_count');
        $this->complement=collect($this->data->get('additional'))->get('complement');
        $this->faceData=collect($this->data->get('additional'))->get('face_data');
    }

    public function getDescription()
    {
        return $this->text;
    }

    public function getFaceCount()
    {
        return $this->faceCount;
    }

    public function getComplement()
    {
        return $this->complement;
    }

    public function getFaceData()
    {
        return $this->faceData;
    }
}
