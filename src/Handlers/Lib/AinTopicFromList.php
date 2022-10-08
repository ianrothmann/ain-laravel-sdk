<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinNameSurnameResult;
use IanRothmann\Ain\Results\Lib\AinTopicFromListResult;
use Illuminate\Support\Collection;

class AinTopicFromList extends AinHandler
{
    protected array $list;
    protected string $endpoint='nlp/statements2topic';

    /**
     * @param array|Collection $arrayOfTexts
     * @return $this
     */
    public function forList($arrayOfTexts)
    {
        $this->list=collect($arrayOfTexts)->toArray();
        return $this;
    }

    /**
     * @return AinTopicFromListResult
     */
    public function getResult()
    {
        $result=$this->postList($this->list);

        return new AinTopicFromListResult($result);
    }

    /**
     * @return AinTopicFromListResult
     */
    public function getMocked()
    {
        $result=['data'=>[]];
        $result['data']['list']=[
            'name'=>'Topic name',
            'description'=>'Topic description',
        ];

        return new AinTopicFromListResult($result);
    }
}
