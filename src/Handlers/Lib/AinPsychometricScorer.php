<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinModelResult;
use IanRothmann\Ain\Results\Lib\AinPsychometricScoreResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinPsychometricScorer extends AinHandler
{
    protected $modelName;
    protected $data;

    protected string $endpoint='models/r/';

    public function forModel($name)
    {
        $this->modelName=$name;
        $this->endpoint.=$name.'/score';
        return $this;
    }

    public function onData($data)
    {
        $this->data=$data;
        return $this;
    }

    /**
     * @return AinPsychometricScoreResult
     */
    public function getResult()
    {
        try{
            $result=$this->post(['data'=>$this->data]);
            return new AinPsychometricScoreResult($result['data']);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * @return AinPsychometricScoreResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'F1'=>0.3,
            ]
        ];
        return new AinPsychometricScoreResult($result);
    }
}
