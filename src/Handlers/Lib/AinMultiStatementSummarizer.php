<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinMultiStatementSummarizer extends AinHandler
{
    protected $statements;
    protected $context;
    protected $instruction;

    protected string $endpoint='nlp/multi_statement_summary';

    public function withStatements($statementArray)
    {
        $this->statements=$statementArray;
        return $this;
    }

    public function withContext($context)
    {
        $this->context=$context;
        return $this;
    }

    public function withInstruction($instruction)
    {
        $this->instruction=$instruction;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->postList($this->statements,[
            'context'=>$this->context,
            'instruction'=>$this->instruction,
        ]);
        return new AinSummaryResult($result);
    }

    /**
     * @return AinSummaryResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->statements,
                'original'=>null,
            ]
        ];
        return new AinSummaryResult($result);
    }
}
