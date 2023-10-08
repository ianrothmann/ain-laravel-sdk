<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinScoringResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinAudioUnderstandingRater extends AinHandler
{
    protected $text;
    protected $responseText;

    protected string $endpoint='nlp/audio_understanding';

    public function forOriginalAudioTranscript($text)
    {
        $this->text=$text;
        return $this;
    }

    public function givenResponse($text)
    {
        $this->responseText=$text;
        return $this;
    }

    /**
     * @return AinScoringResult
     */
    public function getResult()
    {
        $result=$this->post([
            'text'=>$this->text,
            'response'=>$this->responseText,
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
