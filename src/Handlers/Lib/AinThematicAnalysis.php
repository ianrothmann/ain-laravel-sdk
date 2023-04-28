<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinDescribedThemesResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinThematicAnalysis extends AinHandler
{
    protected $inputText;
    protected $context;
    protected $firstPerson=true;

    protected string $endpoint='nlp/thematic_analysis';

    public function text($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function withContext($context)
    {
        $this->context=$context;
        return $this;
    }

    public function inFirstPerson($firstPerson=true)
    {
        $this->firstPerson=$firstPerson;
        return $this;
    }

    /**
     * @return AinDescribedThemesResult
     */
    public function getResult()
    {
        $result=$this->postText($this->inputText,[
            'context'=>$this->context,
            'first_person'=>$this->firstPerson
        ]);

        return new AinDescribedThemesResult($result);
    }

    /**
     * @return AinDescribedThemesResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'original'=>$this->inputText,
                'table'=>[
                    [
                        'theme'=>'Key takeaway',
                        'context'=>'positive',
                        'accuracy'=>'100',
                        'paraphrase'=>'Paraphrase of what is said',
                        'quote'=>'Quote what is being said',
                    ]
                ]
            ]
        ];
        return new AinDescribedThemesResult($result);
    }
}
