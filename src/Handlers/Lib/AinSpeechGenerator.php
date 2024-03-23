<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinFaceResult;
use IanRothmann\Ain\Results\Lib\AinFileResult;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;
use IanRothmann\Ain\Results\Lib\AinPronunciationResult;
use IanRothmann\Ain\Results\Lib\AinTranscriptionResult;

class AinSpeechGenerator extends AinHandler
{
    protected $text;
    protected $voice=3;
    protected $language='en-GB';

    protected string $endpoint='audio/speech';

    public function text($text)
    {
        $this->text=$text;
        return $this;
    }

    public function voiceNumber($voice=3)
    {
        $this->voice=$voice;
        return $this;
    }

    public function inLanguage($language)
    {
        $this->language=$language;
        return $this;
    }

    /**
     * @return AinFileResult
     */
    public function getResult()
    {
        $result=$this->postWithRawResponse([
            'text'=>$this->text,
            'voice_number'=>$this->voice,
            'language'=>$this->language,
        ]);

        return new AinFileResult($result);
    }

    /**
     * @return AinFileResult
     */
    public function getMocked()
    {
        return new AinFileResult(file_get_contents($this->http->url.'/audio/mock.mp3'));
    }
}
