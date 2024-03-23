<?php

namespace IanRothmann\Ain\ServiceProviders;

use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Handlers\Lib\AinAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinAudioPronunciation;
use IanRothmann\Ain\Handlers\Lib\AinAudioSRTTranscriber;
use IanRothmann\Ain\Handlers\Lib\AinAudioTopicExtractor;
use IanRothmann\Ain\Handlers\Lib\AinAudioTranscriber;
use IanRothmann\Ain\Handlers\Lib\AinAudioUnderstandingRater;
use IanRothmann\Ain\Handlers\Lib\AinCandidateStrengthsShortcomingsGenerator;
use IanRothmann\Ain\Handlers\Lib\AinDataset;
use IanRothmann\Ain\Handlers\Lib\AinEmbeddings;
use IanRothmann\Ain\Handlers\Lib\AinFaceDescriber;
use IanRothmann\Ain\Handlers\Lib\AinIdealResponseCandidateSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinIdealResponseGenerator;
use IanRothmann\Ain\Handlers\Lib\AinIdealResponseMultipleGenerator;
use IanRothmann\Ain\Handlers\Lib\AinIdealResponseRater;
use IanRothmann\Ain\Handlers\Lib\AinImageDescriber;
use IanRothmann\Ain\Handlers\Lib\AinInterviewQualityAssessor;
use IanRothmann\Ain\Handlers\Lib\AinInterviewQuestionGenerator;
use IanRothmann\Ain\Handlers\Lib\AinInterviewQuestionProber;
use IanRothmann\Ain\Handlers\Lib\AinInterviewReportWriter;
use IanRothmann\Ain\Handlers\Lib\AinJobDescriptionSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinJsonGenerator;
use IanRothmann\Ain\Handlers\Lib\AinKeywordExtractor;
use IanRothmann\Ain\Handlers\Lib\AinModel;
use IanRothmann\Ain\Handlers\Lib\AinMultiStatementSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinNameSurnameSplitter;
use IanRothmann\Ain\Handlers\Lib\AinPsychometricScorer;
use IanRothmann\Ain\Handlers\Lib\AinQuestionAnswering;
use IanRothmann\Ain\Handlers\Lib\AinQuestionChatNavigator;
use IanRothmann\Ain\Handlers\Lib\AinRatingClassifier;
use IanRothmann\Ain\Handlers\Lib\AinRatingModelBuilder;
use IanRothmann\Ain\Handlers\Lib\AinResponseRaterToMultipleScoringGuides;
use IanRothmann\Ain\Handlers\Lib\AinResponseRaterToScoringGuide;
use IanRothmann\Ain\Handlers\Lib\AinResumeAnalyzer;
use IanRothmann\Ain\Handlers\Lib\AinRewriter;
use IanRothmann\Ain\Handlers\Lib\AinSentimentClassifier;
use IanRothmann\Ain\Handlers\Lib\AinSlugGenerator;
use IanRothmann\Ain\Handlers\Lib\AinSpeechGenerator;
use IanRothmann\Ain\Handlers\Lib\AinSpellingGrammar;
use IanRothmann\Ain\Handlers\Lib\AinSQLDescriber;
use IanRothmann\Ain\Handlers\Lib\AinSummarizeContext;
use IanRothmann\Ain\Handlers\Lib\AinSummarizeConversation;
use IanRothmann\Ain\Handlers\Lib\AinSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinSummarizeTranscription;
use IanRothmann\Ain\Handlers\Lib\AinTextGenerator;
use IanRothmann\Ain\Handlers\Lib\AinThematicAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinThematicAnalysisInclusionDecision;
use IanRothmann\Ain\Handlers\Lib\AinThemeExtractor;
use IanRothmann\Ain\Handlers\Lib\AinTLdr;
use IanRothmann\Ain\Handlers\Lib\AinTopicAnalysis;
use IanRothmann\Ain\Handlers\Lib\AinTopicDescriptionsToNames;
use IanRothmann\Ain\Handlers\Lib\AinTopicFromList;
use IanRothmann\Ain\Handlers\Lib\AinTopicProbe;
use IanRothmann\Ain\Handlers\Lib\AinTraitSummarizer;
use IanRothmann\Ain\Handlers\Lib\AinTranslator;
use IanRothmann\Ain\Handlers\Lib\AinWritingQualityRater;
use IanRothmann\Ain\Results\Lib\AinModelResult;


class AinServiceProviderHandler
{
    protected AinHandlerConfig $config;

    public function __construct(AinHandlerConfig $config)
    {
        $this->config=$config;
    }

    public function generateSpeech():AinSpeechGenerator
    {
        return new AinSpeechGenerator($this->config);
    }

    public function rateMultipleWithScoringGuides():AinResponseRaterToMultipleScoringGuides
    {
        return new AinResponseRaterToMultipleScoringGuides($this->config);
    }

    public function rateWithScoringGuide():AinResponseRaterToScoringGuide
    {
        return new AinResponseRaterToScoringGuide($this->config);
    }

    public function generateJson():AinJsonGenerator
    {
        return new AinJsonGenerator($this->config);
    }

    public function assessInterviewQuality():AinInterviewQualityAssessor
    {
        return new AinInterviewQualityAssessor($this->config);
    }

    public function probeInterviewQuestion():AinInterviewQuestionProber
    {
        return new AinInterviewQuestionProber($this->config);
    }

    public function analyzeResume():AinResumeAnalyzer
    {
        return new AinResumeAnalyzer($this->config);
    }


    public function translate():AinTranslator
    {
        return new AinTranslator($this->config);
    }

    public function generateStrengthsAndShortcomings():AinCandidateStrengthsShortcomingsGenerator
    {
        return new AinCandidateStrengthsShortcomingsGenerator($this->config);
    }

    public function summarizeJobDescriptionForInterview():AinJobDescriptionSummarizer
    {
        return new AinJobDescriptionSummarizer($this->config);
    }

    public function idealResponseCandidateSummary():AinIdealResponseCandidateSummarizer
    {
        return new AinIdealResponseCandidateSummarizer($this->config);
    }

    public function rateIdealResponse():AinIdealResponseRater
    {
        return new AinIdealResponseRater($this->config);
    }

    public function generateIdealResponse():AinIdealResponseGenerator
    {
        return new AinIdealResponseGenerator($this->config);
    }

    public function generateIdealResponses():AinIdealResponseMultipleGenerator
    {
        return new AinIdealResponseMultipleGenerator($this->config);
    }


    public function rateWritingQuality():AinWritingQualityRater
    {
        return new AinWritingQualityRater($this->config);
    }

    public function rateAudioUnderstanding():AinAudioUnderstandingRater
    {
        return new AinAudioUnderstandingRater($this->config);
    }

    public function checkPronunciation(): AinAudioPronunciation
    {
        return new AinAudioPronunciation($this->config);
    }

    public function generateSlug():AinSlugGenerator
    {
        return new AinSlugGenerator($this->config);
    }


    public function generateText():AinTextGenerator
    {
        return new AinTextGenerator($this->config);
    }

    public function writeInterviewReport():AinInterviewReportWriter
    {
        return new AinInterviewReportWriter($this->config);
    }

    public function extractTopicsFromAudio():AinAudioTopicExtractor
    {
        return new AinAudioTopicExtractor($this->config);
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

    public function transcribeToSRT():AinAudioSRTTranscriber
    {
        return new AinAudioSRTTranscriber($this->config);
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
