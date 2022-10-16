<?php

namespace IanRothmann\Ain\ServiceProviders;

use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Handlers\Lib\AinAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinDataset;
use IanRothmann\Ain\Handlers\Lib\AinEmbeddings;
use IanRothmann\Ain\Handlers\Lib\AinKeywordExtractor;
use IanRothmann\Ain\Handlers\Lib\AinModel;
use IanRothmann\Ain\Handlers\Lib\AinNameSurnameSplitter;
use IanRothmann\Ain\Handlers\Lib\AinQuestionAnswering;
use IanRothmann\Ain\Handlers\Lib\AinRatingClassifier;
use IanRothmann\Ain\Handlers\Lib\AinRatingModelBuilder;
use IanRothmann\Ain\Handlers\Lib\AinRewriter;
use IanRothmann\Ain\Handlers\Lib\AinSentimentClassifier;
use IanRothmann\Ain\Handlers\Lib\AinSpellingGrammar;
use IanRothmann\Ain\Handlers\Lib\AinSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinThemeExtractor;
use IanRothmann\Ain\Handlers\Lib\AinTLdr;
use IanRothmann\Ain\Handlers\Lib\AinTopicAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinTopicFromList;
use IanRothmann\Ain\Results\Lib\AinModelResult;


class AinServiceProviderHandler
{

    protected AinHandlerConfig $config;

    public function __construct(AinHandlerConfig $config)
    {
        $this->config=$config;
    }

    public function topicAnalysis():AinTopicAnalysis
    {
        return new AinTopicAnalysis($this->config);
    }

    public function analysis():AinAnalysis
    {
        return new AinAnalysis($this->config);
    }

    public function dataset():AinDataset
    {
        return new AinDataset($this->config);
    }

    public function embeddings():AinEmbeddings
    {
        return new AinEmbeddings($this->config);
    }

    public function topicFromList():AinTopicFromList
    {
        return new AinTopicFromList($this->config);
    }

    public function extractThemes():AinThemeExtractor
    {
        return new AinThemeExtractor($this->config);
    }

    public function answerQuestion():AinQuestionAnswering
    {
        return new AinQuestionAnswering($this->config);
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

    public function model($name):AinModelResult
    {
        $result=(new AinModel($this->config))->name($name)->get();
        if(!$result){
            throw new \Exception("Model {$name} not found.");
        }
        return $result;
    }

    public function trainRatingClassifier():AinRatingModelBuilder
    {
        return new AinRatingModelBuilder($this->config);
    }

    public function classifyRating():AinRatingClassifier
    {
        return new AinRatingClassifier($this->config);
    }


}
