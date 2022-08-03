<?php

namespace Ianrothmann\Ain\Handlers;

use IanRothmann\Ain\Http\AinHttp;

class AinHandlerConfig
{
    public AinHttp $http;
    public $mockType;
    public $cacheType;
    public $cacheTtl;
    protected array $config;

    public function __construct($url,$key,$cacheType='remote',$cacheTtl=180,$mockType='none')
    {
        $this->config=[
            'key'=>$key,
            'url'=>$url,
        ];

        $this->cacheType=$cacheType;
        $this->cacheTtl=$cacheTtl;
        $this->mockType=$mockType;

        $this->http=new AinHttp($url,$key);
        if($this->mockType=='remote'){
            $this->http->mock();
        }

        if($this->cacheType=='none'){
            $this->http->force();
        }
    }
}