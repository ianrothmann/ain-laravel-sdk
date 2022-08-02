<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 2017/11/23
 * Time: 5:13 PM
 */

namespace IanRothmann\Ain\Facades;


use Illuminate\Support\Facades\Facade;

class AinFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'Ain'; }
}
