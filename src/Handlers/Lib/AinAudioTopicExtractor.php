<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinAudioTopicsResult;
use IanRothmann\Ain\Results\Lib\AinDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinFaceResult;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;
use IanRothmann\Ain\Results\Lib\AinTranscriptionResult;

class AinAudioTopicExtractor extends AinHandler
{
    protected string $url;
    protected $name;

    protected string $endpoint='audio/topics';

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


    /**
     * @return AinAudioTopicsResult
     */
    public function getResult()
    {
        $data=[
            'url'=>$this->url,
        ];

        if($this->name){
            $data['name']=$this->name;
        }

        $result=$this->post($data);

        return new AinAudioTopicsResult($result);
    }

    /**
     * @return AinAudioTopicsResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'table'=>[
                    [
                        'starts_at'=>1,
                        'ends_at'=>2,
                        'topic'=>'Key takeaway',
                    ]
                ]
            ]
        ];
        return new AinAudioTopicsResult($result);
    }
}
