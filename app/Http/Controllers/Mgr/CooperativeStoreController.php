<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;
use App\Models\CooperativeStore;
use Illuminate\Support\Facades\Storage;
use App\Models\Tags;
use App\Models\Media;

class CooperativeStoreController extends Mgr
{
    
	public function __construct()
	{
		parent::__construct();
		$this->data['active'] = 'CooperativeStore';
		$this->data['sub_active'] = 'CooperativeStore';

        // $this->data['select']['category'] = Faq::category();
		// $this->data['select']['tags'] = Tags::where('lang','tw')->get()->toArray();
	}

	private $param = [
		['店家名',       'name',      'text',   TRUE, '', 6, 12, '',[200]],
		['排序',	    'sort',     'number', FALSE, 0, 3, 12, '', [200]],
		['封面圖',	    'logo',       'image',   TRUE, '比例 360:230', 6, 12, '', [360/230]],
		['摘要',        'summary',     'editor',   TRUE, '', 12, 12, '',[200]],
		['內文',	    'content',     'editor',   TRUE, '', 12, 12, '', [200]],

		['聯絡資料',       '',      'header',   TRUE, '', 12, 12, '',[200]],
		['信箱',       'email',        'text',   TRUE, '', 6, 12, '',[200]],
		['電話',       'phone',        'text',   TRUE, '', 6, 12, '',[200]],
		['官網',       'website',      'text',   TRUE, '', 6, 12, '',[200]],
		['地址',       'address',      'text',   TRUE, '', 6, 12, '',[200]],

		['社群連結',       '',      'header',   TRUE, '', 12, 12, '',[200]],
		['FB連結',       'fb',        'text',   FALSE, '', 6, 12, '',[200]],
		['LINE連結',      'line',    'text',   FALSE, '', 6, 12, '',[200]],
		['IG連結',       'ig',        'text',   FALSE, '', 6, 12, '',[200]],
		
		
	];
	private $th_title = [
		['#', '', ''],
        ['排序', '', ''],
		['店家名', '', ''],
		['LOGO', '', ''],
		['摘要', '', ''],
		['內文', '', ''],
		['信箱/電話/官網/地址', '', ''],
		['FB/LINE/IG', '', ''],
		
		['狀態', '', ''],

		['建立時間', '', ''],
		['動作', '', '']
	];
	public function index(Request $request)
	{
		// print 213;exit;
        $this->data['sub_active'] = 'CooperativeStore';
		$this->data['controller'] = 'cooperative_store';
		$this->data['title'] = "合作島主";
      
		$this->data['parent'] = "";
		$this->data['parent_url'] = "";
		$this->data['th_title'] = $this->th_title_field($this->th_title);
        $this->data['btns'] = [
			['<i class="ri-add-fill"></i>', '新增合作島主', route('mgr.cooperative_store.add'), 'primary']
		];

		// $this->data['template_item'] = 'mgr/items/faq_item';

		// $this->data['data'] = Faq::where("deleted_at", NULL)->get();
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

		$data = CooperativeStore::where("deleted_at", NULL);
		$total = $data->count();
        $total_page = ($page_count!='all')?(($total % $page_count == 0) ? floor(($total)/$page_count) : floor(($total)/$page_count) + 1):'1';
		// print_r($page_count);exit;
		
		$data = $data->take($page_count)->skip( ($page - 1) * $page_count )->get(); //先隱藏
		// print_r($data);exit;

        $this->data['data'] = array();

       
        foreach ($data as $item) {
            $status = '
            <div class="form-check form-switch">
                <input class="form-check-input switch_toggle" data-id="'.$item->id.'" type="checkbox" role="switch" '.(($item->status=='on')?'checked':'').'>
            </div>
            ';
            // if($item->status == 'off') $status = '<span class="">關閉</span>';

            $obj = array();
			// print_r($obj);exit;
            $obj[] = $item->id;
            $obj[] = $item->sort;
            $obj[] = $item->name;
            $obj[] = $item->logo;

			$obj[] = $item->summary;
            $obj[] = $item->content;
            

			// $obj[] = $item->email;
			// $obj[] = $item->phone;
            // $obj[] = $item->address;
            // $obj[] = $item->website;

			$obj[] = $item->email.'<br>'.$item->phone.'<br>'.$item->website.'<br>'.$item->address;
			$obj[] = $item->fb.'<br>'.$item->line.'<br>'.$item->ig;
			// $obj[] = $item->fb;
            // $obj[] = $item->line;
            // $obj[] = $item->ig;
			
			// $obj[] = $item->stock.' / '.$item->total_quantity;
			// if($item->status=='on'){
			// 	$status='啟用';
			// }else{
			// 	$status='關閉';
			// }
            $obj[] = $status;
            $obj[] = $item->created_at;

			$priv_view =FALSE;
			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();
		
            // $this->data['controller'] = 'faq';

			$html .= view('mgr/items/template_item', [
				'item'      => array(
					"id"         => $item->id,
					"data"       => $obj,
					"other_btns" => $other_btns,
					"priv_view"  => $priv_view ,
					"priv_edit"  => $priv_edit,
					"priv_del"   => $priv_del,
                    // "controller"   => 'faq'

				),
				// 'th_title'  => $this->th_title_field($this->th_title), 
                "controller"   => 'cooperative_store'

			])->render();
        }

		$this->output(TRUE, 'success', array(
			'html'	=>	$html,
			'page'       => $page,
			'total_page' => $total_page,
		));
	}

	public function add(Request $request){
        $this->data['sub_active'] = 'CooperativeStore';
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);
			// print_r($formdata);exit;
            // if($formdata['sort']=)
			$res = CooperativeStore::updateOrCreate($formdata);

			if ($res) {
				// Media::save_media('faq_cover', $res->id, $formdata['cover'].";");
				// Media::save_media('faq_thumb', $res->id, $formdata['thumb'].";");
				// Media::save_media('faq_pics', $res->id, $request->post('pics'), $request->post('picdeleted_pics'));

				// $res->tags_refresh($request->post('tags'));

				$this->js_output_and_redirect('新增成功', 'mgr.cooperative_store');
			} else {
				$this->js_output_and_back('新增發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "新增常見問題";
      
		$this->data['parent'] = "常見問題";
		$this->data['parent_url'] = route('mgr.cooperative_store');
		$this->data['action'] = route('mgr.cooperative_store.add');
		$this->data['submit_txt'] = '確認新增';

		$this->data['params'] = $this->generate_param_to_view($this->param);

		return view('mgr/template_form', $this->data);
	}

	public function edit(Request $request, $id){
		$data = CooperativeStore::find($id);
		// print_r($data);exit;
        // $lang = $data->lang;
        $this->data['sub_active'] = 'CooperativeStore';

		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);

			// print_r($formdata);exit;

			$res = CooperativeStore::updateOrCreate(['id'=>$id], $formdata);
			if ($res) {
				// Media::save_media('faq_cover', $id, $formdata['cover'].";");
				// Media::save_media('faq_thumb', $id, $formdata['thumb'].";");
				// Media::save_media('faq_pics', $id, $request->post('pics'), $request->post('picdeleted_pics'));

				// $res->tags_refresh($request->post('tags'));

				$this->js_output_and_redirect('編輯成功', 'mgr.cooperative_store');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "編輯 ".$data->name;
		

		$this->data['parent'] = "合作島主";
		$this->data['parent_url'] = route('mgr.cooperative_store');
		
		$this->data['action'] = route('mgr.cooperative_store.edit', ['id'=>$id]);
		
		$this->data['submit_txt'] = '確認編輯';
		
		// $tags = $data->tags_array();
		
		// $data = $data->toArray();

		// $pics = Media::fetch_to_generate_template('pics', 'faq_pics', $id);
		// $data['pics'] = $pics['value'];
		// $this->data['html']['pics'] = $pics['html'];
		// $data['tags'] = $tags;
		$this->data['params'] = $this->generate_param_to_view($this->param, $data);
		// print_r($this->data['params']);exit;

		return view('mgr/template_form', $this->data);
	}

    public function del(Request $request){
        $id = $request->post('id');
        
        $obj = CooperativeStore::find($id);
        if ($obj->delete()) {
            $this->output(TRUE, "Delete success");
        }else{
            $this->output(FALSE, "Delete fail");
        }
    }
    public function switch_toggle(Request $request){
		// print 123123;exit;
	
		if ($request->isMethod('post')) {
			$id     = $request->post('id');
			$status = $request->post('status');
			// print_r($id);exit;

			if (CooperativeStore::where(['id'=>$id])->update(['status'=>$status])) {
				$this->output(TRUE, "success");
			}else{
				$this->output(FALSE, "fail");
			}
		}
	}
}
