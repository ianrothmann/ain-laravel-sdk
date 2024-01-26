<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinFaceResult;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;
use IanRothmann\Ain\Results\Lib\AinSRTResult;
use IanRothmann\Ain\Results\Lib\AinTranscriptionResult;

class AinAudioSRTTranscriber extends AinHandler
{
    use LanguageSupport;

    protected string $url;
    protected $shouldSummarize=false;
    protected $shouldComplement=false;
    protected $shouldOutputTopics=false;

    protected $name;
    protected $context;
    protected $language;
    protected $question;

    protected string $endpoint='audio/transcribe/srt';

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

    public function outputTopics()
    {
        $this->shouldOutputTopics=true;
        return $this;
    }

    public function complement()
    {
        $this->shouldComplement=true;
        return $this;
    }

    /**
     * @return AinSRTResult
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
            'topics'=>$this->shouldOutputTopics,
        ]);

        return new AinSRTResult($result);
    }

    /**
     * @return AinSRTResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Description',
                'additional'=>[
                    'summary'=>'Summary',
                    'complement'=>'Complement',
                    'topics'=>[
                        'topic1',
                        'topic2'
                    ],
                    'srt'=>'SRT',
                    'original_srt'=>'Original SRT'
                ]
            ]
        ];
        return new AinSRTResult($result);
    }
}
