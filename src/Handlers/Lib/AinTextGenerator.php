<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTextResult;

class AinTextGenerator extends AinHandler
{
    protected $input = [];

    protected string $endpoint='nlp/generate_text';

    public function addInstruction($text)
    {
        $this->input[]=$text;
        return $this;
    }

    /**
     * @return AinTextResult
     */
    public function getResult()
    {
        $result=$this->post([
            'instructions'=>$this->input,
        ]);
        return new AinTextResult($result);
    }

    /**
     * @return AinTextResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Generated text',
                'original'=>'Generated text',
            ]
        ];
        return new AinTextResult($result);
    }
}
