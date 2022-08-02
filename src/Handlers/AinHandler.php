<?php

namespace IanRothmann\Ain\Handlers;

use IanRothmann\Ain\Http\AinHttp;
use Illuminate\Http\Client\Pool;

abstract class AinHandler
{
    protected AinHttp $http;
    protected string $endpoint;

    public function __construct(AinHttp $ainHttp)
    {
        $this->http=$ainHttp;
    }

    abstract public function get();

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
    protected function postAsync($list, $opts=[])
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

    }
}
