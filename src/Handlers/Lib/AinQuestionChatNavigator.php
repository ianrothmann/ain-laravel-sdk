<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinIntentResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinQuestionChatNavigator extends AinHandler
{
    use LanguageSupport;
    protected $questionsByNumberArray;
    protected $userResponse;
    protected $userContext;

    protected string $endpoint='nlp/question_chat_navigator';

    public function forQuestionsByNumbers($array)
    {
        $this->questionsByNumberArray=$array;
        return $this;
    }

    public function withUserResponse($response)
    {
        $this->userResponse=$response;
        return $this;
    }

    public function withUserContext($context)
    {
        $this->userContext=$context;
        return $this;
    }

    /**
     * @return AinIntentResult
     */
    public function getResult()
    {
        $result=$this->post([
            'previous_questions_by_number'=>$this->questionsByNumberArray,
            'user_response'=>$this->userResponse,
            'user_context'=>$this->userContext
        ]);
        return new AinIntentResult($result);
    }

    /**
     * @return AinIntentResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'intent'=>'action',
                'params'=>[
                    'param1' => 'value'
                ],
            ]
        ];
        return new AinIntentResult($result);
    }
}
