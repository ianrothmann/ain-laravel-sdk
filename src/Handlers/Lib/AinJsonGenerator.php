<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinJsonResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTextResult;

class AinJsonGenerator extends AinHandler
{
    protected $input = [];
    protected $jsonStructure=[];

    protected string $endpoint='nlp/generate_json';

    public function addInstruction($text)
    {
        $this->input[]=$text;
        return $this;
    }


    public function withJsonStructure($jsonStructure)
    {
        $this->jsonStructure=$jsonStructure;
        return $this;
    }

    /**
     * @return AinJsonResult
     */
    public function getResult()
    {
        $result=$this->post([
            'instructions'=>$this->input,
            'json_structure'=>$this->jsonStructure,
        ]);
        return new AinJsonResult($result);
    }

    /**
     * @return AinJsonResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Generated text',
            ]
        ];
        return new AinJsonResult($result);
    }
}
