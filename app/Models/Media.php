<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Media extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = []; 
    protected $fillable = [
        'id',
        'media_type',
        'position',
        'relation_id',
        'path',
        'realname',
        'showname',
        'remark'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->code = (string) Str::uuid();
        });
    }

    protected static function save_media($position, $relation_id, $insert_data, $delete_data = false){
        $idata = explode(";", $insert_data);
        array_pop($idata);

        foreach ($idata as $item) {
            Media::updateOrCreate(
                [
                    'path' =>  $item
                ],
                [
                    'path'        => $item,
                    'position'    => $position,
                    'relation_id' => $relation_id
                ]
            );
        }

        if ($delete_data !== false) {
            $ddata = explode(";", $delete_data);
            array_pop($ddata);
            foreach ($ddata as $item) {
                $should_deleted = Media::where('path', $item)->first();
                if ($should_deleted) $should_deleted->delete();
            }
        }
    }

    protected static function fetch_to_generate_template($field, $position, $relation_id, $media_type = 'img'){
        $value = "";    //concat with ; abc.jpg;cde.jpg;
        $html = "";     //use template_multi_img_item.blade
        $data = Media::where(['media_type'=>$media_type, 'position'=>$position, 'relation_id'=>$relation_id])->get();
        foreach ($data as $item) {
            if ($media_type == 'img') {
                $html .= view('mgr/items/template_multi_img_item', [
                    'field'	=>	$field,
                    'pic'	=>	$item->path
                ])->render();    
            }else if($media_type == 'file'){
                $html .= view('mgr/items/template_multi_file_item', [
                    'field'    => $field,
                    'file_id'  => $item->id,
                    'filename' => $item->realname,
                    'path'      => $item->path
                ])->render();
            }
            
            $value .= $item->path.";";
        }

        return [
            'value' =>  $value,
            'html'  =>  $html
        ];
    }
}
