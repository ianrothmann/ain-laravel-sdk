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
        $this->endpoint.='score/'.$name;
        return $this;
    }

    public function forModels(array $modelNameArray)
    {
        $this->modelName=$modelNameArray;
        $this->endpoint.='score';
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
            $result=$this->post(['data'=>$this->data,'models'=>$this->modelName]);
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
