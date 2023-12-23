<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTableResult;

class AinIdealResponseMultipleGenerator extends AinHandler
{
    use LanguageSupport;
    protected $questions = [];
    protected $existingIdealAnswers = [];
    protected $requirements;

    protected string $endpoint='nlp/ideal_response_multiple_generation';

    public function addQuestion($id, $question, $answerFormat, $options = [])
    {
        $this->questions[]=[
            'id' => $id,
            'question'=>$question,
            'answer_format'=>$answerFormat,
            'options'=>$options,
        ];
        return $this;
    }
    public function givenRequirements($text)
    {
        $this->requirements=$text;
        return $this;
    }

    public function withExistingIdealResponse($question, $idealResponse)
    {
        $this->existingIdealAnswers[]=[
            'question'=>$question,
            'ideal_response'=>$idealResponse,
        ];
        return $this;
    }

    /**
     * @return AinTableResult
     */
    public function getResult()
    {
        $result=$this->post([
            'questions'=>$this->questions,
            'requirements'=>$this->requirements,
            'existing_ideal_responses'=>$this->existingIdealAnswers,
        ]);
        return new AinTableResult($result);
    }

    /**
     * @return AinTableResult
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
        return new AinTableResult($result);
    }
}
