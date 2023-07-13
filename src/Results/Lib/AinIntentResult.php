<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinIntentResult extends AinResult
{

    protected $intent;
    protected $params=[];

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
        $this->params=collect();

        if($this->data->get('intent')){
            $intent=collect($this->data->get('intent'));
            $this->intent=$intent->get('intent');
            $this->params=collect($intent->get('data'));
        }
    }

    public function getIntent()
    {
        return $this->intent;
    }

    public function getParameters()
    {
        return $this->params;
    }

}
