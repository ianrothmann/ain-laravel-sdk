<?php

namespace IanRothmann\Ain\Results;

abstract class AinResult
{
    protected $data;
    protected $tokens=0;
    protected $multipleResults=false;

    public function __construct($httpResultArray)
    {
        $httpResultArray=collect($httpResultArray);

        if($httpResultArray->has('error')){
            throw new \Exception($httpResultArray->get('error'));
        }

        if(!$httpResultArray->has('data')){
            $this->data=$httpResultArray->map(function($data){
                return collect(collect($data)->get('data'));
            });
            $this->multipleResults=true;
            $this->tokens=$this->data->sum('tokens');
        }else{
            $this->data=collect($httpResultArray->get('data'));
        }

        $this->tokens=$this->data->get('tokens',0);
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    public function dd()
    {
        dd($this);
    }

    public function mapResult($keyToMap)
    {
        return $this->data->mapWithKeys(function($item, $key) use($keyToMap){
            $item=collect($item);
            if(!$item->get($keyToMap)){
                $item=collect(collect($item)->first());
            }
            return [$key => $item->get($keyToMap)];
        });
    }

}
