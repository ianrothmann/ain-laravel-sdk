<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinScoringResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinWritingQualityRater extends AinHandler
{
    protected $question;
    protected $responseText;
    protected $level='intermediate';

    protected string $endpoint='nlp/writing_quality';

    public function forQuestion($text)
    {
        $this->question=$text;
        return $this;
    }

    public function givenResponse($text)
    {
        $this->responseText=$text;
        return $this;
    }

    public function onLevel($level)
    {
        if (!in_array($level, ['basic', 'intermediate', 'advanced'])){
            throw new \Exception('Invalid level. Must be one of basic, intermediate or advanced');
        }

        $this->level=$level;
        return $this;
    }

    /**
     * @return AinScoringResult
     */
    public function getResult()
    {
        $result=$this->post([
            'question'=>$this->question,
            'response'=>$this->responseText,
            'level'=>$this->level,
        ]);

        return new AinScoringResult($result);
    }

    /**
     * @return AinScoringResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'score'=>5,
                'original'=>'This is the reason.',
            ]
        ];
        return new AinScoringResult($result);
    }
}
