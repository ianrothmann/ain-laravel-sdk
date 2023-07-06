<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinSummarizeContext extends AinHandler
{
    protected $array;

    protected string $endpoint='nlp/summarize_context';

    public function fromArray($array)
    {
        $this->array=$array;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->post([
            'array'=>$this->array,
        ]);
        return new AinSummaryResult($result);
    }

    /**
     * @return AinSummaryResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Summary here',
                'original'=>'Summary here',
            ]
        ];
        return new AinSummaryResult($result);
    }
}
