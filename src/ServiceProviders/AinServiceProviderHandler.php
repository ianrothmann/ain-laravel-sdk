<?php

namespace IanRothmann\Ain\ServiceProviders;

use IanRothmann\Ain\Handlers\Lib\AinSentimentClassifier;
use IanRothmann\Ain\Handlers\Lib\AinThemeExtractor;
use IanRothmann\Ain\Http\AinHttp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AinServiceProviderHandler
{

    protected array $config;
    protected AinHttp $http;
    protected $shouldMock=false;
    protected $shouldCache=true;

    public function __construct($url,$key)
    {
        $this->config=[
            'key'=>$key,
            'url'=>$url
        ];
        $this->http=new AinHttp($url,$key);
    }

    public function mocked()
    {
        $this->shouldMock=true;
        $this->http->mock();
        return $this;
    }

    public function force()
    {
        $this->shouldCache=false;
        $this->http->force();
        return $this;
    }

    public function extractThemesFromText():AinThemeExtractor
    {
        return new AinThemeExtractor($this->http);
    }

    public function classifySentiment():AinSentimentClassifier
    {
        return new AinSentimentClassifier($this->http);
    }


}
