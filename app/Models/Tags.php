<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tags extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        // 'lang',
        // 'parent_id',
        'title',
        'status'
    ];

    public static function list($data){
        $tags = Tags::where('status', 'on')->get()->keyBy('id')->toArray();
        $str = '';
        foreach (explode(',', $data) as $t) {
            $title = $tags[$t]['title']??'';
            if ($title == '') continue;

            if ($str != '') $str .= "&nbsp;&nbsp;";
                $str .= '<span class="badge  bg-primary">'.$title.'</span>';
        }
  
        return $str;

    }
}
