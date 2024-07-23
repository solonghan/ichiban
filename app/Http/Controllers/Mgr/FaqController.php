<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Storage;
use App\Models\Tags;
use App\Models\Media;

class FaqController extends Mgr
{
    
	public function __construct()
	{
		parent::__construct();
		$this->data['active'] = 'FAQ';
		$this->data['sub_active'] = 'FAQ';

        // $this->data['select']['category'] = Faq::category();
		// $this->data['select']['tags'] = Tags::where('lang','tw')->get()->toArray();
	}

	private $param = [
		// ['封面圖',	    'cover',       'image',   TRUE, '比例 360:230', 6, 12, '', [360/230]],
		['問題',        'question',        'editor',   TRUE, '', 12, 12, '',[200]],
		['回答',	    'answer',     'editor',   TRUE, '', 12, 12, '', [200]],
		['排序',	    'sort',     'number', FALSE, 0, 3, 12, '', [200]],
		
	];
	private $th_title = [
		['#', '', ''],
        ['排序', '', ''],
		['問題', '', ''],
		['回答', '', ''],
		['狀態', '', ''],

		['建立時間', '', ''],
		['動作', '', '']
	];
	public function index(Request $request)
	{
		// print 213;exit;
        $this->data['sub_active'] = 'FAQ';
		$this->data['controller'] = 'faq';
		$this->data['title'] = "常見問題";
      
		$this->data['parent'] = "";
		$this->data['parent_url'] = "";
		$this->data['th_title'] = $this->th_title_field($this->th_title);
        $this->data['btns'] = [
			['<i class="ri-add-fill"></i>', '新增常見問題', route('mgr.faq.add'), 'primary']
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

		$data = Faq::where("deleted_at", NULL);
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
            $obj[] = $item->question;
            $obj[] = $item->answer;
			
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
                "controller"   => 'faq'

			])->render();
        }

		$this->output(TRUE, 'success', array(
			'html'	=>	$html,
			'page'       => $page,
			'total_page' => $total_page,
		));
	}

	public function add(Request $request){
        $this->data['sub_active'] = 'FAQ';
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);
			// print_r($formdata);exit;
            // if($formdata['sort']=)
			$res = Faq::updateOrCreate($formdata);

			if ($res) {
				// Media::save_media('faq_cover', $res->id, $formdata['cover'].";");
				// Media::save_media('faq_thumb', $res->id, $formdata['thumb'].";");
				// Media::save_media('faq_pics', $res->id, $request->post('pics'), $request->post('picdeleted_pics'));

				// $res->tags_refresh($request->post('tags'));

				$this->js_output_and_redirect('新增成功', 'mgr.faq');
			} else {
				$this->js_output_and_back('新增發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "新增常見問題";
      
		$this->data['parent'] = "常見問題";
		$this->data['parent_url'] = route('mgr.faq');
		$this->data['action'] = route('mgr.faq.add');
		$this->data['submit_txt'] = '確認新增';

		$this->data['params'] = $this->generate_param_to_view($this->param);

		return view('mgr/template_form', $this->data);
	}

	public function edit(Request $request, $id){
		$data = Faq::find($id);
		// print_r($data);exit;
        $lang = $data->lang;
        $this->data['sub_active'] = 'FAQ';

		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);

			// print_r($formdata);exit;

			$res = Faq::updateOrCreate(['id'=>$id], $formdata);
			if ($res) {
				// Media::save_media('faq_cover', $id, $formdata['cover'].";");
				// Media::save_media('faq_thumb', $id, $formdata['thumb'].";");
				// Media::save_media('faq_pics', $id, $request->post('pics'), $request->post('picdeleted_pics'));

				// $res->tags_refresh($request->post('tags'));

				$this->js_output_and_redirect('編輯成功', 'mgr.faq');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "編輯 ".$data->title;

		$this->data['parent'] = "常見問題";
		$this->data['parent_url'] = route('mgr.faq');
		$this->data['action'] = route('mgr.faq.edit', ['id'=>$id]);
		$this->data['submit_txt'] = '確認編輯';
		
		// $tags = $data->tags_array();
		
		$data = $data->toArray();

		// $pics = Media::fetch_to_generate_template('pics', 'faq_pics', $id);
		// $data['pics'] = $pics['value'];
		// $this->data['html']['pics'] = $pics['html'];
		// $data['tags'] = $tags;
		$this->data['params'] = $this->generate_param_to_view($this->param, $data);

		return view('mgr/template_form', $this->data);
	}

    public function del(Request $request){
        $id = $request->post('id');
        
        $obj = Faq::find($id);
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

			if (Faq::where(['id'=>$id])->update(['status'=>$status])) {
				$this->output(TRUE, "success");
			}else{
				$this->output(FALSE, "fail");
			}
		}
	}
}
