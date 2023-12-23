<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinStrengthsShortcomingsResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTableResult;
use IanRothmann\Ain\Results\Lib\AinTranslationResult;

class AinTranslator extends AinHandler
{
    protected $languages = [];
    protected $parameters = [];

    protected $text;

    protected string $endpoint='nlp/translate';

    public function givenText($text)
    {
        $this->text=$text;
        return $this;
    }

    public function addLanguage($name, $isoCode)
    {
        $this->languages[]=[
            'name'=>$name,
            'code'=>$isoCode,
        ];
        return $this;
    }

    public function retainParameters($parameters)
    {
        $this->parameters=$parameters;
        return $this;
    }

    /**
     * @return AinTranslationResult
     */
    public function getResult()
    {
        $result=$this->post([
            'languages'=>$this->languages,
            'text'=>$this->text,
            'parameters'=>$this->parameters,
        ]);
        return new AinTranslationResult($result);
    }

    /**
     * @return AinTranslationResult
     */
    public function getMocked()
    {
        $data = [
            $this->languages->mapWithKeys(function ($language) {
                return [$language['code'] => $language['name'] . " (ISO 639-1 code: {$language['code']})"];
            })->toArray()
        ];

        $result=[
            'data'=>$data
        ];

        return new AinTranslationResult($result);
    }
}
