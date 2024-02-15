<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinScoringResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinResponseRaterToScoringGuide extends AinHandler
{
    use LanguageSupport;
    protected $ratingItem;
    protected $ratingOptions;

    protected $question;
    protected $responseText;

    protected $context;
    protected $scoringGuide;

    protected string $endpoint='nlp/rating_from_scoring_guide';

    public function forRatingItem($ratingItem)
    {
        $this->ratingItem=$ratingItem;
        return $this;
    }

    public function withRatingOptions($options)
    {
        $this->ratingOptions=$options;
        return $this;
    }

    public function onQuestion($question)
    {
        $this->question=$question;
        return $this;
    }

    public function givenScoringGuide($guide)
    {
        $this->scoringGuide=$guide;
        return $this;
    }

    public function onCandidateResponse($text)
    {
        $this->responseText=$text;
        return $this;
    }

    public function withCandidateContext($text)
    {
        $this->context=$text;
        return $this;
    }

    /**
     * @return AinScoringResult
     */
    public function getResult()
    {

        $result=$this->post([
            'rating_item'=>$this->ratingItem,
            'rating_options'=>$this->ratingOptions,
            'question'=>$this->question,
            'context'=>$this->context,
            'scoring_guide'=>$this->scoringGuide,
            'response'=>$this->responseText
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
