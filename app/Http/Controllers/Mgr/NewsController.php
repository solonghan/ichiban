<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use App\Models\Tags;
use App\Models\Media;

class NewsController extends Mgr
{
    
	public function __construct()
	{
		parent::__construct();
		$this->data['active'] = 'NEWS';
		$this->data['sub_active'] = 'NEWS';

        // $this->data['select']['category'] = News::category();
		// $this->data['select']['tags'] = Tags::where('lang','tw')->get()->toArray();
	}

	private $param = [
		['封面圖',	    'cover',       'image',   TRUE, '比例 360:230', 6, 12, '', [360/230]],
        // ['小圖',	    'thumb',       'image',   TRUE, '比例 3:2', 6, 12, '', [3/2]],
		// ['內頁多圖',	'pics',			'img_multi',   TRUE, '建議比例 12:5', 12, 12, '', [12/5]],
        // ['上線時間',	'online_date',	     'day', TRUE, '', 4, 12, ''],
		// ['下線時間',	'offline_date',	     'day', TRUE, '', 4, 12, ''],
        // ['公開顯示日期',  'date',        'day',   TRUE, '', 4, 12, ''],

		['標題',        'title',        'text',   TRUE, '', 6, 12, ''],
        // ['類型',        'category',      'select',   TRUE, '', 6, 12, '', ['id','text']],
        // ['標籤',		'tags',			'select_multi',		FALSE, '', 6, 12, '', ['id', 'title']],
		['摘要',	    'summary',     'textarea',   TRUE, '', 12, 12, '', [200]],
		['內文',	    'content',     'editor', TRUE, '', 12, 12, '', [200]],
		
	];
	private $th_title = [
		['#', '', ''],
		['封面圖', '', ''],
		// ['小圖', '', ''],
		['標題/摘要', '', ''],
		['狀態', '', ''],
		// ['公開顯示日期/標題/摘要', '350px', ''],
        // ['狀態/發佈時間', '', ''],
		['建立時間', '', ''],
		['動作', '', '']
	];
	public function index(Request $request)
	{
		// print 213;exit;
        $this->data['sub_active'] = 'NEWS';
		$this->data['controller'] = 'news';
		$this->data['title'] = "最新消息";
      
		$this->data['parent'] = "";
		$this->data['parent_url'] = "";
		$this->data['th_title'] = $this->th_title_field($this->th_title);
        $this->data['btns'] = [
			['<i class="ri-add-fill"></i>', '新增最新消息', route('mgr.news.add'), 'primary']
		];

		// $this->data['template_item'] = 'mgr/items/news_item';

		// $this->data['data'] = News::where("deleted_at", NULL)->get();
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

		$data = News::where("deleted_at", NULL);
		$total = $data->count();
        $total_page = ($page_count!='all')?(($total % $page_count == 0) ? floor(($total)/$page_count) : floor(($total)/$page_count) + 1):'1';
		// print_r($page_count);exit;
		
		$data = $data->take($page_count)->skip( ($page - 1) * $page_count )->get(); //先隱藏
		// print_r($data);exit;

        $this->data['data'] = array();
        foreach ($data as $item) {
            $obj = array();
			// print_r($obj);exit;
            $obj[] = $item->id;
			// $img_url = env('APP_URL').'/app'.Storage::url($firstCover);images
			// $obj[] = '<img src="'.env('APP_URL').'/images/'.$item->cover.'" class="img-thumbnail" style="width:150px;">';
			$obj[] = '<img src="'.env('APP_URL').Storage::url($item->cover).'" class="img-thumbnail" style="width:120px;">';
			$obj[] = $item->title."<br>".$item->summary;
			// $obj[] = $item->stock.' / '.$item->total_quantity;
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
			'html'	=>	$html,
			'page'       => $page,
			'total_page' => $total_page,
		));
	}

	public function add(Request $request){
        $this->data['sub_active'] = 'NEWS';
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);
			// print_r($formdata);exit;
			$res = News::updateOrCreate($formdata);

			if ($res) {
				// Media::save_media('news_cover', $res->id, $formdata['cover'].";");
				// Media::save_media('news_thumb', $res->id, $formdata['thumb'].";");
				// Media::save_media('news_pics', $res->id, $request->post('pics'), $request->post('picdeleted_pics'));

				// $res->tags_refresh($request->post('tags'));

				$this->js_output_and_redirect('新增成功', 'mgr.news');
			} else {
				$this->js_output_and_back('新增發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "新增最新消息";
      
		$this->data['parent'] = "最新消息";
		$this->data['parent_url'] = route('mgr.news');
		$this->data['action'] = route('mgr.news.add');
		$this->data['submit_txt'] = '確認新增';

		$this->data['params'] = $this->generate_param_to_view($this->param);

		return view('mgr/template_form', $this->data);
	}

	public function edit(Request $request, $id){
		$data = News::find($id);
		// print_r($data);exit;
        $lang = $data->lang;
        $this->data['sub_active'] = 'NEWS';

		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);

			// print_r($formdata);exit;

			$res = News::updateOrCreate(['id'=>$id], $formdata);
			if ($res) {
				// Media::save_media('news_cover', $id, $formdata['cover'].";");
				// Media::save_media('news_thumb', $id, $formdata['thumb'].";");
				// Media::save_media('news_pics', $id, $request->post('pics'), $request->post('picdeleted_pics'));

				// $res->tags_refresh($request->post('tags'));

				$this->js_output_and_redirect('編輯成功', 'mgr.news');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "編輯 ".$data->title;

		$this->data['parent'] = "最新消息";
		$this->data['parent_url'] = route('mgr.news');
		$this->data['action'] = route('mgr.news.edit', ['id'=>$id]);
		$this->data['submit_txt'] = '確認編輯';
		
		// $tags = $data->tags_array();
		
		$data = $data->toArray();

		// $pics = Media::fetch_to_generate_template('pics', 'news_pics', $id);
		// $data['pics'] = $pics['value'];
		// $this->data['html']['pics'] = $pics['html'];
		// $data['tags'] = $tags;
		$this->data['params'] = $this->generate_param_to_view($this->param, $data);

		return view('mgr/template_form', $this->data);
	}

    public function del(Request $request){
        $id = $request->post('id');
        
        $obj = News::find($id);
        if ($obj->delete()) {
            $this->output(TRUE, "Delete success");
        }else{
            $this->output(FALSE, "Delete fail");
        }
    }
}
