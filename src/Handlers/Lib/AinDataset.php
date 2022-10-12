<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Http\AinHttp;
use IanRothmann\Ain\Results\Lib\AinDatasetResult;
use IanRothmann\Ain\Results\Lib\AinModelResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinDataset
{

    protected string $endpoint='datasets';

    protected AinHttp $http;
    protected AinHandlerConfig $config;

    public function __construct(AinHandlerConfig $config)
    {
        $this->config=$config;
        $this->http=$this->config->http;
    }

    public function upload($id,$url,$filename)
    {
        $opts=[
            'id'=>$id,
            'url'=>$url,
            'filename'=>$filename
        ];
        $result=$this->http->post($this->endpoint,$opts);
        return new AinDatasetResult($result);
    }
}
