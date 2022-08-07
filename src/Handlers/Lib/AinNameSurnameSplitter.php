<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinNameSurnameResult;
use Illuminate\Support\Collection;

class AinNameSurnameSplitter extends AinHandler
{
    protected array $list;
    protected string $endpoint='nlp/name_split';

    /**
     * @param array|Collection $arrayOfCombinedNamesAndSurnames
     * @return $this
     */
    public function forList($arrayOfCombinedNamesAndSurnames)
    {
        $this->list=collect($arrayOfCombinedNamesAndSurnames)->toArray();
        return $this;
    }

    /**
     * @return AinNameSurnameResult
     */
    public function getResult()
    {
        $result=$this->postList($this->list);

        return new AinNameSurnameResult($result);
    }

    /**
     * @return AinNameSurnameResult
     */
    public function getMocked()
    {
        $result=['data'=>[]];
        $result['data']['list']=collect($this->list)->map(function($text){
            return [
                'name'=>'Name',
                'surname'=>'Surname',
                'original'=>$text
            ];
        })->toArray();

        return new AinNameSurnameResult($result);
    }
}
