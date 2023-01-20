<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinBooleanListResult;
use IanRothmann\Ain\Results\Lib\AinNameSurnameResult;
use IanRothmann\Ain\Results\Lib\AinTopicFromListResult;
use Illuminate\Support\Collection;

class AinThematicAnalysisInclusionDecision extends AinHandler
{
    protected array $list;
    protected $context;
    protected string $endpoint='nlp/thematic_analysis_inclusion';

    /**
     * @param array|Collection $arrayOfTexts
     * @return $this
     */
    public function onList($arrayOfTexts)
    {
        $this->list=collect($arrayOfTexts)->toArray();
        return $this;
    }

    public function withContext($context)
    {
        $this->context=$context;
        return $this;
    }

    /**
     * @return AinBooleanListResult
     */
    public function getResult()
    {
        $result=$this->postList($this->list,[
            'context'=>$this->context
        ]);

        return new AinBooleanListResult($result);
    }

    /**
     * @return AinBooleanListResult
     */
    public function getMocked()
    {
        $result=['data'=>[]];
        $result['data']['list']=collect($this->list)
            ->map(function($list){
                return rand(0,1000)>500;
            })
            ->toArray();

        return new AinBooleanListResult($result);
    }
}
