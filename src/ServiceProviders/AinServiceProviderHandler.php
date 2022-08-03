<?php

namespace IanRothmann\Ain\ServiceProviders;

use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Handlers\Lib\AinRewriter;
use IanRothmann\Ain\Handlers\Lib\AinSentimentClassifier;
use IanRothmann\Ain\Handlers\Lib\AinSpellingGrammar;
use IanRothmann\Ain\Handlers\Lib\AinThemeExtractor;
use IanRothmann\Ain\Http\AinHttp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AinServiceProviderHandler
{

    protected AinHandlerConfig $config;

    public function __construct(AinHandlerConfig $config)
    {
        $this->config=$config;
    }

    public function extractThemesFromText():AinThemeExtractor
    {
        return new AinThemeExtractor($this->config);
    }

    public function classifySentiment():AinSentimentClassifier
    {
        return new AinSentimentClassifier($this->config);
    }

    public function languageCheck():AinSpellingGrammar
    {
        return new AinSpellingGrammar($this->config);
    }

    public function rewriter():AinRewriter
    {
        return new AinRewriter($this->config);
    }


}
