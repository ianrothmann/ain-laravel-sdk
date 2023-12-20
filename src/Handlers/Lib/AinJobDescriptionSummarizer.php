<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinJobDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTableResult;

class AinJobDescriptionSummarizer extends AinHandler
{
    protected $questions = [];
    protected $text;

    protected string $endpoint='nlp/summarize_job_description';

    public function forJobDescription($text)
    {
        $this->text=$text;
        return $this;
    }

    /**
     * @return AinJobDescriptionResult
     */
    public function getResult()
    {
        $result=$this->postText($this->text);
        return new AinJobDescriptionResult($result);
    }

    /**
     * @return AinJobDescriptionResult
     */
    public function getMocked()
    {
        $data = [];
        foreach ($this->questions as $id => $question) {
            $data[] = [
                'id' => $id,
                'ideal_response' => 'Demo ideal response',
                'question' => $question['question'],
            ];
        }
        $result=[
            'data'=>$data
        ];
        return new AinJobDescriptionResult($result);
    }
}
