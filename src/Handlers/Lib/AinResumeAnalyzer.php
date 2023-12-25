<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinResumeAnalysisResult;
use IanRothmann\Ain\Results\Lib\AinRewriteResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinResumeAnalyzer extends AinHandler
{
    protected $inputText;
    protected $pdfUrl;
    protected $jobDescription;

    protected string $endpoint='nlp/resume_analysis';

    public function givenText($text)
    {
        $this->inputText=$text;
        return $this;
    }

    public function givenPdfUrl($url)
    {
        $this->pdfUrl=$url;
        return $this;
    }

    public function forJobDescription($jobDescription)
    {
        $this->jobDescription=$jobDescription;
        return $this;
    }

    /**
     * @return AinResumeAnalysisResult
     */
    public function getResult()
    {
        $params=[
            'job_description'=>$this->jobDescription,
        ];
        if($this->pdfUrl){
            $params['url']=$this->pdfUrl;
        }elseif($this->inputText){
            $params['text']=$this->inputText;
        }else{
            throw new \Exception("No input text or pdf url provided.");
        }
        $result=$this->post($params);

        return new AinResumeAnalysisResult($result);
    }

    /**
     * @return AinResumeAnalysisResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
            "name" => "John W. Smith",
            "email" => "jwsmith@colostate.edu",
            "mobile" => "None",
            "overview" => "John W. Smith is an experienced professional with a diverse background in early childhood development and the care of special needs children and adults. He has four years of experience in this field. In terms of adult care, John has determined work placements for 150 special needs adult clients, maintained client databases and records, coordinated client contact with healthcare professionals, and managed a team of 25 volunteer workers. In childcare, he has coordinated service assignments for part-time counselors and client families, oversaw daily activities and outing planning for clients, assisted families with researching financial assistance and healthcare, and assisted teachers with managing daily classroom activities. 

John's employment history includes roles as a Counseling Supervisor at The Wesley Center, a Client Specialist at Rainbow Special Care Center, and a Teacher's Assistant at Cowell Elementary. He holds a Bachelor of Science degree in Early Childhood Development, a Bachelor of Arts degree in Elementary Education, and has achieved a GPA of 3.4 on a 4.0 scale, with high marks in both Early Childhood Development and Elementary Education. He has also received recognition on the Dean's List and Chancellor's List.",
            "qualifications" => [
                "qualifications" => [
                    [
                        "qualification" => "BS in Early Childhood Development",
                        "institution" => "University of Arkansas at Little Rock",
                        "start_year" => 1998,
                        "obtained_year" => 1999
                    ],
                    [
                        "qualification" => "BA in Elementary Education",
                        "institution" => "University of Arkansas at Little Rock",
                        "start_year" => 1997,
                        "obtained_year" => 1998
                    ]
                ]
            ],
            "job_history" => [
                "job_assignments" => [
                    [
                        "start_year" => 1999,
                        "end_year" => 2002,
                        "organization" => "The Wesley Center",
                        "role" => "Counseling Supervisor"
                    ],
                    [
                        "start_year" => 1997,
                        "end_year" => 1999,
                        "organization" => "Rainbow Special Care Center",
                        "role" => "Client Specialist"
                    ],
                ]
            ],
            "rating" => [
                "rating" => 1,
                "rating_reason" => "John W. Smith's background is predominantly in early childhood development and care for special needs individuals. His experience and education do not align with the job description of a Laravel developer, which requires specific technical skills in software development."
            ],
            "skills" => [
                "Experience in early childhood development",
                "Background in the care of special needs children and adults",
                "Determining work placement for special needs adult clients",
            ]
        ]
        ];
        return new AinResumeAnalysisResult($result);
    }
}
