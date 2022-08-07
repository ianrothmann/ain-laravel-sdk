<?php

namespace IanRothmann\Ain\Http;

use Illuminate\Support\Facades\Http;

class AinHttp
{
    protected $url;
    protected $version='v1';
    protected $key;
    protected $shouldMock=false;
    protected $shouldCache=true;

    /**
     * @param string $url
     * @param string $key
     */
    public function __construct($url, $key)
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

        $data=collect($data)->toArray();

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
