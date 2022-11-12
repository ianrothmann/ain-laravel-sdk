<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinSQLDescriber extends AinHandler
{
    protected $query;
    protected $columns=[];

    protected string $endpoint='nlp/sql_describe';

    public function query($query)
    {
        $this->query=$query;
        return $this;
    }

    public function withColumnNames($columns)
    {
        $this->columns=$columns;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $params=[
            'columns'=>$this->columns
        ];

        $result=$this->postText($this->query,$params);
        return new AinSummaryResult($result);
    }

    /**
     * @return AinSummaryResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->query,
                'original'=>$this->query,
            ]
        ];
        return new AinSummaryResult($result);
    }
}
