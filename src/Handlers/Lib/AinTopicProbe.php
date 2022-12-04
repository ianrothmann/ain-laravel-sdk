<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinTopicProbe extends AinHandler
{
    protected $inputText;
    protected $topics;

    protected string $endpoint='nlp/topic_probe';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function forTopics(array $topics)
    {
        $this->topics=$topics;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->post([
            'text'=>$this->inputText,
            'topics'=>$this->topics
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
                'text'=>$this->inputText,
                'original'=>$this->inputText,
            ]
        ];
        return new AinSummaryResult($result);
    }
}
