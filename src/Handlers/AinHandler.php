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

    /**
     * Bypass any possible caching that might be configured
     */
    public function force()
    {
        $this->config->cacheType='none';
        $this->http->force();
        return $this;
    }

    public function httpGet($params=[])
    {
        return $this->http->get($this->endpoint,$params);
    }

    protected function post($opts=[])
    {
        $opts=collect($opts);
        return $this->http->post($this->endpoint,$opts);
    }

    protected function postText($text, $opts=[])
    {
        if(collect($text)->count()>1){
            return $this->postAsync($text, $opts);
        }else{
            $text=collect($text)->first();
        }
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

    protected function postAsync($list, $opts=[])
    {
        return collect($list)
            ->chunk(5)
            ->map(function($chunk,$chunkIndex) use ($opts){
                if($chunkIndex>=1){
                    sleep(1);
                }
                return $this->http->postAsync($this->endpoint,function ($url, $pool) use ($chunk, $opts) {
                    return $chunk->map(function($text, $key) use($pool, $opts, $url){
                        return $pool->as($key)
                            ->acceptJson()
                            ->withToken($this->http->key)
                            ->post($url, array_merge($opts, ['text'=>$text]));
                    })->toArray();
                });
            })->mapWithKeys(fn($response)=>$response)->map(function($response){
                return $response->json();
            });
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
