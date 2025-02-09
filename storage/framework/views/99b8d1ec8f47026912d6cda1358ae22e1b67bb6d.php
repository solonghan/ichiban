<tr data-id="<?php echo e($item['id']); ?>">
    <?php $__currentLoopData = $item['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <td
        <?php if(isset($th_title[$index]) && $th_title[$index]['width'] != ''): ?>
        style = "max-width: <?php echo e($th_title[$index]['width']); ?>"
            
        <?php endif; ?>
    ><?php echo $obj; ?></td>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <td>
        <?php if(isset($item['other_btns'])): ?>
            <?php $__currentLoopData = $item['other_btns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button class="btn btn-sm <?php echo e($btn['class']); ?>" onclick="<?php echo e($btn['action']); ?>"><?php echo e($btn['text']); ?></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>


        <?php if(!isset($item['priv_edit']) || $item['priv_edit']): ?>
           
            <?php if(isset($item['privilege_id'])  && $item['privilege_id'] !=3): ?>
                <?php if(isset($item['member_department'])): ?>
                    
                        
                         
                         
                            <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
                            <?php if(!isset($item['priv_edit_academics']) || $item['priv_edit_academics']): ?>
                                 <button class="btn btn-sm btn-primary specialty_list-item-btn" style="color: #fff;background-color: green; border-color: green;">學門專長</button>
                                <button class="btn btn-sm btn-primary academics_list-item-btn" style="color: #fff;background-color: orange; border-color: orange;">學術專長</button>
                            <?php endif; ?>
                        
                    
                <?php else: ?>
                     <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
                <?php endif; ?>
            <?php elseif(isset($item['item_member_id'])  && $item['item_member_id'] != $item['member_id']): ?>
                <?php if(isset($item['member_department'])): ?>
                    <?php $__currentLoopData = $item['member_department']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m_department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($m_department != $item['my_department']): ?>
                         
                         <?php else: ?>
                            <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
                            <?php if(!isset($item['priv_edit_academics']) || $item['priv_edit_academics']): ?>
                                 <button class="btn btn-sm btn-primary specialty_list-item-btn" style="color: #fff;background-color: green; border-color: green;">學門專長</button>
                                <button class="btn btn-sm btn-primary academics_list-item-btn" style="color: #fff;background-color: orange; border-color: orange;">學術專長</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                     <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
                <?php endif; ?>
            <?php elseif(isset($item['item_member_id'])  && $item['item_member_id'] != $item['member_id']): ?>
                
                <?php if(isset($item['academic_w_id'])): ?>
                <?php $__currentLoopData = $item['academic_w_id']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_w_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!isset($item['priv_edit_academics']) || $item['priv_edit_academics']): ?>
                        <?php if($academic_w_id==$item['member_id']): ?>
                                    <button class="btn btn-sm btn-primary specialty_list-item-btn" style="color: #fff;background-color: green; border-color: green;">學門專長</button>
                                    <button class="btn btn-sm btn-primary academics_list-item-btn" style="color: #fff;background-color: orange; border-color: orange;">學術專長</button>
                         <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if(isset($item['member_department'])): ?>
                    <?php $__currentLoopData = $item['member_department']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m_department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($m_department != $item['my_department']): ?>
                         
                         <?php else: ?>
                            <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
                            <?php if(!isset($item['priv_edit_academics']) || $item['priv_edit_academics']): ?>
                                <button class="btn btn-sm btn-primary academics_list-item-btn" style="color: #fff;background-color: orange; border-color: orange;">學術專長</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                     <button class="btn btn-sm btn-primary edit-item-btn">編輯</button>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if(!isset($item['priv_del']) || $item['priv_del']): ?>
        <button class="btn btn-sm btn-danger del-item-btn">刪除</button>
        <?php endif; ?>

        

    </td>
</tr>
<script>
        $(document).ready(function(e){
            console.log(123);
           $(document).on('click', '.specialty_list-item-btn', function(event) {
                var id = $(this).closest('tr').data('id');
                location.href = '<?php echo e(env('APP_URL')); ?>/mgr/committeeman/specialty_list/' + id;
            });

             $(document).on('click', '.academics_list-item-btn', function(event) {
                var id = $(this).closest('tr').data('id');
                location.href = '<?php echo e(env('APP_URL')); ?>/mgr/committeeman/academics_list/' + id;
            });
            
            $(".switch_toggle_com").on('change', function () {
                let status = 'on';
                if (!$(this).is(':checked')) status = 'off';
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(env('APP_URL')); ?>/mgr/committeeman/switch_toggle_com',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: $(this).data('id'),
                        status: status
                    },
                    dataType: "json",
                    success: function(data){
                        
                    },
                    failure: function(errMsg) {
                        alert(errMsg);
                    }
                });
            });
            $(".switch_toggle").on('change', function () {
                let status = 'on';
                if (!$(this).is(':checked')) status = 'off';
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(env('APP_URL')); ?>/mgr/member/switch_toggle',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: $(this).data('id'),
                        status: status
                    },
                    dataType: "json",
                    success: function(data){
                        
                    },
                    failure: function(errMsg) {
                        alert(errMsg);
                    }
                });
            });
        });
    </script><?php /**PATH C:\xampp\htdocs\ntue_teacher_0509\resources\views/mgr/items/department_view_item.blade.php ENDPATH**/ ?>