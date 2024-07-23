<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use App\Models\UserProduct;
use App\Models\Product;
use App\Models\UserRecipient;
use App\Models\City;
use App\Models\Dist;
use App\Models\Tags;
use App\Models\userEmailVerified;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\NormalMail;
use App\Models\PointLog;
use Illuminate\Support\Facades\Mail;
class UserController extends Mgr
{
    
	public function __construct()
	{
		parent::__construct();
		$this->data['active'] = 'USER';
		$this->data['sub_active'] = 'USER';
		
		// $this->data['select']['manager'] = Member::where('id', '!=', 1)->get()->toArray();
		// $this->data['select']['dist'] = Dist::where('city_id', $data['city'])->get()->toArray();

		$this->data['select']['city'] = City::get()->toArray();
		// print_r($this->data['select']['city']);exit;
		$this->data['select']['tags'] = Tags::get()->toArray();

		$this->data['select']['role'] = array(
			array("id"=>"tourist", "text"=>"遊客"),
			array("id"=>"islander", "text"=>"島民"),
			array("id"=>"senior_islander", "text"=>"資深島民"),
		);

		$this->data['select']['gender'] = array(
			array("id"=>"normal", "text"=>"未公開"),
			array("id"=>"male", "text"=>"男生"),
			array("id"=>"female", "text"=>"女生"),
		);

		$this->data['select']['transaction_type'] = array(
			array("id"=>"normal", "text"=>"款到發貨"),
			array("id"=>"month", "text"=>"月結??日 (下月1日起算)"),
			array("id"=>"day", "text"=>"日結??日 (下單後隔日起算)"),
		);
	}

	private $param = [
		// ['公司名稱',       'company',        'text',   TRUE, '', 4, 12, ''],

		['會員資訊',        '',        'header',   TRUE, '', 12, 12, ''],

		
		['真實姓名',        'realname',        'text',   FALSE, '', 3, 12, ''],
		['會員姓名',        'username',        'text',   FALSE, '', 3, 12, ''],
		// ['身份別',        'tags',  		'select',   FALSE, '身份', 3, 12, '', ['id','title']],
		['身份別',        'role',  		'select',   FALSE, '身份', 3, 12, '', ['id','text']],
		['性別',        'gender',  		'select',   FALSE, '身份', 3, 12, '', ['id','text']],
        ['email',        'email',        'text',   FALSE, '', 3, 12, ''],
        ['會員電話',        'phone',        'text',   FALSE, '', 3, 12, ''],
		['生日',        'birthday',        'day',   FALSE, '', 3, 12, ''],

		['變更密碼',	'',		'header',   TRUE, '', 12, 12, ''],
        ['密碼',        'password',        'password',   FALSE, '', 3, 12, ''],
        ['再次輸入密碼',   'password_confirm',        'password',   FALSE, '', 3, 12, ''],
		// ['',			'username',     		'',   TRUE, '', 12, 12, ''],
		// ['會員電話',        'phone',        'text',   FALSE, '', 3, 12, ''],
        // ['電話分機',        'ext',        'text',   FALSE, '', 3, 12, ''],

		// ['交易方式',        '',        		'header',   FALSE, '', 12, 12, ''],
		// ['交易方式',        'transaction_type',  'select',   FALSE, '若為款到發貨則留空', 3, 12, '', ['id','text']],
		// ['月結/日結天數',    'transaction_day',        	'number',   FALSE, '', 3, 12, ''],
		// ['',        '',        		'block',   FALSE, '', 12, 12, ''],
		// ['備註',    		'transaction_remark',      'textarea',   FALSE, '', 6, 12, ''],
		
		// ['其它資訊',        '',        'header',   FALSE, '', 12, 12, ''],
        // ['信用額度',        'credits',        'number',   TRUE, '', 4, 12, ''],
        // ['指派業務',        'manager',        'select',   TRUE, '', 4, 12, '', ['id', 'username']],
	];
	private $recipient_param = [
		// ['公司名稱',       'company',        'text',   TRUE, '', 4, 12, ''],
		// ['會員資訊',        '',        'header',   TRUE, '', 12, 12, ''],
		// ['真實姓名',        'realname',        'text',   FALSE, '', 3, 12, ''],
		['收件人',        'username',        'text',   FALSE, '', 3, 12, ''],
		['城市',        'city',  		'select',   FALSE, '身份', 3, 12, '', ['id','city']],
		['行政區',        'dist',  		'select',   FALSE, '身份', 3, 12, '', ['id','dist']],
        ['地址',        'address',        'text',   FALSE, '', 3, 12, ''],
        ['電話',        'phone',        'text',   FALSE, '', 3, 12, ''],
		// ['生日',        'birthday',        'day',   FALSE, '', 3, 12, ''],

		// ['變更密碼',	'',		'header',   TRUE, '', 12, 12, ''],
        // ['密碼',        'password',        'password',   FALSE, '', 3, 12, ''],
        // ['再次輸入密碼',   'password_confirm',        'password',   FALSE, '', 3, 12, ''],
	];

	private $review_param = [
		['公司名稱',       'company',        'text',   TRUE, '', 4, 12, ''],
        ['統一編號',        'tax_id',        'text',   TRUE, '', 4, 12, ''],
        ['email',        'email',        'text',   FALSE, '', 4, 12, ''],
        ['聯繫人資訊',        '',        'header',   FALSE, '', 12, 12, ''],
        ['聯繫人姓名',        'username',        'text',   FALSE, '', 3, 12, ''],
        ['電話',        	'phone',        'text',   FALSE, '', 3, 12, ''],
        ['電話分機',        'ext',        'text',   FALSE, '', 3, 12, ''],

		['交易方式',        '',        		'header',   FALSE, '', 12, 12, ''],
		['交易方式',        'transaction_type',  'select',   FALSE, '若為款到發貨則留空', 3, 12, '', ['id','text']],
		['月結/日結天數',    'transaction_day',        	'number',   FALSE, '', 3, 12, ''],
		['',        '',        		'block',   FALSE, '', 12, 12, ''],
		['備註',    		'transaction_remark',      'textarea',   FALSE, '', 6, 12, ''],

		['其它資訊',        '',        'header',   FALSE, '', 12, 12, ''],
        ['信用額度',        'credits',        'number',   TRUE, '', 4, 12, ''],
        ['指派業務',        'manager',        'select',   TRUE, '', 4, 12, '', ['id', 'username']],

	];
	private $th_title = [
		['#', '', ''],
		['目前身分', '', ''],
		['真實姓名', '', ''],
		['暱稱', '', ''],
		['Email', '', ''],
		['手機', '', ''],
		['生日', '', ''],
		['點數', '', ''],
		['性別', '', ''],
		['狀態', '', ''],
		['建立時間', '', ''],
		['動作', '', '']
	];
	public function index(Request $request, $status = 'normal')
	{
		$this->data['controller'] = 'users';
		$this->data['title'] = "會員管理";
		$this->data['parent'] = "";
		$this->data['parent_url'] = "";
		$this->data['th_title'] = $this->th_title_field($this->th_title);
		$this->data['btns'] = [
			['<i class="ri-add-fill"></i>', '新增會員', route('mgr.users.add'), 'primary']
		];

		$this->data['status'] = $status;

		return view('mgr/template_list_ajax', $this->data);
	}
	public function data(Request $request){
		$page   = $request->post('page')??'';
		$search = $request->post('search')??'';
		$status = $request->post('status')??'normal';
		$page_count = $request->post('page_count')??$this->page_count;
		// $page_count=1;

		$role = Auth::guard('mgr')->user()->role;
		// print_r($role);exit;
		$html = "";
		// $this->data['template_item'] = 'mgr/items/template_item';

        $data = array();
       

		// $data = User::where(['status'=>'not_verify'])->get();  
		$data = User::where(['deleted_at'=>NULL]);
		// ->get();  

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
			// $obj[] = $item->role;
			if($item->role == 'tourist'){
				$role = '<span class="badge  bg-secondary">遊客</span>';
				// $role = '遊客';
			}else if($item->role == 'islander') {
				$role = '<span class="badge  bg-primary">島民</span>';
				// $role = '島民';
			}else if($item->role == 'senior_islander') {
				$role = '<span class="badge  bg-warning">資深島民</span>';
				// $role = '資深島民';
			}
			else{
				$role = '未設定';
			}
			$obj[] = $role;
			
			$obj[] = $item->realname;

			$username = $item->username;
			$username_id='username_'.$item->id;
			// $obj[] = $username;
			$obj[] = '<span id='.$username_id.'>'.$username.'</span>';
			
            $obj[] = $item->email;

			$obj[] = $item->phone;

			$obj[] = $item->birthday;

			$obj[]='<span>'.$item->point.'</span> <span class="fa fa-cog point-setting" id="setting_"'.$item->id. ' style="cursor: pointer"></span>';

			
			

			// $obj[] = $item->gender;
			if($item->gender == 'male'){
				$gender = '男';
			}else if ($item->gender == 'female') {
				$gender = '女';
			}else{
				$gender = '未公開';
			}
			$obj[] = $gender;
		
			if ($item->status == 'normal') {
				$status = '<span class="badge rounded-pill bg-primary">正常</span>';
			}else if ($item->status == 'not_verify') {
				$status = '<span class="badge rounded-pill bg-secondary">未驗證</span>';
				// $c = userEmailVerified::where(['user_id'=>$item->id,'status'=>'pending'])->first();
				// if ($c != null) {
				// 	$status .= '<br>驗證碼： '.$c->code;
				// }
			}else if ($item->status == 'inreview') {
				$status = '<span class="badge rounded-pill bg-warning">等待審核</span>';
			}else if ($item->status == 'block') {
				$status = '<span class="badge rounded-pill bg-warning">已關閉</span>';
			}
            $obj[] = $status;
            $obj[] = $item->created_at;
			$priv_view = FALSE;
			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();
			$other_btns[] = [
				"class"  => "btn-success",
				"action" => "location.href='".route('mgr.users.recipient', ['user_id'=>$item->id])."'",
				// "action" => "location.href='".route('mgr.product.awards', ['product_id'=>$item->id])."'",
				"text"   => "收件常用地址"
			];
			// print_r($obj);exit;

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

	// 收件常用地址
	public function recipient(Request $request,$user_id=false){
		// print 123;exit;
		if ($user_id != FALSE) {
			// print_r($user_id);exit;
			// $this->data['controller'] = 'recipient';
			$this->data['controller'] = 'users/recipient';
			$this->data['tab'] = 'data/'.$user_id;
			$this->data['title'] = " 收件常用地址管理";
			$this->data['parent'] = "";
			$this->data['parent_url'] = "";
			$this->data['th_title'] = $this->th_title_field(
				[
					['#', '', ''],	
					['收件人', '', ''],
					['電話', '', ''],
					['城市', '', ''],
					['行政區', '', ''],
					['地址', '', ''],
					// ['狀態', '', ''],
					['建立時間', '', ''],
					['動作', '', '']
				]
			);
			$this->data['btns'] = [
				['<i class="ri-add-fill"></i>', '新增地址', route('mgr.users.recipient_add', ['user_id'=>$user_id]), 'primary']
			];

			// $this->data['template_item'] = 'mgr/items/template_item';

			// $data = UserProduct::orderBy('id','desc')->where(['user_id'=>$user_id])->with('user')->with('product')->get()->unique('product_id');
			//->groupBy('product_id')
			
			// return view('mgr/template_list_view_ajax', $this->data);
			return view('mgr/template_list_ajax', $this->data);
			// return view('mgr/template_list', $this->data);
		}else{
			// print 888;exit;
		}

	}

	public function recipient_data(Request $request,$user_id=false){
		$page   = $request->post('page')??'';
		$search = $request->post('search')??'';
		$status = $request->post('status')??'normal';
		$page_count = $request->post('page_count')??$this->page_count;
		// $page_count =1;
		$html = "";
		// $data = User::where("deleted_at", NULL)
		// 					// ->with('recipient')
		// 					->where("id", $user_id);	

		$data = UserRecipient::where("deleted_at", NULL)
							->where("user_id", $user_id);	
											
		$total = $data->count();
        $total_page = ($page_count!='all')?(($total % $page_count == 0) ? floor(($total)/$page_count) : floor(($total)/$page_count) + 1):'1';
		$data = $data->take($page_count)->skip( ($page - 1) * $page_count )->get(); //先隱藏

        $this->data['data'] = array();
        foreach ($data as $item) {
			
			// $status = '
			// 		<div class="form-check form-switch">
			// 			<input class="form-check-input switch_toggle" data-id="'.$item->id.'
			// 			" type="checkbox" role="switch" '.(($item->status=='on')?'checked':'').'>
			// 		</div>
			// 	';
			
			$obj = array();
			$obj[] = $item->id;
			$obj[] = $item->username;
			$obj[] = $item->phone;
			// $obj[] = $item->city;
			$c = City::where('id', $item->city)->first();
			$obj[] = $c->city;
			
			// $obj[] = $item->dist;
			$d = Dist::where('id', $item->dist)->first();
			$obj[] = $d->dist;
			$obj[] = $item->address;
			$obj[] = $item->created_at;	
			
			$priv_view =FALSE;
			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();

			$this->data['template_item'] = 'mgr/items/template_item';
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
		// print_r($data);exit;

	}
	public function recipient_add(Request $request,$user_id=false,$id=false){
		// print_r($user_id);exit;
		
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->recipient_param, $request);
			// print_r($formdata);exit;
			// if (User::where('email', $formdata['email'])->count() > 0){
			// 	$this->js_output_and_back('此email已被使用');
			// 	exit();
			// }
			$formdata['user_id']=$user_id;
		
			
			$res = UserRecipient::create($formdata);
			if ($res) {
			
				$this->js_output_and_redirect('新增成功', 'mgr.users.recipient',['user_id'=>$user_id]);
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}
		// print 123;exit;

		$this->data['title'] = "新建會員";
		$this->data['parent'] = "會員管理";
		$this->data['parent_url'] = route('mgr.users');
		$this->data['action'] = route('mgr.users.add');
		$this->data['submit_txt'] = '確認新建';

		// $this->data['params'] = $this->generate_param_to_view($this->param);
		$this->data['params'] = $this->generate_param_to_view($this->recipient_param);
		$this->data['select']['dist'] = Dist::get()->toArray();

		// print_r($this->data);exit;

		return view('mgr/template_form', $this->data);

	}
	public function recipient_edit(Request $request,$recipient_id=false){
	
		$data = UserRecipient::where("deleted_at", NULL)->find($recipient_id);
		
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->recipient_param, $request);

			$res = UserRecipient::updateOrCreate(['id'=>$recipient_id], $formdata);
			if ($res) {
				
				// $res->manager_refresh([$formdata['manager']]);
				// $this->js_output_and_redirect('編輯成功', 'mgr.users.recipient');
				$this->js_output_and_redirect('編輯成功', 'mgr.users.recipient',['user_id'=>$data->user_id]);
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

	
		$this->data['title'] = "編輯 ".$data->username;
		$this->data['parent'] = "會員管理";
		$this->data['parent_url'] = route('mgr.users');
		$this->data['action'] = route('mgr.users.recipient_edit', ['id'=>$recipient_id]);
		$this->data['submit_txt'] = '確認編輯';

		$this->data['params'] = $this->generate_param_to_view($this->recipient_param, $data);
		$this->data['select']['dist'] = Dist::where('city_id', $data['city'])->get()->toArray();
		
	
		return view('mgr/template_form', $this->data);
	}
	public function recipient_edit_test(Request $request,$user_id=false,$recipient_id=false){
		print_r($user_id);exit;
		
	}

	public function data_old(Request $request){
		$page   = $request->post('page')??'';
		$search = $request->post('search')??'';
		$status = $request->post('status')??'normal';

		$role = Auth::guard('mgr')->user()->role;
		// print_r($role);exit;
		$html = "";
		// $this->data['template_item'] = 'mgr/items/template_item';

        $data = array();
        // if ($status == 'normal') {
        //     $data = User::where(['status'=>'normal'])
		// 				->where(function($query) use ($search) {
		// 					if ($search != ''){
		// 						$query->orWhere('username', 'like', '%'.$search.'%');
		// 						$query->orWhere('company', 'like', '%'.$search.'%');
		// 						$query->orWhere('tax_id', 'like', '%'.$search.'%');
		// 						$query->orWhere('phone', 'like', '%'.$search.'%');
		// 						$query->orWhere('email', 'like', '%'.$search.'%');
		// 					}
		// 				})
		// 				->with('manage_user')->get();    
        // }else{
        //     $this->data['sub_active'] = 'USER_NEW';
        //     $data = User::whereIn('status',['inreview'])
		// 				->where(function($query) use ($search) {
		// 					if ($search != ''){
		// 						$query->orWhere('username', 'like', '%'.$search.'%');
		// 						$query->orWhere('company', 'like', '%'.$search.'%');
		// 						$query->orWhere('tax_id', 'like', '%'.$search.'%');
		// 						$query->orWhere('phone', 'like', '%'.$search.'%');
		// 						$query->orWhere('email', 'like', '%'.$search.'%');
		// 					}
		// 				})->get();
        // }

		$data = User::where(['status'=>'not_verify'])->get();  
		// print_r($data);exit;

        $this->data['data'] = array();
        foreach ($data as $item) {
            $status = '正常';
				
			// if ($item->status == 'normal') {
			// 	$status = '<span class="badge rounded-pill bg-primary">正常</span>';
			// }else if ($item->status == 'not_verify') {
			// 	$status = '<span class="badge rounded-pill bg-secondary">未驗證</span>';
			// 	$c = userEmailVerified::where(['user_id'=>$item->id,'status'=>'pending'])->first();
			// 	if ($c != null) {
			// 		$status .= '<br>驗證碼： '.$c->code;
			// 	}
			// }else if ($item->status == 'inreview') {
			// 	$status = '<span class="badge rounded-pill bg-warning">等待審核</span>';
			// }else if ($item->status == 'block') {
			// 	$status = '<span class="badge rounded-pill bg-warning">已關閉</span>';
			// }
			

            $obj = array();
			// print_r($obj);exit;
            $obj[] = $item->id;
			$username = $item->username;
			// $credit = User::credit_check($item->id);
			// if (!$credit['status']) {
			// 	$username .= '<br><span class="badge bg-danger">超過信用額度</span>';
			// }
			$obj[] = $username;
			// if ($item->status == 'normal') {
			// 	$manager = '';
			// 	foreach ($item->manage_user as $m) {
			// 		$manager .= '<span class="badge badge-soft-primary">'.$m['username'].'</span><br>';
			// 	}
			// 	if ($manager != ''){
			// 		$obj[] = $manager;
			// 	}else{
			// 		$obj[] = '<span class="badge bg-danger">未綁定</span>';
			// 	}				
			// }else{
			// 	$obj[] = '';
			// }
            $obj[] = $item->email;
			// if ($item->transaction_remark != '') {
			// 	$obj[] = User::transaction_str($item)."<br><small class='text text-muted'>".$item->transaction_remark.'</small>';
			// }else{
			// 	$obj[] = User::transaction_str($item);
			// }
            $obj[] = $status;
            $obj[] = $item->created_at;

			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();
			// if ($item->status == 'normal') {
			// 	$other_btns[] = array(
			// 		"class"  => "btn-success",
			// 		"action" => "location.href='".route('mgr.users.product', ['user_id'=>$item->id])."'",
			// 		"text"   => "產品價格"
			// 	);				
			// }else{
			// 	$priv_edit = FALSE;
			// 	$priv_del = TRUE;
			// 	$other_btns[] = array(
			// 		"class"  => "btn-success",
			// 		"action" => "location.href='".route('mgr.users.review', ['id'=>$item->id])."'",
			// 		"text"   => "前往驗證"
			// 	);
			// }

			// print_r($obj);exit;

			$html .= view('mgr/items/template_item', [
				'item'      => array(
					"id"         => $item->id,
					"data"       => $obj,
					"other_btns" => $other_btns,
					"priv_edit"  => $priv_edit,
					"priv_del"   => $priv_del
				),
				'th_title'  => $this->th_title_field($this->th_title)
			])->render();
        }

		$this->output(TRUE, 'success', array(
			'html'	=>	$html
		));
	}

	public function add(Request $request){
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);
			// print_r($formdata);exit;
			// if (User::where('email', $formdata['email'])->count() > 0){
			// 	$this->js_output_and_back('此email已被使用');
			// 	exit();
			// }

			if ($formdata['password'] == '') {
				$this->js_output_and_back('密碼不可為空');
				exit();
			}
			if ($formdata['password'] != $formdata['password_confirm']) {
				$this->js_output_and_back('兩次輸入密碼不相同');
				exit();
			}
			$formdata['password'] = Hash::make($formdata['password']);
			unset($formdata['password_confirm']);

			
			$res = User::create($formdata);
			if ($res) {
			
				$this->js_output_and_redirect('新增成功', 'mgr.users');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}
		// print 123;exit;

		$this->data['title'] = "新建會員";
		$this->data['parent'] = "會員管理";
		$this->data['parent_url'] = route('mgr.users');
		$this->data['action'] = route('mgr.users.add');
		$this->data['submit_txt'] = '確認新建';

		$this->data['params'] = $this->generate_param_to_view($this->param);

		// print_r($this->data);exit;

		return view('mgr/template_form', $this->data);
	}

	public function edit(Request $request, $id){
		// $data = User::with('manage_user')->find($id);
		$data = User::where(['deleted_at'=>NULL])->find($id);  
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->param, $request);

			if ($formdata['password'] != '') {
				if ($formdata['password'] != $formdata['password_confirm']) {
					$this->js_output_and_back('兩次輸入密碼不相同');
					exit();
				}
				$formdata['password'] = Hash::make($formdata['password']);
			}else{
				unset($formdata['password']);	
			}
			unset($formdata['password_confirm']);

			$res = User::updateOrCreate(['id'=>$id], $formdata);
			if ($res) {
				
				// $res->manager_refresh([$formdata['manager']]);
				$this->js_output_and_redirect('編輯成功', 'mgr.users');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "編輯 ".$data->username;
		$this->data['parent'] = "會員管理";
		$this->data['parent_url'] = route('mgr.users');
		$this->data['action'] = route('mgr.users.edit', ['id'=>$id]);
		$this->data['submit_txt'] = '確認編輯';

		$this->data['params'] = $this->generate_param_to_view($this->param, $data);

		return view('mgr/template_form', $this->data);
	}


	public function review(Request $request, $id){
		$data = User::find($id)->toArray();
		if ($request->isMethod('post')) {
			$formdata = $this->process_post_data($this->review_param, $request);

			$manager_id = $formdata['manager'];
			unset($formdata['manager']);

			$formdata['status'] = 'normal';

			$res = User::updateOrCreate(['id'=>$id], $formdata);
			if ($res) {
				$res->manager_refresh([$manager_id]);
				$title = "伊士肯化學會員身分驗證成功通知";
				$content = $data->username."您好, 您的會員資格已驗證通過, 請<a href='".route('member')."'>點此</a>登入確認";
				Mail::to($data->email)
					->cc('j2612280@gmail.com')
					->send(new NormalMail($title, $content));

				$this->js_output_and_redirect($res->company.' 審核通過', 'mgr.users');
			} else {
				$this->js_output_and_back('編輯發生錯誤');
			}
			exit();
		}

		$this->data['title'] = "審核 ".$data->company;
		$this->data['parent'] = "會員管理";
		$this->data['parent_url'] = route('mgr.users');
		$this->data['action'] = route('mgr.users.review', ['id'=>$id]);
		$this->data['submit_txt'] = '審核通過';

		$data = $data->toArray();
        
		$this->data['params'] = $this->generate_param_to_view($this->review_param, $data);

		return view('mgr/template_form', $this->data);
	}

    public function del(Request $request){
        $id = $request->post('id');
        
        $obj = User::find($id);
		// print_r($obj);exit;
        if ($obj->delete()) {
            $this->output(TRUE, "Delete success");
        }else{
            $this->output(FALSE, "Delete fail");
        }
    }
	public function point_log_1(Request $request){
		
		$this->data['controller'] = 'users';
		$this->data['title'] = "會員管理";
		$this->data['parent'] = "";
		$this->data['parent_url'] = "";
		$this->data['th_title'] = $this->th_title_field(
			[
				['#', '', ''],
				['姓名', '', ''],
                ['Email', '', ''],
                ['狀態', '', ''],
				['建立時間', '', ''],
				['動作', '', '']
			]
		);
		$this->data['btns'] = [
			// ['<i class="ri-add-fill"></i>', '新增標籤', route('mgr.user.add'), 'primary']
		];

		$this->data['template_item'] = 'mgr/items/template_item';

        $data = array();
        // if ($status == 'normal') {
        //     $data = User::where(['status'=>'normal'])->get();    
        // }else{
        //     $this->data['sub_active'] = 'USER_NEW';
        //     $data = User::where(['status'=>'inreview'])->orWhere(['status'=>'not_verify'])->get();
        // }

        $this->data['data'] = array();
        foreach ($data as $item) {
            $status = '正常';
            if ($item->status == 'normal') {
                $status = '<span class="badge rounded-pill bg-primary">正常</span>';
            }else if ($item->status == 'not_verify') {
                $status = '<span class="badge rounded-pill bg-secondary">未驗證</span>';
                $c = userEmailVerified::where(['user_id'=>$item->id,'status'=>'pending'])->first();
                if ($c != null) {
                    $status .= '<br>驗證碼： '.$c->code;
                }
            }else if ($item->status == 'inreview') {
                $status = '<span class="badge rounded-pill bg-warning">等待審核</span>';
            }else if ($item->status == 'block') {
                $status = '<span class="badge rounded-pill bg-warning">已封鎖</span>';
            }

            $obj = array();
            $obj[] = $item->id;
            $obj[] = $item->username;
            $obj[] = $item->email;
            $obj[] = $status;
            $obj[] = $item->created_at;

			$priv_edit = TRUE;
			$priv_del = TRUE;
			$other_btns = array();
			if ($item->status == 'normal') {

			}else{
				$priv_edit = FALSE;
				$priv_del = TRUE;
				$other_btns[] = array(
					"class"  => "btn-success",
					"action" => "location.href='".route('mgr.users.review', ['id'=>$item->id])."'",
					"text"   => "前往驗證"
				);
			}
			
            $this->data['data'][] = array(
                "id"         => $item->id,
                "data"       => $obj,
                "other_btns" => $other_btns,
                "priv_edit"  => $priv_edit,
                "priv_del"   => $priv_del
            );
        }
		return view('mgr/point_log_list', $this->data);
	
	}

	public function point_log(Request $request){
		$user_id = $request->post('id');
		// $user_id  = $this->input->post("id");
		// $user_id =1; //測試用

		// print_r($user_id);exit;
		if (!is_numeric($user_id)) die();
		$data=PointLog::where(['deleted_at'=>NULL ,'user_id'=>$user_id] )->get()->toArray();
		// print_r($data[0]);exit;
		// format()

		// $this->load->model("Coin_model");
		// $data = $this->Coin_model->history($user_id)['list'];

		// $recently_expired = $this->Coin_model->recently_expired($user_id);
		$recently = "";
		// if ($recently_expired !== FALSE) {
		// 	$recently = "將有 ".$recently_expired['remaining']." 點於 ".$recently_expired['deadline']." 到期";
		// }
		
		//取得總點數
		// $total_point=$this->Coin_model->get_total_point($data);

		// return view('mgr/point_log_list', $this->data);

		// $this->log_record("瀏覽會員點數紀錄 ".$user_id);
		$this->output(TRUE, "取得成功", array(
			"data"     =>	$data,
			"recently" => 	$recently,
			// "total_point" => "總點數 : ".$total_point ."點"
		));
	}

	public function point_op(Request $request){
		$user_id = $request->post('id');
		
		// exit;
		if (!is_numeric($user_id)) die();

		$type  = $request->post("type");
		print_r($type);exit;
		$amount = $request->post("amount");
		$msg  = $request->post("msg");
        // $deadline  = $request->post("deadline");

		$r = $this->Member_model->point_action($user_id, $amount, $type, $msg);
		if($r=="success"){
			$member = $this->db->get_where("user", array("id"=>$user_id))->row_array();
			$result = $member['point'];
			$this->output(100, "操作成功", array("result"=>$result));
		}else{
			if($r=="empty" || $r=="not_enough"){
				$this->output(400, "會員點數不足");
			}
			
		}
		$this->output(400, "發生錯誤");
	}

	/*
		產品
	*/

	private function user_product_del($id){
		$obj = UserProduct::find($id);
		
        if (UserProduct::where(['user_id'=>$obj->user_id, 'product_id'=>$obj->product_id])->delete()) {
            $this->output(TRUE, "Delete success");
        }else{
            $this->output(FALSE, "Delete fail");
        }
	}

	public function product(Request $request, $user_id, $product_id = FALSE){
		if ($user_id == 'del') {
			$this->user_product_del($request->post('id'));
			exit();
		}
		$user = User::find($user_id);
		if ($product_id === FALSE) {
			
			$this->data['controller'] = 'users/product';
			$this->data['title'] = $user->username." 產品價格管理";
			$this->data['parent'] = "";
			$this->data['parent_url'] = "";
			$this->data['th_title'] = $this->th_title_field(
				[
					['#', '', ''],
					['會員', '', ''],
					['產品', '', ''],
					['最後購買', '', ''],
					['價格', '250px', ''],
					['最後更新時間', '', ''],
					['動作', '', '']
				]
			);
			$this->data['btns'] = [
				// ['<i class="ri-add-fill"></i>', '新增標籤', route('mgr.user.add'), 'primary']
			];

			$this->data['template_item'] = 'mgr/items/template_item';

			$data = UserProduct::orderBy('id','desc')->where(['user_id'=>$user_id])->with('user')->with('product')->get()->unique('product_id');
			//->groupBy('product_id')

			$this->data['data'] = array();
			foreach ($data as $item) {
				if (!$item->product) continue;
				$price = '<table class="table table-striped" style="width:200px;">';
				foreach (json_decode($item->price, true) as $r) {
					if ($r['range_start'] == 0) continue;
					$price .= '<tr><td style="width:60%;">'.$r['range_start'].'~'.$r['range_end'].'</td><td style="width:40%; text-align:right;">$'.number_format($r['price']).'</td></tr>';
				}
				$price .= '</table>';
				$obj = array();
				$obj[] = $item->id;
				$obj[] = $item->user->username;
				$obj[] = ($item->product)?$item->product->name:"";
				$obj[] = "價格: $".number_format($item->ex_price)."<br>數量: ".$item->ex_quantity;
				$obj[] = $price;
				$obj[] = $item->created_at;

				$priv_edit = FALSE;
				$priv_del = TRUE;
				$other_btns = array();
				$other_btns[] = array(
					"class"  => "btn-info",
					"action" => "location.href='".route('mgr.users.product', ['user_id'=>$user_id, 'product_id'=>$item->product_id])."'",
					"text"   => "更新價格"
				);
				
				$this->data['data'][] = array(
					"id"         => $item->id,
					"data"       => $obj,
					"other_btns" => $other_btns,
					"priv_edit"  => $priv_edit,
					"priv_del"   => $priv_del
				);
			}

			return view('mgr/template_list', $this->data);
		}else{
			$data = UserProduct::orderBy('id','desc')->where(['user_id'=>$user_id, 'product_id'=>$product_id])->with('user')->with('product')->first();

			$param = array();
			for ($i=1; $i <= 10 ; $i++) { 
				$title_style = 'line-height:36px; float:right;';
				if ($i == 1) $title_style = 'line-height:95px; float:right;';
	
				$param[] = ['',						'',						'plain',   FALSE, '級距'.$i, 1, 12, '', $title_style];
				$param[] = [($i==1)?'級距起':'',		'range_start'.$i,		'number',   FALSE, 'KG', 2, 12, ''];
				$param[] = [($i==1)?'級距迄':'',		'range_end'.$i,			'number',   FALSE, 'KG', 2, 12, ''];
				$param[] = [($i==1)?'會員價格':'',		'price'.$i,				'number',   FALSE, '$', 2, 12, 'price price'.$i];
				$param[] = ['',						'',						'plain',   FALSE, '', 5, 12, ''];
			}

			if ($request->isMethod('post')) {
				$formdata = $this->process_post_data($param, $request);
				for ($i=1; $i <= 10 ; $i++) { 
					$price[] = array(
						'range_start' => intval($formdata['range_start'.$i]),
						'range_end'   => intval($formdata['range_end'.$i]),
						'price'       => intval($formdata['price'.$i]),
					);
				}
				$res = UserProduct::create([
					'user_id'      => $user_id,
					'product_id'   => $product_id,
					'product_name' => $data->product_name,
					'ex_price'     => $data->ex_price,
					'ex_quantity'  => $data->ex_quantity,
					'price'        => json_encode($price)
				]);
				
				if ($res) {
					$this->js_output_and_redirect('更新成功', 'mgr.users.product', ['user_id'=>$user_id]);
				} else {
					$this->js_output_and_back('編輯發生錯誤');
				}
				exit();
			}

			$this->data['title'] = "編輯會員".$user->username." 產品價格【".$data->product->name."】";
			$this->data['parent'] = "會員管理";
			$this->data['parent_url'] = route('mgr.users');
			$this->data['action'] = route('mgr.users.product', ['id'=>$user_id, 'product_id'=>$product_id]);
			$this->data['submit_txt'] = '確認更新';

			$fdata = array();
			$price = json_decode($data->price, TRUE);
			for ($i=0; $i < 10 ; $i++) { 
				$fdata['range_start'.($i+1)] = $price[$i]['range_start']??'';
				$fdata['range_end'.($i+1)] = $price[$i]['range_end']??'';
				$fdata['price'.($i+1)] = $price[$i]['price']??'';
			}

			$this->data['params'] = $this->generate_param_to_view($param, $fdata);

			return view('mgr/template_form', $this->data);
		}
	}

	public function product_price(Request $request){
		$user_id = $request->post('user_id');
		$product_id = $request->post('product_id');
		$data = UserProduct::orderBy('id','desc')->where(['user_id'=>$user_id, 'product_id'=>$product_id])->with('user')->with('product')->first();

		$is_new = false;
		if ($data == null) {
			$data = Product::price($product_id);
			$is_new = true;
		}
		if ($request->has('action') && $request->post('action') == 'save') {
			
			$price = array();
			for ($i=1; $i <= 10 ; $i++) { 
				$price[] = array(
					'range_start' => intval($request->post('range_start'.$i)),
					'range_end'   => intval($request->post('range_end'.$i)),
					'price'       => intval($request->post('price'.$i)),
				);
			}
			$res = false;
			if ($is_new) {
				$product = Product::find($product_id);
				$res = UserProduct::create([
					'user_id'      => $user_id,
					'product_id'   => $product_id,
					'product_name' => $product->name,
					'ex_price'     => 0,
					'ex_quantity'  => 0,
					'price'        => json_encode($price)
				]);
			}else{
				$res = UserProduct::create([
					'user_id'      => $user_id,
					'product_id'   => $product_id,
					'product_name' => $data->product_name,
					'ex_price'     => $data->ex_price,
					'ex_quantity'  => $data->ex_quantity,
					'price'        => json_encode($price)
				]);
			}
			
			
			if ($res) {
				$this->output(true, '儲存成功');
			} else {
				$this->output(false, '儲存發生錯誤');
			}
			exit();
		}


		$fdata = array();
		$price = array();
		if ($is_new) {
			$price = $data['range'];
		}else{
			$price = json_decode($data->price, TRUE);
		}
		
		for ($i=0; $i < 10 ; $i++) { 
			$fdata['range_start'.($i+1)] = $price[$i]['range_start']??'';
			$fdata['range_end'.($i+1)] = $price[$i]['range_end']??'';
			$fdata['price'.($i+1)] = $price[$i]['price_new']??$price[$i]['price'];
		}

		$html = view('mgr/price_form', [
			'data'	=>	$fdata,
			'id'	=>	$product_id
		])->render();

		$this->output(true, "success", ['html'=>$html, 'id'=>$product_id]);
	}
}