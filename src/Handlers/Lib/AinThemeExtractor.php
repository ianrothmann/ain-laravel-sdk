<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinThemesResult;


class AinThemeExtractor extends AinHandler
{
    protected string $text;
    protected string $context='';
    protected $pointOfView=null;
    protected string $endpoint='nlp/extract_themes';

    public function forText($text)
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

    public function get()
    {
        $result=$this->postText($this->text,[
            'pov'=>$this->pointOfView,
            'context'=>$this->context
        ]);

        return new AinThemesResult($result);
    }
}
