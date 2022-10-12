<?php

namespace IanRothmann\Ain\Handlers\Lib;

use IanRothmann\Ain\Handlers\AinHandler;
use IanRothmann\Ain\Handlers\AinHandlerConfig;
use IanRothmann\Ain\Http\AinHttp;
use IanRothmann\Ain\Results\Lib\AinAnalysisResult;
use IanRothmann\Ain\Results\Lib\AinDatasetResult;
use IanRothmann\Ain\Results\Lib\AinModelResult;
use IanRothmann\Ain\Results\Lib\AinSummaryResult;

class AinTopicAnalysis extends AinAnalysis
{

    public function __construct(AinHandlerConfig $config)
    {
        parent::__construct($config);
        $this->type='topic';
    }


    public function onDocumentIds($documentIds)
    {
        $this->additional=$documentIds;
        return $this;
    }

}