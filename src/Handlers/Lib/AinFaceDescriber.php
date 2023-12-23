<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinFaceResult;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;

class AinFaceDescriber extends AinHandler
{
    use LanguageSupport;

    protected string $url;
    protected bool $shouldDescribe=true;
    protected bool $shouldComplement=false;

    protected string $endpoint='mixed/describe_faces';

    public function fromUrl($url)
    {
        $this->url=$url;
        return $this;
    }

    public function describe()
    {
        $this->shouldDescribe=true;
        return $this;
    }

    public function complement()
    {
        $this->shouldComplement=true;
        return $this;
    }

    /**
     * @return AinFaceResult
     */
    public function getResult()
    {
        $result=$this->post([
            'url'=>$this->url,
            'complement'=>$this->shouldComplement,
            'describe'=>$this->shouldDescribe
        ]);
        return new AinFaceResult($result);
    }

    /**
     * @return AinFaceResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Description',
                'additional'=>[
                    'face_count'=>1
                ]
            ]
        ];
        return new AinFaceResult($result);
    }
}
