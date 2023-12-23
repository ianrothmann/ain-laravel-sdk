<?php

namespace IanRothmann\Ain\Handlers\Lib\Traits;

trait LanguageSupport
{
    protected $languageName='English';
    protected $languageCode='en';

    public function outputInLanguage($languageName, $languageCode)
    {
        $this->languageName = $languageName;
        $this->languageCode = $languageCode;
        return $this;
    }
}
