
<?php $__env->startSection('title'); ?> <?php echo e($title); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
mark{
    background-color: #ee900c !important;
    border-radius: 3px !important;
}
li.disabled .page{
    color: #AAA !important;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('mgr.components.breadcrumb', ['btns' => $btns??array()]); ?>
    <?php $__env->slot('li_1_url'); ?> <?php echo e($parent_url); ?> <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_1'); ?> <?php echo e($parent); ?> <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo e($title); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <?php if(isset($bar2_btns)): ?>
            <div class="col-12 row mb-2">
                <?php $__currentLoopData = $bar2_btns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-<?php echo e($btn[3]); ?>">
                    <button type="button" class="btn btn-<?php echo e($btn[2]); ?> btn-animation waves-effect waves-light" onclick="<?php echo e($btn[1]); ?>"><?php echo e($btn[0]); ?></button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <?php if(!isset($is_search) || $is_search): ?>
                                        <div class="input-group search-box ms-2 mb-2" style="width: 30%;">
                                            <input type="text" class="form-control search" style="border-color:#878a99;"placeholder="關鍵字搜尋">
                                            <button class="btn btn-outline-secondary search_action" type="button">搜尋</button>
                                            <button class="btn btn-outline-secondary search_clear_action" type="button" style="border-radius: 0 4px 4px 0;">清除</button>
                                            <i class="ri-search-line search-icon" style="z-index:99;"></i>
                                        </div>
                                        <?php endif; ?>

                                        <!-- <div class="search-box ms-2 mb-2">
                                            <input type="text" class="form-control search" placeholder="Search...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="table-responsive table-card mb-1">
                                        <table class="table align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <?php $__currentLoopData = $th_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <th scope="col" style="min-width:<?php echo e($th['width']); ?>;"><?php echo $th['title']; ?></th>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            </thead>
                                            <tbody id="content">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="pagination-wrap hstack gap-2" id="pagination">
                                            <ul class="pagination listjs-pagination mb-0">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            </div>

        </div>
        <?php if(isset($bar_btns)): ?>
            <div class="col-12 row mb-2">
                <?php $__currentLoopData = $bar_btns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-<?php echo e($btn[3]); ?>">
                    <button type="button" class="btn btn-<?php echo e($btn[2]); ?> btn-animation waves-effect waves-light" onclick="<?php echo e($btn[1]); ?>"><?php echo e($btn[0]); ?></button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form>
                    <div class="modal-body" id="detail_content">

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">關閉</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- point modal -->
<div id="point_modal" class="modal fade animated" role="dialog">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content" style="width: 160%;">
            <div class="modal-header bg-light p-3">
                <h5 class="modal_title" ></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>

                </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 text-center text-danger total_point"></div>

                    <div class="col-lg-12 text-center text-danger recently">

                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    
                                    
                                    
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="point_log_table" class="table table-striped dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>用途</th>
                                    <th>變動</th>
                                    <th>剩餘</th>
                                    <th>到期時間</th>
                                    <th>創建時間</th>
                                    <th>操作人員</th>
                                </tr>
                            </thead>
                            <tbody id="point_log">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- point modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- <script src="<?php echo e(URL::asset('js/app.min.js')); ?>"></script> -->

    <script src="<?php echo e(URL::asset('assets/libs/prismjs/prismjs.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/list.js/list.js.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js')); ?>"></script>

    <!-- listjs init -->
    <!-- <script src="<?php echo e(URL::asset('assets/js/pages/listjs.init.js')); ?>"></script> -->

    <script>
        let page = 1;
         let page_count = <?php echo e($page_count??25); ?>;
        let search = '';
        let can_order_column_indedx = <?php echo e((isset($can_order_fields))?json_encode($can_order_fields):'[]'); ?>;
        let default_order_column = <?php echo e(($default_order_column)??0); ?>;
        let order_direction = '<?php echo e(($default_order_direction)??"DESC"); ?>';
        $(document).ready(function(e){
            load_data(1);
            generate_order();
            <?php echo $custom_js_on_ready??''; ?>


            $(document).on('click', '.show_detail', function(event) {
                $.ajax({
                    type: "GET",
                    url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/detail/' + $(this).data('id'),
                    data: {
                    },
                    dataType: "json",
                    success: function(data){
                        if (data.status){
                            $("#detail_content").html(data.html);
                            $("#showModal").modal('show');
                        }
                    },
                    failure: function(errMsg) {
                        alert(errMsg);
                    }
                });
            });

            $(document).on('click', '.edit-item-btn', function(event) {
                var id = $(this).closest('tr').data('id');
                location.href = '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/edit/' + id;
            });

            $(document).on('click', '.del-item-btn', function(event) {
                if (!confirm("確定刪除此筆資料?")) return;

                var id = $(this).closest('tr').data('id');
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/del',
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(data){
                        if (data.status){
                            $("tr[data-id="+id+"]").fadeTo('fast', 0, function(e){
                                $(this).remove();
                            });
                        }
                    },
                    failure: function(errMsg) {
                        alert(errMsg);
                    }
                });
            });
            $(".search").on('keypress', function (ev) {
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    search = $(this).val();
                    load_data();
                }
            });
            $(".search_action").on('click', function () {
                search = $('input.search').val();
                load_data();
            });
            $('.search_clear_action').on('click', function () {
                search = '';
                $(".search").val('');
                load_data();
            });
             $(`select[name=page_count]`).on('change', function () {
                page_count = $(this).val();
                load_data(1);
            });
            $(".switch_toggle").on('change', function () {
                let status = 'on';
                if (!$(this).is(':checked')) status = 'off';
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/switch_toggle',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: $(this).data('id'),
                        status: status
                    },
                    dataType: "json",
                    success: function(data){
                        if (data.status){
                            if (status == 'on') {
                                Toastify({
                                    gravity: "top",
                                    position: "center",
                                    text: "已開啟",
                                    className: "success",
                                }).showToast();
                            }else{
                                Toastify({
                                    gravity: "top",
                                    position: "center",
                                    text: "已關閉",
                                    className: "danger",
                                }).showToast();
                            }
                        }
                    },
                    failure: function(errMsg) {
                        alert(errMsg);
                    }
                });
            });

        
            $(document).on('click', ".point-setting", function(event) {
                var id = $(this).closest('tr').data('id');
                    console.log('point_setting',id)
                        reloadPointLog(id);
                    $("#addpoint_member").val(id);

                    $("#point_modal .modal_title").html($("#username_"+id).html()+"(會員編號:"+id+") 點數");

                    $("#point_modal").modal("show");
             });
             $(document).on('click', "#point-submit", function(event) {
            var addpoint_type = $("#addpoint_type").val();
            var addpoint_amount = $("#addpoint_amount").val();
            var addpoint_msg = $("#addpoint_msg").val();
            var addpoint_deadline = $("#addpoint_deadline").val();
            var id = $("#addpoint_member").val();
            $.ajax({
                
                  url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/<?php echo e(((isset($tab))?$tab:'point_op')); ?>',
                data: {
                    id: id,
                     _token: '<?php echo e(csrf_token()); ?>',
                    type: addpoint_type,
                    amount: addpoint_amount,
                    msg: addpoint_msg,
                    deadline: addpoint_deadline
                },
                type: "POST",
                dataType: "json",
                success: function(msg){
                    if (msg.status) {
                        reloadPointLog(id);
                        $("#point_"+id).html(msg.result);
                    }else{
                        alert(msg.msg);
                    }
                },
                error:function(xhr, ajaxOptions, thrownError){ 
                    console.log(xhr,ajaxOptions,thrownError)
                    // alert(xhr.status); 
                    // alert(thrownError); 
                },
                complete:function(){
                    $("#addpoint_amount").val("");
                    $("#addpoint_msg").val("");
                    $("#addpoint_deadline").val("");
                }
            });
        }); 
                                
                              
        });
    function reloadPointLog(id){
   
            let data = {
                id:id,
                _token: '<?php echo e(csrf_token()); ?>',
                page: page,
                page_count: page_count,
                search: search,
                status: '<?php echo e($status??''); ?>',
                order: default_order_column,
                direction: order_direction,
            };

            $("#point_log").empty();
            $(".recently").html('');
            $(".total_point").html('');
            $.ajax({
                type: "POST",
                url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/<?php echo e(((isset($tab))?$tab:'point_log')); ?>',
                
                data: data,
                dataType: "json",
                success: function(msg){
                if (msg.status) {
                    for (var i = 0; i < msg.data.length; i++) {
                        var item = msg.data[i];
                        var changetxt = "";
                        var deadline = item['deadline'];

                        if (item['action'] == "plus") {
                            changetxt = '<span class="text text-success"> +'+item['amount']+'</span>';
                        }else{
                            changetxt = '<span class="text text-danger"> -'+item['amount']+'</span>';
                            deadline = '';
                        }
                        var tr = $("<tr/>").append(
                            $("<td/>").html(item['id'])
                        ).append(
                            $("<td/>").html(item['msg'])
                        ).append(
                            $("<td/>").html(changetxt).addClass('point')
                        ).append(
                            $("<td/>").html(item['remaining'])
                        ).append(
                            $("<td/>").html(deadline).addClass('deadline')
                        ).append(
                            $("<td/>").html(formatDate(item['created_at']))
                        ).append(
                            $("<td/>").html(item['operator'])
                        ).appendTo($("#point_log"));

                        if (item.is_expired) {
                            tr.addClass('expired');
                        }
                    }
                    $(".recently").html(msg.recently);
                    $(".total_point").html(msg.total_point);
                }else{
                    alert(msg.msg);
                }
            },
                failure: function(errMsg) {
                    alert(errMsg);
                }
            });

    } 

        function load_data(goToPage = false){
            if (goToPage != false) page = goToPage;

            let data = {
                _token: '<?php echo e(csrf_token()); ?>',
                page: page,
                page_count: page_count,
                search: search,
                status: '<?php echo e($status??''); ?>',
                order: default_order_column,
                direction: order_direction,
            };
            $.ajax({
                type: "POST",
                url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/<?php echo e(((isset($tab))?$tab:'data')); ?>',
                
                data: data,
                dataType: "json",
                success: function(data){
                     console.log(data)
                    if (data.status){
                        $("#content").html(data.html);

                        if (data.page !== undefined) {
                            $("#pagination").show();
                            generate_page(data.page, data.total_page);
                        }else{
                            $("#pagination").hide();
                        }
                    }

                    if (search != '') {
                        $.each( search.split(' '), function( index, s ) {
                            $("#content").find('td').each(function(index, el) {
                                if (!$(this).hasClass('no-search')) {
                                    var html = $(this).html();
                                    $(this).html(html.replace(s, '<mark data-markjs="true">'+s+'</mark>'));
                                }
                            });
                        });
                    }
                },
                failure: function(errMsg) {
                    alert(errMsg);
                }
            });
        }
        // 日期格式化函数
        function formatDate(isoString) {
            var date = new Date(isoString);
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            var hours = ('0' + date.getHours()).slice(-2);
            var minutes = ('0' + date.getMinutes()).slice(-2);
            var seconds = ('0' + date.getSeconds()).slice(-2);

            return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
        }
        function load_data_test(goToPage = false, action = 'normal', param = ''){
            if (goToPage != false) page = goToPage;

            let data = {
                _token: '<?php echo e(csrf_token()); ?>',
                page: page,
                page_count: page_count,
                search: search,
                status: status,
                order: default_order_column,
                direction: order_direction,
                action: action,
                start_date: start_date,
                end_date: end_date,
                query: query,
                param: param
            };
            $(document).find('.filter').each(function (index, element) {
                let name = $(this).attr('name');
                data[name] = $(this).val();
            });

            $(document).find('.filter_multi').each(function (index, element) {
                let name = $(this).data('name');
                if (data[name] == undefined || data[name] == null || data[name] == '') {
                    data[name] = new Array();
                }
                console.log(data[name])
                if ($(this).is(":checked")) data[name].push($(this).val());
            });
            
            if (action == 'export') {
                let data_str = $("#form").serialize()+`&action=export`;
                $.each(data, function (key, val) { 
                    data_str += `&${key}=${val}`;
                });
                // let ids = $("#form input:checkbox:checked").map(function(){
                //     return parseInt($(this).val());
                // }).get();
                // data_str += `&ids=${JSON.stringify(ids)}`;
                data = data_str;
            }
            $.ajax({
                type: "POST",
                url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/data<?php echo e(((isset($tab))?"/".$tab:'')); ?>',
                data: data,
                dataType: "json",
                success: function(data){
                    if (data.status){
                        if (action == 'export') {
                            window.open(data.url);
                            return;
                        }
                        if (data.html == '') {
                            $("#content").html(`<tr><td class="text-center text-secondary" colspan="<?php echo e(count($th_title)); ?>">查無資料</td></tr>`);
                        }else{
                            $("#content").html(data.html);
                        }
                        
                        if (data.total != undefined && data.page_count != undefined) {
                            $(`.footer_summary`).removeClass('d-none');
                            $(`.total_cnt`).html(data.total);
                            $(`.page_count`).val(data.page_count);
                            $(`.footer_summary`).parent('').removeClass('justify-content-end')
                                                           .addClass('justify-content-between');
                        }else{
                            $(`.footer_summary`).addClass('d-none');
                            $(`.footer_summary`).parent('').addClass('justify-content-end')
                                                           .removeClass('justify-content-between');
                        }
                        
                        $(".checkAll").prop('checked', false);

                        if (data.page == undefined || (data.page == 1 && data.page == data.total_page) || data.total_page == 0) {
                            $("#pagination").hide();
                        }else{
                            $("#pagination").show();
                            generate_page(data.page, data.total_page);
                        }
                    }

                    if (search != '') {
                        $.each( search.split(' '), function( index, s ) {
                            $("#content").find('td').each(function(index, el) {
                                if (!$(this).hasClass('no-search')) {
                                    if ($(this).children().length == 0) {
                                        var html = $(this).html();
                                        $(this).html(html.replace(s, '<mark data-markjs="true">'+s+'</mark>'));    
                                    }else{
                                        $(this).children().each(function (index, element) {
                                            if ($(this).children().length == 0) {
                                                var html = $(this).html();
                                                $(this).html(html.replace(s, '<mark data-markjs="true">'+s+'</mark>'));    
                                            }
                                        });
                                    }
                                }
                            });
                        });
                    }
                },
                failure: function(errMsg) {
                    alert(errMsg);
                }
            });
        }

        const page_range = 10;
        function generate_page(page, total_page){
            page = parseInt(page);
            var html = "";
            var first = Math.floor((page-1)/page_range) * page_range + 1;
            
            if (page == 1) {
                html = '<li class="previous disabled"><a class="page" href="javascript:;">Previous</a></li>';
            }else{
                html ='<li class="previous"><a class="page" href="javascript:load_data('+(page-1)+');">Previous</a></li>';
            }

            for (var i = first; i < first + page_range && i <= total_page ; i++) {
                html += '<li class="';
                if(i == page) html += ' active';
                html += '"><a class="page" href="javascript:load_data('+i+');">'+i+'</a></li>';
            }

            if (page == total_page) {
                html += '<li class="next disabled"><a class="page" href="javascript:;">Next</a></li>';
            }else{
                html += '<li class="next"><a class="page" href="javascript:load_data('+(page+1)+');">Next</a></li>';
            }

            // if (page != total_page) {
                html += '<li class="last"><a class="page" href="javascript:load_data('+(total_page)+');">Last('+total_page+')</a></li>';
            // }

            // html += '<li class="last"><a class="page" href="javascript:;" style="padding:0;"><input type="text" class="form-control curpage" style="width:56px; height:30px; border:0; text-align:center;" value="1"></a></li>';

            $("#pagination .pagination").html(html);
        }

        function generate_order(){
            $("table").find('th').each(function(index, el) {
                if (can_order_column_indedx.indexOf(index) != -1) {
                    if (index == default_order_column) {
                        $(this).append(
                            $("<button/>").addClass('btn order_btn btn-sm').css({
                                width: '25px',
                                height: '25px',
                                padding: 0
                            })
                            .html('<span class="ri-sort-'+((order_direction == "DESC")?'desc':'asc')+'"></span>')
                            .attr("data-index", index)
                        );
                    }else{
                        $(this).append(
                            $("<button/>").addClass('btn order_btn btn-sm').css({
                                width: '25px',
                                height: '25px',
                                padding: 0
                            }).html('<span class="ri-menu-line"></span>')
                            .attr("data-index", index)
                        );
                    }
                } 
            });
        }

        $(document).on('click', '.order_btn', function(event) {
            var selected_index = $(this).attr("data-index");
            if (selected_index == default_order_column) {
                if (order_direction == "DESC") {
                    order_direction = "ASC";
                }else{
                    order_direction = "DESC";
                }
            }else{
                default_order_column = selected_index;
                order_direction = "DESC";
            }
            $("table").find('th').each(function(index, el) {
                if (can_order_column_indedx.indexOf(index) != -1) {
                    if (index == default_order_column) {
                        if (order_direction == "DESC") {
                            $(this).find("button").html('<span class="ri-sort-desc"></span>');
                        }else{
                            $(this).find("button").html('<span class="ri-sort-asc"></span>');
                        }
                    }else{
                        $(this).find("button").html('<span class="ri-menu-line"></span>');
                    }
                } 
            });
            load_data(page);
        });

        function action(id, action){
            if (action == 'del' && !confirm('確定刪除?')) return;
            if (action == 'cancel' && !confirm('確定取消?')) return;
            $.ajax({
                type: "POST",
                url: '<?php echo e(env('APP_URL')); ?>/mgr/<?php echo e($controller??''); ?>/action',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: id,
                    action: action
                },
                dataType: "json",
                success: function(data){
                    if (data.status){
                        if (data.action == 'reload') {
                            window.location.reload();
                        }else if (data.action == 'redirect') {
                            location.href = data.url;
                        }else{
                            load_data();
                            if (data.msg != ''){
                                Toastify({
                                    // destination: "",
                                    gravity: "top", // `top` or `bottom`
                                    position: "center", // `left`, `center` or `right`
                                    text: data.msg,
                                    className: "success",
                                }).showToast();
                            }
                        }
                    }else{
                        Toastify({
                            gravity: "top",
                            position: "center",
                            text: data.msg,
                            className: "danger",
                        }).showToast();
                    }
                },
                failure: function(errMsg) {
                    alert(errMsg);
                }
            });
        }

        <?php echo $custom_js??''; ?>

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('mgr.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ichiban\resources\views/mgr/template_list_ajax.blade.php ENDPATH**/ ?>