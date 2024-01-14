<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinResumeAnalysisResult extends AinResult
{

    public function __construct($httpResultArray)
    {
        parent::__construct($httpResultArray);
    }

    public function isValidResume():?bool
    {
        return $this->data->get('is_resume');
    }

    public function getName():?string
    {
        return $this->data->get('name');
    }

    public function getEmail():?string
    {
        $value=$this->data->get('email');
        if(!$value || strtolower($value)=='none'){
            return null;
        }
        return $value;
    }

    public function getMobile():?string
    {
        $value=$this->data->get('mobile');
        if(!$value || strtolower($value)=='none'){
            return null;
        }
        return $value;
    }

    public function getOverview():?string
    {
        $value=$this->data->get('overview');
        if(!$value || strtolower($value)=='none'){
            return null;
        }
        return $value;
    }

    public function getSkills(): Collection
    {
        $value=$this->data->get('skills');
        return collect($value);
    }

    public function getQualifications(): Collection
    {
        $value=collect($this->data->get('qualifications'))->get('qualifications');
        return collect($value);
    }

    public function getJobHistory(): Collection
    {
        $value=collect($this->data->get('job_history'))->get('job_assignments');
        return collect($value);
    }

    public function getRating()
    {
        $value=$this->data->get('rating');
        if(!$value){
            return null;
        }
        return collect($value)->get('rating');
    }

    public function getRatingLabel() {
        $ratingNumber = $this->getRating();

        $ratings= [
            1 => "Poor Fit: Significant misalignment with job requirements.",
            2 => "Below Average Fit: Meets some qualifications, lacks key experiences or skills.",
            3 => "Average Fit: Meets essential qualifications, fair amount of relevant experience.",
            4 => "Strong Fit: Good alignment with job requirements, relevant achievements.",
            5 => "Exceptional Fit: Close match or surpassing all job requirements, exceptional skills and achievements."
        ];

        if ($ratingNumber !== null) {
            return $ratings[$ratingNumber] ?? "Unknown Rating";
        } else {
            return "No Rating Available";
        }
    }

    public function getRatingReason()
    {
        $value=$this->data->get('rating');
        if(!$value){
            return null;
        }
        return collect($value)->get('rating_reason');
    }
}
