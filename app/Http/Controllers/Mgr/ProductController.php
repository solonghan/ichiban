<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use App\Models\Product;
use App\Models\ProductAwards;
use App\Models\ProductClassify;
use App\Models\AgencyBrand;
use App\Models\ProductFunction;
use App\Models\ProductPackage;
use App\Models\ProductManager;
use App\Models\ProductWeight;
use App\Models\Tags;
use App\Models\Dist;
use App\Models\City;
use App\Models\Media;
use App\Models\Member;

class ProductController extends Mgr
{
	private $param = [
		
		['商品編號',		'no',			'text',   TRUE, '', 2, 12, ''],
		['商品名稱',		'name',			'text',   TRUE, '', 5, 12, ''],
		['產品主圖',		'cover',		'image',   TRUE, '建議比例 3:2', 12, 12, '', [3/2]],
      
        // // ['產業類別',		'classify',	'select_multi',   TRUE, '', 4, 12, '', ['id','title']],
		['摘要',		'summary',		'textarea',   FALSE, '', 6, 12, ''],
		['描述',		'des',			'editor',   FALSE, '', 6, 12, '', [200]],
		['庫存',		'stock',		'number',   TRUE, '', 2, 12, ''],
		['總數量',	 'total_quantity',		'number',   FALSE, '', 2, 12, ''],
		
		// // ['下單方式',		'order_type',		'select',		FALSE, '', 3, 12, '', ['id', 'text']],
        // // ['專人詢價自定義提示','custom_hint',	'text',   FALSE, '', 9, 12, ''],
		
		['標籤',			'tags',			'select_multi',		FALSE, '', 6, 12, '', ['id', 'title']],
		
		// // ['其它產品圖',		'pics',			'img_multi',   FALSE, '建議比例 3:2', 12, 12, '', [3/2]],

		// ['商品獎賞',		'files',		'file',   FALSE, '', 12, 12, ''],
		// ['建立時間', '', ''],
		// ['動作', '', '']
		
		// ['商品規格表',		'files',		'file',   FALSE, '', 12, 12, ''],
	];

	private $th_title = [
		['#', '', ''],
		['商品編號/名稱', '155px', ''],
		// ['商品名稱', '', ''],
		['主圖', '', ''],
		['摘要', '100px', ''],
		['價錢', '100px', ''],
		// ['描述', '125px', ''],
		['庫存/總數量', '100px', ''],
		['標籤', '100px', ''],
		['大賞機率', '100px', ''],
		['熱門商品', '100px', ''],
		['狀態', '100px', ''],
		['建立時間', '100px', ''],
		['動作', '100px', ''],
	];
	public function __construct()
	{
		parent::__construct();
		$this->data['active'] = 'PRODUCT';
		$this->data['sub_active'] = 'PRODUCT';	
		// $this->data['select']['city'] = City::get()->toArray();
		// $this->data['select']['tags'] = Tags::get()->toArray();
       
	}
        
	public function index(Request $request)
	{
		// print 123;exit;
		$this->data['controller'] = 'product';
		$this->data['title'] = "一番賞管理";
		$this->data['parent'] = "";
		$this->data['parent_url'] = "";

		$this->data['th_title'] = $this->th_title_field($this->th_title);
		$this->data['btns'] = [
			['<i class="ri-add-fill"></i>', '新增產品', route('mgr.product.add'), 'primary']
		];

		// print_r($data);exit;	
       
		return view('mgr/template_list_ajax', $this->data);
		// return view('mgr/template_list', $this->data);
	}

	public function data(Request $request){
		// print 123;exit;
		$page   = $request->post('page')??'';
		$search = $request->post('search')??'';
		$status = $request->post('status')??'normal';
		$page_count = $request->post('page_count')??$this->page_count;
		// $role = Auth::guard('mgr')->user()->role;
		// print_r($role);exit;
		$html = "";
		// $this->data['template_item'] = 'mgr/items/template_item';

        $data = array();

		$data = Product::where("deleted_at", NULL);
		$total = $data->count();
        $total_page = ($page_count!='all')?(($total % $page_count == 0) ? floor(($total)/$page_count) : floor(($total)/$page_count) + 1):'1';
		// print_r($page_count);exit;
		
		$data = $data->take($page_count)->skip( ($page - 1) * $page_count )->get(); //先隱藏
		// print_r($data);exit;

        $this->data['data'] = array();
        foreach ($data as $item) {
			// $status = '
			// 		<div class="form-check form-switch">
			// 			<input class="form-check-input switch_toggle" data-id="'.$item->id.'
			// 			" type="checkbox" role="switch" '.(($item->status=='on')?'checked':'').'>
			// 		</div>
			// 	';
			
			
			
            $obj = array();
			// print_r($obj);exit;
            $obj[] = $item->id;
			// $obj[] = $item->role;
			// if($item->role == 'tourists'){
			// 	$obj[] = '遊客';
			// }else if($item->role == 'islanders') {
			// 	$obj[] = '島民';
			// }else{
			// 	$obj[] = '未設定';
			// }

			$obj[] = $item->no."<br>".$item->name;
			// $img_url = env('APP_URL').'/app'.Storage::url($firstCover);images
			// $obj[] = '<img src="'.env('APP_URL').'/images/'.$item->cover.'" class="img-thumbnail" style="width:150px;">';
			$obj[] = '<img src="'.env('APP_URL').Storage::url($item->cover).'" class="img-thumbnail" style="width:120px;">';
            $obj[] = $item->summary;
			$obj[] = $item->price;
			$obj[] = $item->stock.' / '.$item->total_quantity;
			
			$tags=Tags::list($item->tags);
			$obj[] = $tags;

			$obj[] = $item->percentage.'%';
			

			
			// $obj[] = '獎賞管理按鈕';

			if($item->is_hot==1){
				$is_hot='是';
			}else{
				$is_hot='否';
			}
			$obj[] = $is_hot;

			if($item->status=='on'){
				$status='啟用';
			}else{
				$status='關閉';
			}
            $obj[] = $status;
            $obj[] = $item->created_at;

			$priv_view =FALSE;
			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();
			$other_btns[] = [
				"class"  => "btn-success",
				// "action" => "location.href='".route('mgr.users.product', ['user_id'=>$item->id])."'",
				"action" => "location.href='".route('mgr.product.awards', ['product_id'=>$item->id])."'",
				// "action" => "location.href='".route('mgr.product_awards')."'",
				"text"   => "獎賞列表"
			];
			// print_r($obj);exit;

			$html .= view('mgr/items/template_item', [
				'item'      => array(
					"id"         => $item->id,
					"data"       => $obj,
					"other_btns" => $other_btns,
					"priv_view"  => $priv_view ,
					"priv_edit"  => $priv_edit,
					"priv_del"   => $priv_del
				),
				'th_title'  => $this->th_title_field($this->th_title)
			])->render();
        }

		$this->output(TRUE, 'success', array(
			'html'	=>	$html,
			'page'       => $page,
			'total_page' => $total_page,
		));
	}
	public function awards_data(Request $request, $product_id = false){
		$page   = $request->post('page')??'';
		$search = $request->post('search')??'';
		$status = $request->post('status')??'normal';
		$html = "";

		$data = ProductAwards::where("deleted_at", NULL)
							->where("product_id", $product_id)	
							->get();

		
        $this->data['data'] = array();
        foreach ($data as $item) {
			// $status = '
			// 		<div class="form-check form-switch">
			// 			<input class="form-check-input switch_toggle" data-id="'.$item->id.'
			// 			" type="checkbox" role="switch" '.(($item->status=='on')?'checked':'').'>
			// 		</div>
			// 	';
			
			
			
            $obj = array();
			// print_r($obj);exit;
            $obj[] = $item->id;
			$obj[] = $item->awards_no;
			$obj[] = $item->awards_name;
			$obj[] = '<img src="'.env('APP_URL').Storage::url($item->awards_cover).'" class="img-thumbnail" style="width:120px;">';
			$obj[] = $item->level;
			$obj[] = $item->awards_summary;
			$obj[] = $item->awards_stock.' / '.$item->awards_total_quantity;
			// $obj[] = $item->role;
			// if($item->role == 'tourists'){
			// 	$obj[] = '遊客';
			// }else if($item->role == 'islanders') {
			// 	$obj[] = '島民';
			// }else{
			// 	$obj[] = '未設定';
			// }

			// $obj[] = $item->no."<br>".$item->name;

			if($item->status=='on'){
				$status='啟用';
			}else{
				$status='關閉';
			}
            $obj[] = $status;
            $obj[] = $item->created_at;

			$priv_view =FALSE;
			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();

			$html .= view('mgr/items/template_item', [
				'item'      => array(
					"id"         => $item->id,
					"data"       => $obj,
					"other_btns" => $other_btns,
					"priv_view"  => $priv_view ,
					"priv_edit"  => $priv_edit,
					"priv_del"   => $priv_del
				),
				'th_title'  => $this->th_title_field($this->th_title)
			])->render();
        }

		$this->output(TRUE, 'success', array(
			'html'	=>	$html
		));
		print_r($data);exit;

	}
	// 商品獎賞
	public function awards(Request $request, $product_id = false){

		// print_r($product_id);exit;
		if ($product_id != FALSE) {
			
			$this->data['controller'] = 'product';
			$this->data['tab'] = 'awards_data/'.$product_id;
			$this->data['title'] = " 獎賞管理";
			$this->data['parent'] = "";
			$this->data['parent_url'] = "";
			$this->data['th_title'] = $this->th_title_field(
				[
					['#', '', ''],
					
					['獎賞編號', '', ''],
					['獎賞名稱', '', ''],
					['獎賞主圖', '', ''],
					['獎賞等級', '', ''],
					['摘要', '100px', ''],
			
					['庫存/數量', '', ''],
					['狀態', '', ''],
					['建立時間', '', ''],
					['動作', '', '']
				]
			);
			$this->data['btns'] = [
				['<i class="ri-add-fill"></i>', '新增獎賞', route('mgr.product.add'), 'primary']
			];

			$this->data['template_item'] = 'mgr/items/template_item';

			// $data = UserProduct::orderBy('id','desc')->where(['user_id'=>$user_id])->with('user')->with('product')->get()->unique('product_id');
			//->groupBy('product_id')
			
			// return view('mgr/template_list_view_ajax', $this->data);
			return view('mgr/template_list_ajax', $this->data);
			return view('mgr/template_list', $this->data);
		}else{
			// print 888;exit;
		}

	}

	public function check(Request $request, $id = false){

	}

	public function add(Request $request){
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);
			$formdata['tags'] = implode(",", $request->post('tags'));
			// print_r($formdata);exit;
			$res = Product::updateOrCreate($formdata);

			if ($res) {
				// if ($request->post("manager") > 0) $res->manager_refresh([$request->post("manager")]);
				
				// $product_id = $res->id;
				// Media::save_media('product_cover', $product_id, $formdata['tw']['cover'].";");
				// Media::save_media('product_pics', $product_id, $request->post('pics'), $request->post('picdeleted_pics'));
				// Media::save_media('product_files', $product_id, $request->post('files'), $request->post('filesdeleted_files'));

				//更新多對多的表
				// $res->tags_refresh($request->post('tags'));
				// $res->classify_refresh($request->post('classify'));
				// $res->brand_refresh($request->post('brand'));
				// $res->function_refresh($request->post('function'));

				// $formdata['en']['parent_id'] = $product_id;
				// $formdata['en']['lang'] = 'en';
				// Product::updateOrCreate($formdata['en']);

				$this->js_output_and_redirect('新增成功', 'mgr.product');
			} else {
				$this->js_output_and_back('新增發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "新增產品";
		$this->data['parent'] = "產品管理";
		$this->data['parent_url'] = route('mgr.product');
		$this->data['action'] = route('mgr.product.add');
		$this->data['submit_txt'] = '確認新增';

		$this->data['params'] = $this->generate_param_to_view($this->param);
		$this->data['select']['tags'] = Tags::where('status', 'on')->get()->toArray();
		// $this->data['params'][array_search('unit', array_column($this->data['params'], 'field'))]['value'] = 10;
		// $this->data['params'][array_search('price_new_percent', array_column($this->data['params'], 'field'))]['value'] = 1;
		// $this->data['params'][array_search('price_old_percent', array_column($this->data['params'], 'field'))]['value'] = 1;

		// $this->data['custom_js'] = view('mgr/custom_js/product_calc', [])->render();
		
		return view('mgr/template_form', $this->data);
	}

	public function edit(Request $request, $id){
		// print 777;exit;
		// $data = Product::where('id', $id)->with('tags')->first();
		$data = Product::find($id);
		// print_r($data);exit;
		
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);
		
			$formdata['tags'] = implode(",", $request->post('tags'));

			// print_r($formdata);exit;
		
			$res = Product::updateOrCreate(['id'=>$id], $formdata);
			// Product::updateOrCreate(['parent_id'=>$id, 'lang'=>'en'], $formdata['en']);
			if ($res) {
				// //更新圖、檔
				// Media::save_media('product_cover', $id, $formdata['tw']['cover'].";");
				// Media::save_media('product_pics', $id, $request->post('pics'), $request->post('picdeleted_pics'));
				// Media::save_media('product_files', $id, $request->post('files'), $request->post('filesdeleted_files'));
				
				$this->js_output_and_redirect('編輯成功', 'mgr.product');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "編輯 ";
		// $this->data['title'] = "編輯 ".$data->title;
		$this->data['parent'] = "產品管理";
		$this->data['parent_url'] = route('mgr.product');
		$this->data['action'] = route('mgr.product', ['id'=>$id]);
		$this->data['submit_txt'] = '確認編輯';
		// $this->data['id'] = $id;

	
		// print_r($tags);exit;
		// $classify = $data->classify_array();
		// $brand = $data->brand_array();
		// $function = $data->function_array();

		// $data = $data->toArray();
		// $pics = Media::fetch_to_generate_template('pics', 'product_pics', $id);
		// $data['pics'] = $pics['value'];
		// $files = Media::fetch_to_generate_template('files', 'product_files', $id, 'file');
		// $data['files'] = $files['value'];
		// //Media: multi img, files
		// $this->data['html']['pics'] = $pics['html'];
		// $this->data['html']['files'] = $files['html'];

		//tags  先寫這
		$data['tags']  = explode(',', $data->tags);
		// 有需要再寫進這
		// $data['tags'] = $data->tags_array($data->tags);
		// print_r($data['tags'] );exit;

		$this->data['params'] = $this->generate_param_to_view($this->param, $data);
		// $this->data['custom_js'] = view('mgr/custom_js/product_calc', [])->render();
		$this->data['select']['tags'] = Tags::where('status', 'on')->get()->toArray();
		
		// print_r($this->data);exit;
		
		return view('mgr/template_form', $this->data);
	}

    public function del(Request $request){
        $id = $request->post('id');
        
        $obj = Product::find($id);
        if ($obj->delete()) {
            $this->output(TRUE, "Delete success");
        }else{
            $this->output(FALSE, "Delete fail");
        }
    }

	public function switch_toggle(Request $request){
		// print 123;exit;
		if ($request->isMethod('post')) {
			
			$id     = $request->post('id');
			$status = $request->post('status');
			// print_r($id);exit;
			if (Member::where(['id'=>$id])->update(['status'=>$status])) {
				$this->output(TRUE, "success");
			}else{
				$this->output(FALSE, "fail");
			}
		}
	}


	/*
		前台頁面
	*/
	public function list(Request $request){

	}
}
