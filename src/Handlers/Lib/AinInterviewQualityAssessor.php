<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\Lib\Traits\LanguageSupport;
use IanRothmann\Ain\Results\Lib\AinJsonResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;
use IanRothmann\Ain\Results\Lib\AinTableResult;

class AinInterviewQualityAssessor extends AinHandler
{
    protected $questions = [];
    protected $requirements;

    protected string $endpoint='nlp/interview_quality';

    public function addQuestion($question, $answerFormat, $expectedResponse, $options = [])
    {
        $this->questions[]=[
            'expected_response' => $expectedResponse,
            'question'=>$question,
            'answer_format'=>$answerFormat,
            'options'=>$options,
        ];
        return $this;
    }
    public function givenRequirements($text)
    {
        $this->requirements=$text;
        return $this;
    }

    /**
     * @return AinJsonResult
     */
    public function getResult()
    {
        $result=$this->post([
            'questions'=>$this->questions,
            'requirements'=>$this->requirements,
        ]);
        return new AinJsonResult($result);
    }

    /**
     * @return AinJsonResult
     */
    public function getMocked()
    {
        $interview_assessment = [
            "overall_rating" => "4",
            "overall_comments" => "The interview covers most of the requirements well, particularly in assessing the candidate's qualifications, experience, and design approach. However, it lacks depth in some areas such as project management abilities, knowledge of sustainability principles, and proficiency with CAD software and other design tools.",
            "general_suggestions" => "Consider adding questions that evaluate the candidate’s ability to use CAD software and other tools effectively, their understanding of sustainability in landscape architecture, and their project management skills. Also, given the asynchronous nature of the interview via chatbot, ensure the questions are clear and the expected responses are concise enough for this format.",
            "additional_questions" => [
                [
                    "question" => "Can you provide an example that demonstrates your proficiency in using CAD software for a landscape architecture project?",
                    "response_format" => "audio",
                    "options" => [],
                    "expected_response" => "The candidate should describe their experience using CAD software, possibly detailing a specific project, the tools they used, and how they applied them to achieve their design goals."
                ],
                [
                    "question" => "How do you ensure that your landscape designs adhere to environmental and sustainability principles?",
                    "response_format" => "audio",
                    "options" => [],
                    "expected_response" => "The candidate should explain their understanding of environmental practices and how they integrate sustainability into their projects."
                ],
                [
                    "question" => "Describe a challenging project and how you managed it from design through to implementation?",
                    "response_format" => "audio",
                    "options" => [],
                    "expected_response" => "The candidate should discuss a challenging project, detailing how they managed the project, overcame obstacles, coordinated with engineers and other professionals, and ensured the project was completed to the client's satisfaction."
                ]
            ],
            "expected_response_comment" => "The expected responses align with the interview requirements, but they could be more specific in terms of the candidate's knowledge and use of design tools, as well as their approach to sustainability and project management.",
            "response_type_review" => "The response types chosen are appropriate for the questions. Text responses are used for straightforward, factual information, while audio responses allow for more detailed explanations. However, for the 'Describe a recent project' and 'Describe your experience' questions, candidates may also benefit from the option to submit images or files of their work to supplement their audio responses."
        ];

        $result=[
            'data'=>$interview_assessment
        ];
        return new AinJsonResult($result);
    }
}
