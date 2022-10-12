<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Http\AinHttp;
use IanRothmann\Ain\Results\Lib\AinAnalysisResult;
use IanRothmann\Ain\Results\Lib\AinDatasetResult;
use IanRothmann\Ain\Results\Lib\AinModelResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinAnalysis
{

    protected string $endpoint='analyses/';

    protected AinHttp $http;
    protected AinHandlerConfig $config;

    protected $id, $webhook, $type,$dataset,$params,$additional;

    public function __construct(AinHandlerConfig $config)
    {
        $this->config=$config;
        $this->http=$this->config->http;
    }

    public function withIdentifier($id)
    {
        $this->id=$id;
        return $this;
    }

    public function receiveUpdatesAt($url)
    {
        $this->webhook=$url;
        return $this;
    }

    public function setAnalysisType($type)
    {
        $this->type=$type;
        return $this;
    }

    public function onDatasetId($dataset)
    {
        $this->dataset=$dataset;
        return $this;
    }

    public function withParameters($params)
    {
        $this->params=$params;
        return $this;
    }

    public function withAdditionalInput($input)
    {
        $this->additional=$input;
        return $this;
    }


    public function create()
    {
        $opts=[
            'id'=>$this->id,
            'params'=>$this->params,
            'webhook_url'=>$this->webhook,
            'type'=>$this->type,
            'dataset_external_id'=>$this->dataset,
            'additional_input'=>$this->additional
        ];
        $result=$this->http->post($this->endpoint,$opts);
        return new AinAnalysisResult($result);
    }

    public function get()
    {
        $result=$this->http->get($this->endpoint.$this->id);
        return new AinAnalysisResult($result);
    }
}
