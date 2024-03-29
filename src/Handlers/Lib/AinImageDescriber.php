<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinDescriptionResult;
use IanRothmann\Ain\Results\Lib\AinFaceResult;
use IanRothmann\Ain\Results\Lib\AinKeywordsResult;

class AinImageDescriber extends AinHandler
{
    use LanguageSupport;

    protected string $url;

    protected string $endpoint='mixed/describe_picture';

    protected bool $shouldDescribe=true;
    protected bool $shouldComplement=false;
    protected $context;

    public function fromUrl($url)
    {
        $this->url=$url;
        return $this;
    }

    public function inContextOf($context)
    {
        $this->context=$context;
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
     * @return AinDescriptionResult
     */
    public function getResult()
    {
        $result=$this->post([
            'url'=>$this->url,
            'complement'=>$this->shouldComplement,
            'describe'=>$this->shouldDescribe,
            'context'=>$this->context
        ]);
        return new AinDescriptionResult($result);
    }

    /**
     * @return AinFaceResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>'Description',
            ]
        ];
        return new AinFaceResult($result);
    }
}
