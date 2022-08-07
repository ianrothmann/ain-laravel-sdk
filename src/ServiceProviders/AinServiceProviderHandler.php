<?php

namespace IanRothmann\Ain\ServiceProviders;

use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Handlers\Lib\AinKeywordExtractor;
use IanRothmann\Ain\Handlers\Lib\AinNameSurnameSplitter;
use IanRothmann\Ain\Handlers\Lib\AinRewriter;
use IanRothmann\Ain\Handlers\Lib\AinSentimentClassifier;
use IanRothmann\Ain\Handlers\Lib\AinSpellingGrammar;
use IanRothmann\Ain\Handlers\Lib\AinSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinThemeExtractor;
use IanRothmann\Ain\Handlers\Lib\AinTLdr;
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

    public function extractThemes():AinThemeExtractor
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

    public function rewrite():AinRewriter
    {
        return new AinRewriter($this->config);
    }

    public function extractKeywords():AinKeywordExtractor
    {
        return new AinKeywordExtractor($this->config);
    }

    public function summarize():AinSummarizer
    {
        return new AinSummarizer($this->config);
    }

    public function TLdr():AinTLdr
    {
        return new AinTLdr($this->config);
    }

    /**
     * @return AinNameSurnameSplitter
     */
    public function splitNames():AinNameSurnameSplitter
    {
        return new AinNameSurnameSplitter($this->config);
    }


}
