<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTextResult;

class AinTextGenerator extends AinHandler
{
    use LanguageSupport;
    protected $input = [];

    protected string $endpoint='nlp/generate_text';

    protected string $creativity='high';

    public function addInstruction($text)
    {
        $this->input[]=$text;
        return $this;
    }

    public function withHighCreativity()
    {
        $this->creativity='high';
        return $this;
    }

    public function withMediumCreativity()
    {
        $this->creativity='medium';
        return $this;
    }

    public function withLowCreativity()
    {
        $this->creativity='low';
        return $this;
    }

    /**
     * @return AinTextResult
     */
    public function getResult()
    {
        $result=$this->post([
            'instructions'=>$this->input,
            'creativity'=>$this->creativity
        ]);
        return new AinTextResult($result);
    }

    /**
     * @return AinTextResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Generated text',
                'original'=>'Generated text',
            ]
        ];
        return new AinTextResult($result);
    }
}
