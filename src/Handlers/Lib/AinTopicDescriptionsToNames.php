<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinRewriteResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinThemesResult;

class AinTopicDescriptionsToNames extends AinHandler
{
    protected $descriptionList;

    protected string $endpoint='nlp/topic_descriptions_to_names';

    public function descriptions($descriptionList)
    {
        $this->descriptionList=$descriptionList;
        return $this;
    }


    /**
     * @return AinThemesResult
     */
    public function getResult()
    {
        $result=$this->postList($this->descriptionList);
        dd($result);
        return new AinThemesResult($result);
    }

    /**
     * @return AinThemesResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'list'=>[
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'Sed sit amet lorem ultrices, sodales ligula ac, tincidunt nulla.',
                    'Duis iaculis erat non bibendum feugiat.',
                ]
            ]
        ];
        return new AinThemesResult($result);
    }
}
