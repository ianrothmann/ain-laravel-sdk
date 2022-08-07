<?php

namespace IanRothmann\Ain\Results;

abstract class AinResult
{
    protected $data;
    protected $tokens;

    public function __construct($httpResultArray)
    {
        $this->data =collect(collect($httpResultArray)->get('data'));
        $this->tokens=$this->data->get('tokens',0);
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    public function dd()
    {
        dd($this);
    }

}
