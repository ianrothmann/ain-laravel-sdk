<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinScoringResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTableResult;
use Illuminate\Support\Facades\Validator;

class AinIdealResponseCandidateSummarizer extends AinHandler
{
    protected $ratings;
    protected $responseText;
    protected $jobDescription;

    protected $context;
    protected $idealAnswerText;
    protected $questionResponseType;

    protected string $endpoint='nlp/ideal_response_candidate_summary';

    public function forRatings($ratings)
    {
        $validator=Validator::make([
            'ratings'=>$ratings
        ],[
            'ratings'=>'array|required',
            'ratings.*' => 'required|required_array_keys:rating,reason'
        ]);

        if($validator->fails()){
            throw new \Exception('Rating data is not valid, should be an array of arrays with the following keys: rating, reason');
        }
        $this->ratings=$ratings;
        return $this;
    }


    public function forJobDescription($text)
    {
        $this->jobDescription=$text;
        return $this;
    }

    public function withCandidateContext($text)
    {
        $this->context=$text;
        return $this;
    }

    /**
     * @return AinTableResult
     */
    public function getResult()
    {
        $result=$this->post([
            'ratings'=>$this->ratings,
            'context'=>$this->context,
            'job_description'=>$this->jobDescription,
        ]);

        return new AinTableResult($result);
    }

    /**
     * @return AinTableResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'strengths'=>'This is the reason.',
                'gaps'=>'This is the reason.',
            ]
        ];
        return new AinTableResult($result);
    }
}
