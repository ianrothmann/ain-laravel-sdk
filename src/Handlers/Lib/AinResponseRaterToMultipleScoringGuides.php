<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinMultipleScoringResult;
use IanRothmann\Ain\Results\Lib\AinScoringResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinResponseRaterToMultipleScoringGuides extends AinHandler
{
    use LanguageSupport;
    protected $ratingItems = [];

    protected $question;
    protected $responseText;

    protected $context;

    protected string $endpoint='nlp/rating_from_scoring_guides';

    public function addRatingItem($id, $item, $scoringGuideWithOptions)
    {
        $this->ratingItems[$id]=[
            'item'=>$item,
            'scoring_guide'=>$scoringGuideWithOptions
        ];
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
     * @return AinMultipleScoringResult
     */
    public function getResult()
    {

        $result=$this->post([
            'rating_items'=>$this->ratingItems,
            'question'=>$this->question,
            'context'=>$this->context,
            'response'=>$this->responseText
        ]);

        return new AinMultipleScoringResult($result);
    }

    /**
     * @return AinMultipleScoringResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'score'=>5,
                'original'=>'This is the reason.',
            ]
        ];
        return new AinMultipleScoringResult($result);
    }
}
