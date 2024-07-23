<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;
use App\Models\Tags;

class TagsController extends Mgr
{
    
	public function __construct()
	{
		parent::__construct();
		$this->data['active'] = 'SETTING';
		$this->data['sub_active'] = 'TAGS';

		$this->data['select']['status'] = array(
			// array("id"=>"normal", "text"=>"未公開"),
			array("id"=>"on", "text"=>"開啟"),
			array("id"=>"off", "text"=>"關閉"),
		);
	}

	private $th_title = [
		['#', '', ''],
		['標籤名稱', '', ''],
		['狀態', '', ''],
		['建立時間', '', ''],
		['動作', '', '']
	];

	private $param = [
		['標籤名稱',       'title',        'text',   TRUE, '', 12, 12, ''],
        ['狀態',        'status',        'select',   FALSE, '', 12, 12, '',['id','text']],
	
	];
	public function index(Request $request)
	{
		$this->data['controller'] = 'tags';
		$this->data['title'] = "標籤";
		$this->data['parent'] = "";
		$this->data['parent_url'] = "";
		$this->data['th_title'] = $this->th_title_field($this->th_title);
		
		$this->data['btns'] = [
			['<i class="ri-add-fill"></i>', '新增標籤', route('mgr.tags.add'), 'primary']
		];

		// $this->data['template_item'] = 'mgr/items/template_item';

		// $data = Tags::where("lang", 'tw')->get();

        // $this->data['data'] = array();
        // foreach ($data as $item) {
        //     $this->data['data'][] = array(
        //         "id"    =>  $item->id,
        //         "data"  =>  array(
        //             $item->id,
        //             $item->title,
        //             $item->created_at
        //         )
        //     );
        // }

		return view('mgr/template_list_ajax', $this->data);
	}
	public function data(Request $request){
		$page   = $request->post('page')??'';
		$search = $request->post('search')??'';
		$status = $request->post('status')??'normal';
		$page_count = $request->post('page_count')??$this->page_count;
		// $page_count=1;

		// $role = Auth::guard('mgr')->user()->role;
		$html = "";
        $data = array();
		$data = Tags::where("deleted_at", NULL);

		$total = $data->count();
        $total_page = ($page_count!='all')?(($total % $page_count == 0) ? floor(($total)/$page_count) : floor(($total)/$page_count) + 1):'1';
		$data = $data->take($page_count)->skip( ($page - 1) * $page_count )->get(); //先隱藏
	
        $this->data['data'] = array();
        foreach ($data as $item) {
            $obj = array();
			// print_r($obj);exit;
            $obj[] = $item->id;
			$obj[] = $item->title;
			// if($item->role == 'tourist'){
			// 	$role = '<span class="badge  bg-secondary">遊客</span>';
			// 	// $role = '遊客';
			// }else if($item->role == 'islander') {
			// 	$role = '<span class="badge  bg-primary">島民</span>';
			// 	// $role = '島民';
			// }else if($item->role == 'senior_islander') {
			// 	$role = '<span class="badge  bg-warning">資深島民</span>';
			// 	// $role = '資深島民';
			// }
			// else{
			// 	$role = '未設定';
			// }
			
		
			if($item->status=='on'){
				$status='開啟';
			}else{
				$status='關閉';
			}
            $obj[] = $status;
            $obj[] = $item->created_at;
			$priv_view = FALSE;
			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();

			$html .= view('mgr/items/template_item', [
				'item'      => array(
					"id"         => $item->id,
					"data"       => $obj,
					"other_btns" => $other_btns,
					"priv_view"  => $priv_view,
					"priv_edit"  => $priv_edit,
					"priv_del"   => $priv_del
				),
				'th_title'  => $this->th_title_field($this->th_title)
			])->render();
        }
		// print_r($total_page);exit;
		$this->output(TRUE, 'success', array(
			'html'	=>	$html,
			'page'       => $page,
			'total_page' => $total_page,
		));
	}

	public function add(Request $request){
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);

			// input file upload
			// $file = $request->file('logo');
			// $name = $file->getClientOriginalName();
			// $extension = $file->getClientOriginalExtension();
			// $path = Storage::putFileAs(
			// 	'agency', $file, time().".".$extension
			// );
			// $formdata['logo'] = $path;

			$res = Tags::updateOrCreate($formdata);

			Tags::updateOrCreate($formdata);
			if ($res) {
				$this->js_output_and_redirect('新增成功', 'mgr.tags');
			} else {
				$this->js_output_and_back('新增發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "新增標籤";
		$this->data['parent'] = "標籤";
		$this->data['parent_url'] = route('mgr.tags');
		$this->data['action'] = route('mgr.tags.add');
		$this->data['submit_txt'] = '確認新增';

		$this->data['params'] = $this->generate_param_to_view($this->param);

		return view('mgr/template_form', $this->data);
	}

	public function edit(Request $request, $id){
		$data = Tags::find($id);
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);
			// print_r($formdata);exit;
			$res = Tags::updateOrCreate(['id'=>$id], $formdata);

			if ($res) {
				$this->js_output_and_redirect('編輯成功', 'mgr.tags');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "編輯 ".$data->title;
		$this->data['parent'] = "標籤";
		$this->data['parent_url'] = route('mgr.tags');
		$this->data['action'] = route('mgr.tags', ['id'=>$id]);
		$this->data['submit_txt'] = '確認編輯';

		// print_r($data);exit;
		$data = $data->toArray();
        // $data_en = Tags::where(['parent_id'=>$data['id'], 'lang'=>'en'])->first()->toArray();
        // $lang_data = array(
        //     'tw'    =>  $data,
        //     'en'    =>  $data_en
        // );
		$this->data['params'] = $this->generate_param_to_view($this->param, $data);

		return view('mgr/template_form', $this->data);
	}

    public function del(Request $request){
        $id = $request->post('id');
        
        $obj = Tags::find($id);
        if ($obj->delete()) {
            $this->output(TRUE, "Delete success");
        }else{
            $this->output(FALSE, "Delete fail");
        }
    }

}
