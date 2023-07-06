<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinSummarizeConversation extends AinHandler
{
    protected $array;
    protected $prevSummary;


    protected string $endpoint='nlp/summarize_conversation';

    public function withConversationArray($array)
    {
        collect($array)->each(function($item){
            $item=collect($item);
            if(!$item->has('speaker') || !$item->has('text')){
                throw new \Exception("Invalid array passed - should have keys 'speaker' and 'text'");
            }
        });

        $this->array=$array;
        return $this;
    }

    public function givenPreviousSummary($prevSummary)
    {
        $this->prevSummary=$prevSummary;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->post([
            'previous_summary'=>$this->prevSummary,
            'conversation'=>$this->array
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
                'text'=>'Text here',
                'original'=>'Text here',
            ]
        ];
        return new AinSummaryResult($result);
    }
}
