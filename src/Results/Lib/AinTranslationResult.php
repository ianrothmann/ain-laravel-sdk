<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinTranslationResult extends AinResult
{
    protected $translations;

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->translations=collect($this->data->get('table'))->last();
    }

    public function getTranslations():Collection
    {
        return $this->translations;
    }
}
