<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinMultiStatementSummarizer extends AinHandler
{
    protected $statements;

    protected string $endpoint='nlp/multi_statement_summary';

    public function withStatements($statementArray)
    {
        $this->statements=$statementArray;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->postList($this->statements);
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
