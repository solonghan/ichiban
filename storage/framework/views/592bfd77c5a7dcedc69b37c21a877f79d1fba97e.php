<tr data-id="<?php echo e($item['id']); ?>">
    <?php $__currentLoopData = $item['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <td
        <?php if(isset($th_title[$index]) && $th_title[$index]['width'] != ''): ?>
        style = "max-width: <?php echo e($th_title[$index]['width']); ?>"
        <?php endif; ?>
    ><?php echo $obj; ?>

    </td>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <td>
        <?php if(isset($item['other_btns'])): ?>
            <?php $__currentLoopData = $item['other_btns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button class="btn btn-sm <?php echo e($btn['class']); ?>" onclick="<?php echo e($btn['action']); ?>"><?php echo e($btn['text']); ?></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!isset($item['priv_view']) || $item['priv_view']): ?>
        <button type="button" class="btn btn-sm btn-success edit-item-btn">瀏覽</button>
        <?php endif; ?>

        <?php if(!isset($item['priv_edit']) || $item['priv_edit']): ?>
        <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
        <?php endif; ?>
        
        <?php if(!isset($item['priv_del']) || $item['priv_del']): ?>
        <button class="btn btn-sm btn-danger del-item-btn">刪除</button>
        <?php endif; ?>

    </td>
</tr>
<script>
    $(document).ready(function(e){

        $(".switch_toggle").off('change').on('change', function () {
            let status = 'on';
            if (!$(this).is(':checked')) status = 'off';
            console.log(status);
            console.log($(this).data());
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
                    // Uncomment if you want to show toast notifications
                     if (data.status){
                         if (status == 'on') {
                             Toastify({
                                 gravity: "top",
                                 position: "center",
                                 text: "已開啟",
                                 className: "success",
                             }).showToast();
                         } else {
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
    });
</script>
<?php /**PATH C:\xampp\htdocs\ichiban\resources\views/mgr/items/template_item.blade.php ENDPATH**/ ?>