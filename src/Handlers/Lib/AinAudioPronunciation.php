<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinFaceResult;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;
use IanRothmann\Ain\Results\Lib\AinPronunciationResult;
use IanRothmann\Ain\Results\Lib\AinTranscriptionResult;

class AinAudioPronunciation extends AinHandler
{
    protected string $url;

    protected $text;
    protected $language='en-GB';

    protected string $endpoint='audio/pronunciation';

    public function fromUrl($url)
    {
        $this->url=$url;
        return $this;
    }

    public function wasReading($text)
    {
        $this->text=$text;
        return $this;
    }

    public function inLanguage($language)
    {
        $this->language=$language;
        return $this;
    }

    /**
     * @return AinPronunciationResult
     */
    public function getResult()
    {
        $result=$this->post([
            'url'=>$this->url,
            'text'=>$this->text,
            'language'=>$this->language,
        ]);

        return new AinPronunciationResult($result);
    }

    /**
     * @return AinPronunciationResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'success'=>true,
                'overall'=>100.0,
                'accuracy'=>100.0,
                'fluency'=>100.0,
                'completeness'=>100.0,
                'confidence'=>100.0,
                'lexical'=>'Text',
                'displayText'=>'Text',
            ]
        ];
        return new AinPronunciationResult($result);
    }
}
