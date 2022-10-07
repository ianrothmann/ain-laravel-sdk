<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Results\Lib\AinModelResult;

class AinRatingModelBuilder extends AinHandler
{
    protected string $endpoint = 'classification/judge/train';

    protected $fileUrl;
    protected $name;
    protected $question;
    protected $personIdentifier=null;
    protected $verb=null;
    protected $unclear;
    protected $ratingCategories;
    protected $isNumeric = true;
    protected $topLabel, $bottomLabel;

    public function forDataUrl($url)
    {
        $this->fileUrl=$url;
        return $this;
    }

    public function identifiedBy($name)
    {
        $this->name = $name;
        return $this;
    }

    public function forQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    public function withPersonIdentifier($personIdentifier)
    {
        $this->personIdentifier = $personIdentifier;
        return $this;
    }

    public function withVerb($verb)
    {
        $this->verb = $verb;
        return $this;
    }

    public function unclearIndicator($unclear)
    {
        $this->unclear = $unclear;
        return $this;
    }

    public function withRatingCategories($ratingCategories)
    {
        $this->ratingCategories = collect($ratingCategories);
        return $this;
    }

    public function ratingsAreNumeric($bottomLabel = null, $topLabel = null)
    {
        $this->isNumeric = true;
        $this->bottomLabel = $bottomLabel;
        $this->topLabel = $topLabel;
        $this->ratingCategories->mapWithKeys(fn($category) => [$category => $category]);
        return $this;
    }

    protected function validate()
    {
        if(!$this->question){
            throw new \Exception('Question is required');
        }

        if(collect($this->ratingCategories)->isEmpty()){
            throw new \Exception('Rating categories are required');
        }

        if(!$this->fileUrl){
            throw new \Exception('No file url provided');
        }
        $headers=get_headers($this->fileUrl);
        if(stripos($headers[0],"200 OK")===false){
            throw new \Exception('File url is not valid');
        }

    }

    protected function getResult()
    {
        $this->validate();

        $result=$this->post([
            'name'=>$this->name,
            'question'=>$this->question,
            'person_identifier'=>$this->personIdentifier,
            'verb'=>$this->verb,
            'unclear'=>$this->unclear,
            'rating_categories'=>$this->ratingCategories,
            'is_numeric'=>$this->isNumeric,
            'top_label'=>$this->topLabel,
            'bottom_label'=>$this->bottomLabel,
            'file'=>$this->fileUrl,
        ]);
        return new AinModelResult($result);
    }

    protected function getMocked()
    {
        $result=[
            'data'=>[
                'name'=>'Model name',
                'state'=>'New',
                'params'=>[],
            ]
        ];
        return new AinModelResult($result);
    }
}