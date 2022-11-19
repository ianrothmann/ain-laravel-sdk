<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinThemesResult;


class AinThemeExtractor extends AinHandler
{
    protected $text;
    protected string $context='';
    protected $pointOfView=null;
    protected string $endpoint='nlp/extract_themes';

    public function fromText($text)
    {
        $this->text=$text;
        return $this;
    }

    public function inFirstPerson()
    {
        $this->pointOfView='first';
        return $this;
    }

    public function inSecondPerson()
    {
        $this->pointOfView='second';
        return $this;
    }

    public function inThirdPerson()
    {
        $this->pointOfView='third';
        return $this;
    }

    /**
     * @param $context "An employee responds to a survey"
     * @return $this
     */
    public function forContext($context)
    {
        $this->context=$context;
        return $this;
    }

    /**
     * @return AinThemesResult
     */
    public function getResult()
    {
        $result=$this->postText($this->text,[
            'pov'=>$this->pointOfView,
            'context'=>$this->context
        ]);

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
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget ipsum a sem dictum mattis et vitae arcu. Nunc ac diam odio. Morbi molestie libero magna, a sagittis ligula congue ac.',
                    'Sed sit amet lorem ultrices, sodales ligula ac, tincidunt nulla.',
                    'Duis iaculis erat non bibendum feugiat. Suspendisse sit amet blandit tellus. Suspendisse ut orci eget turpis facilisis dapibus at pharetra nisi.',
                ]
            ]
        ];

        return new AinThemesResult($result);
    }
}
