<?php

namespace IanRothmann\Ain\Http;

use Illuminate\Support\Facades\Http;

class AinHttp
{
    protected string $url;
    protected string $version='v1';
    protected string $key;
    protected $shouldMock=false;
    protected $shouldCache=true;

    /**
     * @param string $url
     * @param string $key
     */
    public function __construct(string $url, string $key)
    {
        $this->url = $url;
        $this->key = $key;
    }

    public function force()
    {
        $this->shouldCache=false;
        return $this;
    }

    public function mock()
    {
        $this->shouldMock=true;
        return $this;
    }

    public function post($endpoint, $data, $pool=null, $poolId=null)
    {
        $url=$this->url.'/api/'.$this->version.'/'.$endpoint;
        if($this->shouldMock){
            $data['mock']=1;
        }

        if(!$this->shouldCache){
            $data['force']=1;
        }

        if($pool){
            return $pool->as($poolId)->withToken($this->key)
                ->acceptJson()
                ->timeout(180)
                ->retry(3,500)
                ->post($url,$data)
             /*   ->throw(function($response, $e){
                    return $e;
                })->json()*/;
        }else{
            return Http::withToken($this->key)
                ->acceptJson()
                ->timeout(180)
                ->retry(3,500)
                ->post($url,$data)
                ->throw(function($response, $e){
                    return $e;
                })->json();
        }


    }

}
