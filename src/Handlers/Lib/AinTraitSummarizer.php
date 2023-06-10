<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinTraitSummarizer extends AinHandler
{
    protected $statements;
    protected $scores;
    protected $context;
    protected $instruction;
    protected $gender;
    protected $name;
    protected $personal=true;
    protected $traitsType=null;
    protected $traitsDescription=null;
    protected $targetGradeLevel=null;

    protected string $endpoint='nlp/trait_summary';

    public function __construct(AinHandlerConfig $config)
    {
        parent::__construct($config);
        $this->statements=collect();
    }


    public function addStatement($ref, $text, $lowScore=null, $highScore=null, $highInclusive=false)
    {
        $this->statements->push([
            'ref'=>$ref,
            'text'=>$text,
            'low_score'=>$lowScore,
            'high_score'=>$highScore,
            'high_score_inclusive'=>$highInclusive
        ]);
        return $this;
    }

    public function withScores($scoreArrayKeyedByRef)
    {
        $this->scores=collect($scoreArrayKeyedByRef);
        return $this;
    }

    public function withoutScores()
    {
        $this->statements->transform(function($statement){
            $statement['low_score']=1;
            $statement['high_score']=1;
            $statement['high_score_inclusive']=true;
            return $statement;
        });

        $this->scores=$this->statements->keyBy('ref')
            ->map(function($statement){
                return $statement['low_score'];
            });
    }

    public function withSpecificContext($context)
    {
        $this->context=$context;
        return $this;
    }

    public function withSpecificInstruction($instruction)
    {
        $this->instruction=$instruction;
        return $this;
    }

    public function forName($name)
    {
        $this->name=$name;
        return $this;
    }

    public function forGender($gender)
    {
        $this->gender=$gender;
        return $this;
    }

    public function isPersonal($personal=true)
    {
        $this->personal=$personal;
        return $this;
    }

    public function describeTraitsBy($type, $description)
    {
        $this->traitsType=$type;
        $this->traitsDescription=$description;
        return $this;
    }

    public function languageOnGradeLevel($gradeLevel)
    {
        $this->targetGradeLevel=$gradeLevel;
        return $this;
    }

    /**
     * @return AinSummaryResult
     */
    public function getResult()
    {
        $result=$this->postList($this->statements,[
            'context'=>$this->context,
            'instruction'=>$this->instruction,
            'name'=>$this->name,
            'gender'=>$this->gender,
            'grade_level'=>$this->targetGradeLevel,
            'traits_type'=>$this->traitsType,
            'traits_description'=>$this->traitsDescription,
            'personal'=>$this->personal,
            'scores'=>$this->scores->toArray(),
        ]);
        return new AinSummaryResult($result);
    }

    /**
     * @return AinSummaryResult
     */
    public function getMocked()
    {
        $result=[
            'data'=>[
                'text'=>$this->statements,
                'original'=>null,
            ]
        ];
        return new AinSummaryResult($result);
    }
}
