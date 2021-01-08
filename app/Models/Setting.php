<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;


    public static function getMore($menus)
    {
        $menus = !is_array($menus) ? implode(',', $menus) : $menus;
        $list = self::whereIn('field',$menus)->get(['field','value'])->toArray() ?: [];
        $option=[];
        foreach ($list as $menu => $value) {
            $option[$value['field']] = $value['value'];
        }
        return $option;
    }
}
