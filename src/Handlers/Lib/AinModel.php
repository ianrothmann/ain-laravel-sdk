<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinModelResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinModel extends AinHandler
{
    protected $modelName;

    protected string $endpoint='models/';

    public function name($name)
    {
        $this->modelName=$name;
        $this->endpoint.=$name;
        return $this;
    }

    /**
     * @return AinModelResult
     */
    public function getResult()
    {
        try{
            $result=$this->httpGet();
            return new AinModelResult($result['data']);
        }catch (\Exception $e){
            return null;
        }

    }

    /**
     * @return AinModelResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'name'=>'Model name',
                'state'=>'New',
                'params'=>[],
            ]
        ];
        return new AinModelResult($result);
    }
}
