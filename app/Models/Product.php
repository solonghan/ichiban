<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'no',
        'name',
        'realname',
        'cover',
        'summary',
        'des',
        'stock',
        'total_quantity',
        'tags',
        'price',
        'status',
        'is_hot',
        'percentage',
        'status',
        'sort',
    ];

    public static function list($id, $locale){

    }

     /*
        tags 標籤關聯
    */
    // public function tags(){
    //     // belongsToMany(目標表單名稱，中介表單名稱，中介表單上參照自己的外鍵，中介表單上參照目標的外鍵，自己的關聯鍵，目標的關聯鍵)
    //     return $this->belongsToMany(Tags::class,  'tag_id', 'id', 'id')->where('type', 'product')->withPivot('click');
    
    // }

    //  //先預留
    // //  public function tags_array($tags){
    // //     // $data = array();
    // //     $data = explode(',', $tags);
    // //     // foreach ($tags_id as $tag) {
    // //     //     $tags=Tags::find($tag);
    // //     //     $data[]=$tags->id;
    // //     // }
    // //     return $data;
    // // }
    // public function tags_array(){
    //     $data = array();
    //     foreach ($this->tags as $t) {
    //         $data[] = $t->id;
    //     }
    //     return $data;
    // }
    //  //Update tags
    //  public function tags_refresh($new_arr){
    //     $this->tags()->detach($this->tags_array());
    //     if ($new_arr == null || $new_arr == '') return;
    //     foreach ($new_arr as $item) {
    //         $this->tags()->attach($item, ['type'=>'product']);
    //     }
    // }

    public static function data($id, $locale){
        // $data = DB::table(self::$_table.' as T')
        //             ->where(['T.lang'=>'tw', 'T.id'=>$id])
        //             ->whereNull('T.deleted_at');
        // if ($locale != 'tw') {
        //     $data->leftJoin(self::$_table.' as T2', function($join) use ($locale){
        //         $join->where('T2.lang', '=', $locale)
        //              ->on('T2.parent_id', '=', 'T.id');
        //     });
        //     $langs_select = '';
        //     foreach (self::$lang_fields as $f) {
        //         if ($langs_select != '') $langs_select .= ', ';
        //         $langs_select .= 'T2.'.$f;
        //     }
        //     if($langs_select != '') $data->select(DB::raw('T.*, '.$langs_select));
        // }
        // $data = $data->first();
        // $data->price = json_decode($data->price, true);
        // $p = Product::where(['id'=>$id])->with('tags')->with('classify')->with('brand')->with('function')->with('packages')->with('weights')->first();
        // $data->weight = $p->weights->title;
        // if ($locale == 'tw') {    
        //     $data->tags = $p->tags;
        //     $data->classify = $p->classify;
        //     $data->brand = $p->brand;
        //     $data->functional = $p->function;
        //     $data->package = $p->packages->title;
            
        // }else{
        //     $data->tags = Tags::lang_data($p->tags, $locale);
        //     $data->classify = ProductClassify::lang_data($p->classify, $locale);
        //     $data->brand = AgencyBrand::lang_data($p->brand, $locale);
        //     $data->functional = ProductFunction::lang_data($p->function, $locale);
        //     $data->package = ProductPackage::where(['lang'=>$locale, 'parent_id'=>$p->packages->id])->first()->title;
        // }

        // $data->files = Media::where(['media_type'=>'file', 'position'=>'product_files', 'relation_id'=>$id])->get();
        
        // $data->pics = Media::where(['media_type'=>'img', 'position'=>'product_pics', 'relation_id'=>$id])->get();
    
        // return $data;
    }
}
