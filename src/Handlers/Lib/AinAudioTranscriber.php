<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinFaceResult;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;
use IanRothmann\Ain\Results\Lib\AinTranscriptionResult;

class AinAudioTranscriber extends AinHandler
{
    use LanguageSupport;

    protected string $url;
    protected $shouldSummarize=false;
    protected $shouldComplement=false;

    protected $name;
    protected $context;
    protected $language;
    protected $question;

    protected string $endpoint='audio/transcribe';

    public function fromUrl($url)
    {
        $this->url=$url;
        return $this;
    }

    public function byName($name)
    {
        $this->name=$name;
        return $this;
    }

    public function withSpeakerContext($context)
    {
        $this->context=$context;
        return $this;
    }

    public function isLanguage($language)
    {
        $this->language=$language;
        return $this;
    }

    public function wasAskedAQuestion($question)
    {
        $this->question=$question;
        return $this;
    }

    public function summarize()
    {
        $this->shouldSummarize=true;
        return $this;
    }

    public function complement()
    {
        $this->shouldComplement=true;
        return $this;
    }

    /**
     * @return AinTranscriptionResult
     */
    public function getResult()
    {
        $result=$this->post([
            'url'=>$this->url,
            'summarize'=>$this->shouldSummarize,
            'complement'=>$this->shouldComplement,
            'name'=>$this->name,
            'context'=>$this->context,
            'question'=>$this->question,
            'language'=>$this->language,
        ]);

        return new AinTranscriptionResult($result);
    }

    /**
     * @return AinTranscriptionResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Description',
                'additional'=>[
                    'summary'=>'Summary',
                    'complement'=>'Complement',
                ]
            ]
        ];
        return new AinTranscriptionResult($result);
    }
}
