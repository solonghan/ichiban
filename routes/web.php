<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

use App\Http\Middleware\Locale;

use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('pdf', [PdfController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [Mgr\DashboardController::class, 'index'])->name('home');
Route::match(array('GET','POST'),'util/{any?}', [BaseController::class, 'util'])->name('util');

// Route::match(array('GET','POST'),'util/title_data', [BaseController::class, 'title_data'])->name('title_data');
// Route::match(array('GET','POST'),'util/unit_data', [BaseController::class, 'unit_data'])->name('unit_data');

Route::get('locale/{locale}', [HomeController::class, 'swtich_locale'])->name('locale');
Route::post('signin', [HomeController::class, 'login'])->name('signin');
Route::post('linebot/callback', [LineBotController::class, 'callback']);
Route::get('linebot/send', [LineBotController::class, 'send']);

// Route::group([
//    'prefix' =>  Locale::prefix((string)(Request::segment(1))) 
// ], function() {
//     Route::get('/', [HomeController::class, 'index'])->name('home');
//     Route::get('about', [HomeController::class, 'about'])->name('about');
//     Route::get('brand', [HomeController::class, 'brand'])->name('brand');
//     Route::get('brand/{id}', [HomeController::class, 'brand_detail'])->name('brand.detail');
//     Route::get('news', [HomeController::class, 'news'])->name('news');
//     Route::get('news/list', [HomeController::class, 'news_list'])->name('news.list');
//     Route::get('news/{id}', [HomeController::class, 'news_detail'])->name('news.detail');
//     Route::get('products', [ProductController::class, 'index'])->name('products');
//     Route::get('products/search/{keyword?}', [ProductController::class, 'search'])->name('products.search');
//     Route::get('products/{id}', [ProductController::class, 'detail'])->name('products.detail');
//     Route::match(array('GET','POST'),'contact', [HomeController::class, 'contact'])->name('contact');
//     Route::match(array('GET','POST'),'products/data', [ProductController::class, 'data'])->name('products.data');
    
//     Route::get('shopping_flow', [HomeController::class, 'shopping_flow'])->name('shopping_flow');
//     Route::get('payment_method', [HomeController::class, 'payment_method'])->name('payment_method');
//     Route::get('privacy', [HomeController::class, 'privacy'])->name('privacy');
    
//     Route::get('login', [HomeController::class, 'login'])->name('login');
//     Route::match(array('GET','POST'),'register/{step?}', [HomeController::class, 'register'])->name('register');
//     Route::match(array('GET','POST'),'register_invoice', [HomeController::class, 'register_invoice'])->name('register_invoice');
//     Route::match(array('GET','POST'),'register_recpient', [HomeController::class, 'register_recpient'])->name('register_recpient');
//     Route::match(array('GET','POST'),'forgetpwd', [HomeController::class, 'forgetpwd'])->name('forgetpwd');
    
//     Route::get('member', [MemberController::class, 'index'])->name('member');
//     Route::match(array('GET','POST'),'member/edit', [MemberController::class, 'edit'])->name('member.edit');
//     Route::match(array('GET','POST'),'member/add_invoice', [MemberController::class, 'add_invoice'])->name('member.add_invoice');
//     Route::match(array('GET','POST'),'member/edit_invoice', [MemberController::class, 'edit_invoice'])->name('member.edit_invoice');
//     Route::match(array('GET','POST'),'member/del_invoice/{id?}', [MemberController::class, 'del_invoice'])->name('member.del_invoice');
//     Route::match(array('GET','POST'),'member/add_recipient', [MemberController::class, 'add_recipient'])->name('member.add_recipient');
//     Route::match(array('GET','POST'),'member/edit_recipient', [MemberController::class, 'edit_recipient'])->name('member.edit_recipient');
//     Route::match(array('GET','POST'),'member/del_recipient/{id?}', [MemberController::class, 'del_recipient'])->name('member.del_recipient');
//     Route::match(array('GET','POST'),'member/bill', [MemberController::class, 'bill'])->name('member.bill');
//     Route::match(array('GET','POST'),'member/bill/again', [MemberController::class, 'bill_again'])->name('member.bill.again');
//     Route::match(array('GET','POST'),'member/bill/confirm', [MemberController::class, 'bill_confirm'])->name('member.bill.confirm');
//     Route::match(array('GET','POST'),'member/bill/exchange', [MemberController::class, 'bill_exchange'])->name('member.bill.exchange');
//     Route::match(array('GET','POST'),'member/bill/return', [MemberController::class, 'bill_return'])->name('member.bill.return');

//     Route::get('cart', [CartController::class, 'index'])->name('cart');
//     Route::get('cart/step2', [CartController::class, 'step2'])->name('cart.step2');
//     Route::post('cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');
//     Route::post('cart/copy', [CartController::class, 'copy'])->name('cart.copy');
//     Route::match(array('GET','POST'),'cart/add', [CartController::class, 'add'])->name('cart.add');
//     Route::match(array('GET','POST'),'cart/update', [CartController::class, 'update'])->name('cart.update');
//     Route::match(array('GET','POST'),'cart/del', [CartController::class, 'del'])->name('cart.del');
    
//     Route::get('order/{order_no}', [OrderController::class, 'index'])->name('order');
//     Route::get('order/quotation/{order_no}', [OrderController::class, 'quotation'])->name('order.quotation');

//     Route::get('logout', [MemberController::class, 'logout'])->name('logout');
// });

Route::prefix('mgr')->name('mgr.')->group(function (){
    // Auth::routes();
    // Authentication Routes...
    Route::get('/', [Mgr\DashboardController::class, 'index'])->name('home');
    Route::get('simulate/{id?}', [Mgr\DashboardController::class, 'simulate_login'])->name('simulate');
    Route::get('login', [Mgr\SigninController::class, 'showLoginForm'])->name('login');
    Route::post('login', [Mgr\SigninController::class, 'login'])->name('login');
    Route::post('logout', [Mgr\SigninController::class, 'logout'])->name('logout');

    Route::get('about', [Mgr\AboutController::class, 'index'])->name('about');
    Route::match(array('GET','POST'),'about/add', [Mgr\AboutController::class, 'add'])->name('about.add');
    Route::match(array('GET','POST'),'about/edit/{id?}', [Mgr\AboutController::class, 'edit'])->name('about.edit');
    Route::post('about/del', [Mgr\AboutController::class, 'del'])->name('about.del');

    Route::get('company', [Mgr\CompanyController::class, 'index'])->name('company');
    Route::match(array('GET','POST'),'company/add', [Mgr\CompanyController::class, 'add'])->name('company.add');
    Route::match(array('GET','POST'),'company/edit/{id?}', [Mgr\CompanyController::class, 'edit'])->name('company.edit');
    Route::post('company/del', [Mgr\CompanyController::class, 'del'])->name('company.del');

    Route::get('contact', [Mgr\ContactController::class, 'index'])->name('contact');
    // Route::match(array('GET','POST'),'contact/add', [Mgr\CompanyController::class, 'add'])->name('contact.add');
    Route::match(array('GET','POST'),'contact/success/{id?}', [Mgr\ContactController::class, 'success'])->name('contact.success');
    Route::post('contact/del', [Mgr\ContactController::class, 'del'])->name('contact.del');
    
    Route::get('agency_brand', [Mgr\AgencyBrandController::class, 'index'])->name('agency_brand');
    Route::match(array('GET','POST'),'agency_brand/add', [Mgr\AgencyBrandController::class, 'add'])->name('agency_brand.add');
    Route::match(array('GET','POST'),'agency_brand/edit/{id?}', [Mgr\AgencyBrandController::class, 'edit'])->name('agency_brand.edit');
    Route::post('agency_brand/del', [Mgr\AgencyBrandController::class, 'del'])->name('agency_brand.del');

    Route::get('carousel', [Mgr\CarouselController::class, 'index'])->name('carousel');
    Route::match(array('GET','POST'),'carousel/add', [Mgr\CarouselController::class, 'add'])->name('carousel.add');
    Route::match(array('GET','POST'),'carousel/edit/{id?}', [Mgr\CarouselController::class, 'edit'])->name('carousel.edit');
    Route::post('carousel/del', [Mgr\CarouselController::class, 'del'])->name('carousel.del');

    Route::get('page_banner', [Mgr\PageBannerController::class, 'index'])->name('page_banner');
    Route::match(array('GET','POST'),'page_banner/add', [Mgr\PageBannerController::class, 'add'])->name('page_banner.add');
    Route::match(array('GET','POST'),'page_banner/edit/{id?}', [Mgr\PageBannerController::class, 'edit'])->name('page_banner.edit');
    Route::post('page_banner/del', [Mgr\PageBannerController::class, 'del'])->name('page_banner.del');
    
    Route::match(array('GET','POST'),'setting', [Mgr\SettingController::class, 'index'])->name('settings');
    Route::match(array('GET','POST'),'setting/page/{type?}', [Mgr\SettingController::class, 'page'])->name('setting');
    Route::match(array('GET','POST'),'setting/page/shopping_flow', [Mgr\SettingController::class, 'page'])->name('setting.shopping_flow');
    Route::match(array('GET','POST'),'setting/page/payment', [Mgr\SettingController::class, 'page'])->name('setting.payment');
    Route::match(array('GET','POST'),'setting/page/privacy', [Mgr\SettingController::class, 'page'])->name('setting.privacy');
    Route::match(array('GET','POST'),'setting/page/home_intro', [Mgr\SettingController::class, 'page'])->name('setting.home_intro');
    Route::match(array('GET','POST'),'setting/page/default_carousel', [Mgr\SettingController::class, 'page'])->name('setting.default_carousel');
    Route::match(array('GET','POST'),'setting/page/footer_intro', [Mgr\SettingController::class, 'page'])->name('setting.footer_intro');

    // Route::get('news/{lang?}', [Mgr\NewsController::class, 'index'])->name('news.tw');
    // Route::get('news/en', [Mgr\NewsController::class, 'index'])->name('news.en');
    // Route::match(array('GET','POST'),'news/add/{lang?}', [Mgr\NewsController::class, 'add'])->name('news.add');
    // Route::match(array('GET','POST'),'news/edit/{id?}', [Mgr\NewsController::class, 'edit'])->name('news.edit');
    // Route::post('news/del', [Mgr\NewsController::class, 'del'])->name('news.del');

    // 最新消息
    Route::get('news', [Mgr\NewsController::class, 'index'])->name('news');

    Route::match(array('GET','POST'),'news/data', [Mgr\NewsController::class, 'data'])->name('news.data');
    Route::match(array('GET','POST'),'news/add', [Mgr\NewsController::class, 'add'])->name('news.add');
    Route::match(array('GET','POST'),'news/edit/{id?}', [Mgr\NewsController::class, 'edit'])->name('news.edit');
    Route::post('news/del', [Mgr\NewsController::class, 'del'])->name('news.del');

    // 常見問題
    Route::get('faq', [Mgr\FaqController::class, 'index'])->name('faq');
    Route::match(array('GET','POST'),'faq/data', [Mgr\FaqController::class, 'data'])->name('faq.data');
    Route::match(array('GET','POST'),'faq/add', [Mgr\FaqController::class, 'add'])->name('faq.add');
    Route::match(array('GET','POST'),'faq/edit/{id?}', [Mgr\FaqController::class, 'edit'])->name('faq.edit');
    Route::post('faq/del', [Mgr\FaqController::class, 'del'])->name('faq.del');
    Route::post('faq/switch_toggle', [Mgr\FaqController::class, 'switch_toggle'])->name('faq.switch_toggle');

    Route::get('product_category', [Mgr\ProductCategoryController::class, 'index'])->name('product_category');
    Route::match(array('GET','POST'),'product_category/add', [Mgr\ProductCategoryController::class, 'add'])->name('product_category.add');
    Route::match(array('GET','POST'),'product_category/edit/{id?}', [Mgr\ProductCategoryController::class, 'edit'])->name('product_category.edit');
    Route::post('product_category/del', [Mgr\ProductCategoryController::class, 'del'])->name('product_category.del');

    Route::get('product_classify', [Mgr\ProductClassifyController::class, 'index'])->name('product_classify');
    Route::match(array('GET','POST'),'product_classify/add', [Mgr\ProductClassifyController::class, 'add'])->name('product_classify.add');
    Route::match(array('GET','POST'),'product_classify/edit/{id?}', [Mgr\ProductClassifyController::class, 'edit'])->name('product_classify.edit');
    Route::post('product_classify/del', [Mgr\ProductClassifyController::class, 'del'])->name('product_classify.del');

  
   
    Route::get('product', [Mgr\ProductController::class, 'index'])->name('product');
    Route::match(array('GET','POST'),'product/data', [Mgr\ProductController::class, 'data'])->name('product.data');
    Route::match(array('GET','POST'),'product/add', [Mgr\ProductController::class, 'add'])->name('product.add');
    Route::match(array('GET','POST'),'product/edit/{id?}', [Mgr\ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/del', [Mgr\ProductController::class, 'del'])->name('product.del');

    Route::match(array('GET','POST'),'product/awards/{product_id?}', [Mgr\ProductController::class, 'awards'])->name('product.awards');
    Route::match(array('GET','POST'),'product/awards_data/{product_id?}', [Mgr\ProductController::class, 'awards_data'])->name('product.awards_data');

    Route::post('product/check/{id?}', [Mgr\ProductController::class, 'check'])->name('product.check');

   
  

    // 商品獎賞
    Route::get('product_awards', [Mgr\ProductAwardsController::class, 'index'])->name('product_awards');
    Route::match(array('GET','POST'),'product_awards/data', [Mgr\ProductAwardsController::class, 'data'])->name('product_awards.data');
    Route::match(array('GET','POST'),'product_awards/add', [Mgr\ProductAwardsController::class, 'add'])->name('product_awards.add');
    Route::match(array('GET','POST'),'product_awards/edit/{id?}', [Mgr\ProductAwardsController::class, 'edit'])->name('product_awards.edit');
    Route::post('product_awards/del', [Mgr\ProductAwardsController::class, 'del'])->name('product_awards.del');
    
     // 商品標籤
    Route::get('tags', [Mgr\TagsController::class, 'index'])->name('tags');
    Route::match(array('GET','POST'),'tags/data', [Mgr\TagsController::class, 'data'])->name('tags.data');
    Route::match(array('GET','POST'),'tags/add', [Mgr\TagsController::class, 'add'])->name('tags.add');
    Route::match(array('GET','POST'),'tags/edit/{id?}', [Mgr\TagsController::class, 'edit'])->name('tags.edit');
    Route::post('tags/del', [Mgr\TagsController::class, 'del'])->name('tags.del');

     // 合作島主
     Route::get('cooperative_store', [Mgr\CooperativeStoreController::class, 'index'])->name('cooperative_store');
     Route::match(array('GET','POST'),'cooperative_store/data', [Mgr\CooperativeStoreController::class, 'data'])->name('cooperative_store.data');
     Route::match(array('GET','POST'),'cooperative_store/add', [Mgr\CooperativeStoreController::class, 'add'])->name('cooperative_store.add');
     Route::match(array('GET','POST'),'cooperative_store/edit/{id?}', [Mgr\CooperativeStoreController::class, 'edit'])->name('cooperative_store.edit');
     Route::post('cooperative_store/del', [Mgr\CooperativeStoreController::class, 'del'])->name('cooperative_store.del');
     Route::post('cooperative_store/switch_toggle', [Mgr\CooperativeStoreController::class, 'switch_toggle'])->name('cooperative_store.switch_toggle');
   

    // Route::match(array('GET','POST'),'users/product/{user_id?}', [Mgr\UserController::class, 'product'])->name('users.product');
    Route::match(array('GET','POST'),'users/product_price', [Mgr\UserController::class, 'product_price'])->name('users.product_price');
    Route::match(array('GET','POST'),'users/product/{user_id?}/{product_id?}', [Mgr\UserController::class, 'product'])->name('users.product');
    Route::match(array('GET','POST'),'users/add', [Mgr\UserController::class, 'add'])->name('users.add');
    Route::match(array('GET','POST'),'users/edit/{id?}', [Mgr\UserController::class, 'edit'])->name('users.edit');
    Route::match(array('GET','POST'),'users/review/{id?}', [Mgr\UserController::class, 'review'])->name('users.review');
    
    Route::match(array('GET','POST'),'users/point_log', [Mgr\UserController::class, 'point_log'])->name('users.point_log');
    Route::match(array('GET','POST'),'users/point_op', [Mgr\UserController::class, 'point_op'])->name('users.point_op');
    Route::match(array('GET','POST'),'users/data', [Mgr\UserController::class, 'data'])->name('users.data');
    Route::post('users/del', [Mgr\UserController::class, 'del'])->name('users.del');
    Route::get('users/{status?}', [Mgr\UserController::class, 'index'])->name('users');
    Route::get('users/new', [Mgr\UserController::class, 'index'])->name('users.new');

    // 20240703 收件常用地址recipient
    Route::match(array('GET','POST'),'users/recipientUid/{user_id?}', [Mgr\UserController::class, 'recipient'])->name('users.recipient');
    Route::match(array('GET','POST'),'users/recipient/data/{user_id?}', [Mgr\UserController::class, 'recipient_data'])->name('users.recipient_data');
    Route::match(array('GET','POST'),'users/recipientUid/add/{user_id?}', [Mgr\UserController::class, 'recipient_add'])->name('users.recipient_add');
    Route::match(array('GET','POST'),'users/recipient/edit/{recipient_id?}', [Mgr\UserController::class, 'recipient_edit'])->name('users.recipient_edit');
    // // Route::match(array('GET','POST'),'users/recipient/{user_id?}', [Mgr\UserController::class, 'recipient'])->name('users.recipient');
    // Route::match(array('GET','POST'),'recipient/Uid/{user_id?}', [Mgr\UserController::class, 'recipient'])->name('users.recipient');
    // Route::match(array('GET','POST'),'recipient/data/{user_id?}', [Mgr\UserController::class, 'recipient_data'])->name('users.recipient_data');
    // Route::match(array('GET','POST'),'recipient/add/Uid/{user_id?}', [Mgr\UserController::class, 'recipient_add'])->name('users.recipient_add');
    // Route::match(array('GET','POST'),'recipient/edit/{recipient_id?}', [Mgr\UserController::class, 'recipient_edit'])->name('users.recipient_edit');
    // // Route::match(array('GET','POST'),'users/recipient_edit/{user_id?}/{recipient_id?}', [Mgr\UserController::class, 'recipient_edit'])->name('users.recipient_edit');



    Route::get('order', [Mgr\OrderController::class, 'index'])->name('order');
    Route::match(array('GET','POST'), 'order/data', [Mgr\OrderController::class, 'data'])->name('order.data');
    Route::match(array('GET','POST'), 'order/export', [Mgr\OrderController::class, 'export'])->name('order.export');
    Route::match(array('GET','POST'), 'order/notification/{id?}/{action?}', [Mgr\OrderController::class, 'notification'])->name('order.notification');
    Route::get('order/detail/{id?}', [Mgr\OrderController::class, 'detail'])->name('order.detail');
    Route::match(array('GET','POST'),'order/action/{action?}', [Mgr\OrderController::class, 'action'])->name('order.action');
    Route::match(array('GET','POST'),'order/quantity_change', [Mgr\OrderController::class, 'quantity_change'])->name('order.quantity_change');
    
    
    Route::get('member', [Mgr\MemberController::class, 'index'])->name('member');
    Route::match(array('GET','POST'),'member/add', [Mgr\MemberController::class, 'add'])->name('member.add');
    Route::match(array('GET','POST'),'member/data', [Mgr\MemberController::class, 'data'])->name('member.data');
    Route::match(array('GET','POST'),'member/edit/{id?}', [Mgr\MemberController::class, 'edit'])->name('member.edit');
    Route::post('member/del', [Mgr\MemberController::class, 'del'])->name('member.del');
    Route::post('member/switch_toggle', [Mgr\MemberController::class, 'switch_toggle'])->name('member.switch_toggle');
    Route::post('member/switch_toggle_com', [Mgr\MemberController::class, 'switch_toggle_com'])->name('member.switch_toggle_com');
    Route::get('member/unlink_line/{id?}', [Mgr\MemberController::class, 'unlink_line'])->name('member.unlink_line');

   
    Route::get('privilege', [Mgr\PrivilegeController::class, 'index'])->name('privilege');
    Route::match(array('GET','POST'),'privilege/add', [Mgr\PrivilegeController::class, 'add'])->name('privilege.add');
    Route::match(array('GET','POST'),'privilege/edit/{id?}', [Mgr\PrivilegeController::class, 'edit'])->name('privilege.edit');
    Route::post('privilege/del', [Mgr\PrivilegeController::class, 'del'])->name('privilege.del');

    Route::match(array('GET','POST'),'report/stock/{action?}', [Mgr\ReportController::class, 'stock'])->name('report.stock');
    Route::match(array('GET','POST'),'report/company/{action?}', [Mgr\ReportController::class, 'company'])->name('report.company');
    Route::match(array('GET','POST'),'report/collection/{action?}', [Mgr\ReportController::class, 'collection'])->name('report.collection');
    Route::match(array('GET','POST'),'report/bill/{action?}', [Mgr\ReportController::class, 'bill'])->name('report.bill');

  
    Route::match(array('GET','POST'),'mail/log', [Mgr\MailController::class, 'log'])->name('mail.log');
    Route::match(array('GET','POST'),'mail/data', [Mgr\MailController::class, 'data'])->name('mail.data');
    Route::match(array('GET','POST'),'mail/word', [Mgr\MailController::class, 'word'])->name('mail.word');

    Route::get('{any}', [Mgr\DashboardController::class, 'index']);

    Route::fallback([Mgr\DashboardController::class, 'index']);
});



// Route::fallback([Mgr\NewsController::class, 'list']);
