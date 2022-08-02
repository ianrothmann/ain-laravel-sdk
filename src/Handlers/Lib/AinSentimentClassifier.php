<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinSentimentResult;
use IanRothmann\Ain\Results\Lib\AinThemesResult;


class AinSentimentClassifier extends AinHandler
{
    protected array $sentences;
    protected string $endpoint='nlp/sentiment';

    public function forSentences($arrayOfSentences)
    {
        $this->sentences=$arrayOfSentences;
        return $this;
    }

    public function get()
    {
        $result=$this->postList($this->sentences);

        return new AinSentimentResult($result);
    }
}
