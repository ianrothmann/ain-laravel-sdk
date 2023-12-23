<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinStrengthsShortcomingsResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTableResult;

class AinCandidateStrengthsShortcomingsGenerator extends AinHandler
{
    use LanguageSupport;

    protected $ratings = [];

    protected $context;
    protected $requirements;

    protected string $endpoint='nlp/candidate_strengths_shortcomings';

    public function addRating($question, $score, $reason)
    {
        $this->ratings[]=[
            'question'=>$question,
            'score'=>$score,
            'reason'=>$reason,
        ];
        return $this;
    }
    public function givenRequirements($text)
    {
        $this->requirements=$text;
        return $this;
    }

    public function withCandidateContext($text)
    {
        $this->context=$text;
        return $this;
    }

    /**
     * @return AinStrengthsShortcomingsResult
     */
    public function getResult()
    {
        $result=$this->post([
            'ratings'=>$this->ratings,
            'job_description'=>$this->requirements,
            'context'=>$this->context,
        ]);
        return new AinStrengthsShortcomingsResult($result);
    }

    /**
     * @return AinStrengthsShortcomingsResult
     */
    public function getMocked()
    {
        $data = [
            [
                'strengths'=>'Strengths',
                'shortcomings'=>'Shortcomings',
            ]
        ];

        $result=[
            'data'=>$data
        ];

        return new AinTableResult($result);
    }
}
