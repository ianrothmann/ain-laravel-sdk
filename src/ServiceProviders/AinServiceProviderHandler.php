<?php

namespace IanRothmann\Ain\ServiceProviders;

use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Handlers\Lib\AinAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinAudioTranscriber;
use IanRothmann\Ain\Handlers\Lib\AinDataset;
use IanRothmann\Ain\Handlers\Lib\AinEmbeddings;
use IanRothmann\Ain\Handlers\Lib\AinFaceDescriber;
use IanRothmann\Ain\Handlers\Lib\AinImageDescriber;
use IanRothmann\Ain\Handlers\Lib\AinInterviewQuestionGenerator;
use IanRothmann\Ain\Handlers\Lib\AinKeywordExtractor;
use IanRothmann\Ain\Handlers\Lib\AinModel;
use IanRothmann\Ain\Handlers\Lib\AinMultiStatementSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinNameSurnameSplitter;
use IanRothmann\Ain\Handlers\Lib\AinPsychometricScorer;
use IanRothmann\Ain\Handlers\Lib\AinQuestionAnswering;
use IanRothmann\Ain\Handlers\Lib\AinQuestionChatNavigator;
use IanRothmann\Ain\Handlers\Lib\AinRatingClassifier;
use IanRothmann\Ain\Handlers\Lib\AinRatingModelBuilder;
use IanRothmann\Ain\Handlers\Lib\AinRewriter;
use IanRothmann\Ain\Handlers\Lib\AinSentimentClassifier;
use IanRothmann\Ain\Handlers\Lib\AinSpellingGrammar;
use IanRothmann\Ain\Handlers\Lib\AinSQLDescriber;
use IanRothmann\Ain\Handlers\Lib\AinSummarizeContext;
use IanRothmann\Ain\Handlers\Lib\AinSummarizeConversation;
use IanRothmann\Ain\Handlers\Lib\AinSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinSummarizeTranscription;
use IanRothmann\Ain\Handlers\Lib\AinThematicAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinThematicAnalysisInclusionDecision;
use IanRothmann\Ain\Handlers\Lib\AinThemeExtractor;
use IanRothmann\Ain\Handlers\Lib\AinTLdr;
use IanRothmann\Ain\Handlers\Lib\AinTopicAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinTopicDescriptionsToNames;
use IanRothmann\Ain\Handlers\Lib\AinTopicFromList;
use IanRothmann\Ain\Handlers\Lib\AinTopicProbe;
use IanRothmann\Ain\Handlers\Lib\AinTraitSummarizer;
use IanRothmann\Ain\Results\Lib\AinModelResult;


class AinServiceProviderHandler
{

    protected AinHandlerConfig $config;

    public function __construct(AinHandlerConfig $config)
    {
        $this->config=$config;
    }

    public function navigateQuestionChat():AinQuestionChatNavigator
    {
        return new AinQuestionChatNavigator($this->config);
    }

    public function summarizeConversation():AinSummarizeConversation
    {
        return new AinSummarizeConversation($this->config);
    }

    public function summarizeContext():AinSummarizeContext
    {
        return new AinSummarizeContext($this->config);
    }

    public function transcribe():AinAudioTranscriber
    {
        return new AinAudioTranscriber($this->config);
    }

    public function analyzeFace(): AinFaceDescriber
    {
        return new AinFaceDescriber($this->config);
    }

    public function analyzeImage(): AinImageDescriber
    {
        return new AinImageDescriber($this->config);
    }

    public function summarizeTraits():AinTraitSummarizer
    {
        return new AinTraitSummarizer($this->config);
    }

    public function scorePsychometric():AinPsychometricScorer
    {
        return new AinPsychometricScorer($this->config);
    }

    public function thematicAnalysis():AinThematicAnalysis
    {
        return new AinThematicAnalysis($this->config);
    }

    public function decideToIncludeInThematicAnalysis():AinThematicAnalysisInclusionDecision
    {
        return new AinThematicAnalysisInclusionDecision($this->config);
    }

    public function nameTopicsFromDescriptions():AinTopicDescriptionsToNames
    {
        return new AinTopicDescriptionsToNames($this->config);
    }

    public function generateInterviewQuestions():AinInterviewQuestionGenerator
    {
        return new AinInterviewQuestionGenerator($this->config);
    }

    public function summarizeTranscript():AinSummarizeTranscription
    {
        return new AinSummarizeTranscription($this->config);
    }

    public function summarizeStatements():AinMultiStatementSummarizer
    {
        return new AinMultiStatementSummarizer($this->config);
    }

    public function probeTopics():AinTopicProbe
    {
        return new AinTopicProbe($this->config);
    }

    public function describeSQL():AinSQLDescriber
    {
        return new AinSQLDescriber($this->config);
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
