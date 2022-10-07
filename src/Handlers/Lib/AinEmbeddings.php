<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinEmbeddingsResult;
use IanRothmann\Ain\Results\Lib\AinNameSurnameResult;
use Illuminate\Support\Collection;

class AinEmbeddings extends AinHandler
{
    protected array $list;
    protected string $endpoint='embeddings';
    protected string $model='';

    /**
     * @param array|Collection $textArray
     * @return $this
     */
    public function forList($textArray)
    {
        $this->list=collect($textArray)->toArray();
        return $this;
    }

    public function forText($text)
    {
        $this->list=collect([$text])->toArray();
        return $this;
    }

    public function useModel($model)
    {
        $this->model=$model;
        return $this;
    }


    /**
     * @return AinEmbeddingsResult
     */
    public function getResult()
    {
        $result=$this->postList($this->list,['model'=>$this->model]);
        return new AinEmbeddingsResult($result);
    }

    /**
     * @return AinEmbeddingsResult
     */
    public function getMocked()
    {
        $result=['data'=>[]];
        $result['data']['list']=collect($this->list)->map(function($text){
            return [
                1,2,3,4
            ];
        })->toArray();

        return new AinEmbeddingsResult($result);
    }
}
