<?php

namespace IanRothmann\Ain\Handlers;

use IanRothmann\Ain\Http\AinHttp;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;

abstract class AinHandler
{
    protected AinHttp $http;
    protected AinHandlerConfig $config;
    protected string $endpoint;

    public function __construct(AinHandlerConfig $config)
    {
        $this->config=$config;
        $this->http=$this->config->http;
    }

    abstract protected function getResult();
    abstract protected function getMocked();

    public function get()
    {
        if($this->config->mockType=='local'){
            return $this->getMocked();
        }else{
            return $this->getResult();
        }
    }

    protected function postText($text, $opts=[])
    {
        $opts=collect($opts);
        $opts['text']=$text;
        return $this->http->post($this->endpoint,$opts);
    }

    protected function postList($list, $opts=[])
    {
        $opts=collect($opts);
        $opts['list']=$list;
        return $this->http->post($this->endpoint,$opts->toArray());
    }

    //TODO: Investigate how this can work
   /* protected function postAsync($list, $opts=[])
    {
        $opts=collect($opts);

        $lists=collect(\Http::pool(function(Pool $pool) use($list,$opts){
            foreach ($list as $key => $item){
                $temp=$opts;
                $temp['list']=[$item];
                $this->http->post($this->endpoint,$opts,$pool,$key);
            }
        }))->map(function($response){
            return $response->throw(function($response, $e){
                return $e;
            })->json();
        })->map(function($item){
            return collect($item['data']['list'])->first();
        });

        return [
            'data'=>[
                'list'=>$lists
            ]
        ];

    }*/
}
