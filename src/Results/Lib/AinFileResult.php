<?php

namespace IanRothmann\Ain\Results\Lib;

use IanRothmann\Ain\Results\AinResult;
use Illuminate\Support\Collection;

class AinFileResult
{
    protected $contents;

    public function __construct($contents)
    {
        $this->contents=$contents;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function toDisk($disk, $key)
    {
        return \Storage::disk($disk)->put($key, $this->contents);
    }

    public function stream()
    {
        return response()->streamDownload(function(){
            echo $this->contents;
        },'file.mp3');
    }
}
