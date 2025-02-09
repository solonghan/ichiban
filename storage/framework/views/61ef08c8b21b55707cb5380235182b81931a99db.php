
<?php $__env->startSection('title'); ?> <?php echo e($title); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/quill/quill.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('css/cropper.min.css')); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="dist/cropper.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css" />
<style>
.menu{
    cursor: pointer;
}
.del-btn {
    position: absolute;
    top: 2px;
    left: 14px;
    margin: 3%;
    height: 25px;
    width: 25px;
    line-height: 25px;
    padding: 0 !important;
}

.pics.row {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
}

.pics.row>[class*='col-'] {
    display: flex;
    flex-direction: column;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('mgr.components.breadcrumb'); ?>
<?php $__env->slot('li_1_url'); ?> <?php echo e($parent_url); ?> <?php $__env->endSlot(); ?>
<?php $__env->slot('li_1'); ?> <?php echo e($parent); ?> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> <?php echo e($title); ?> <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="" method="POST" enctype="multipart/form-data" id="form" name="myForm">
                <?php echo csrf_field(); ?>
                <div class="card-body row">
                    <?php $__currentLoopData = $params; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-<?php echo e($param['layout_l']); ?> col-sm-<?php echo e($param['layout_s']); ?>">
                        <div class="mb-3">
                            <?php if($param['type'] == 'block'): ?>

                            <?php endif; ?>

                            

                            <?php if($param['type'] == 'header'): ?>
                            <div class="border mt-3 border-dashed" style="margin-bottom: 15px;"></div>
                            <h4><?php echo e($param['title']); ?></h4>
                            <?php elseif($param['type'] == 'content'): ?>
                            <span><?php echo e($param['title']); ?></span>
                            <?php elseif($param['title'] != ''): ?>
                            <label class="form-label" for="<?php echo e($param['field']); ?>">  
                                <?php if($param['title']=='曾任服務單位~'): ?>
                                
                                     <div class="old_unit_title"></div>
                                <?php elseif($param['title']=='單位名稱~'): ?>
                                    <div class="old_unit_name_title"></div>
                                <?php elseif($param['title']=='職稱~'): ?>
                                    <div class="old_Jtitle"></div>
                                <?php else: ?>
                                <?php echo e($param['title']); ?>

                                 <?php endif; ?>
                               
                                <?php if($param['required']): ?>
                         
                                <span class="badge rounded-pill bg-danger">必填</span> 
                                <?php endif; ?>
                            </label>

                                <?php if($param['type'] == 'day'): ?>
                                    
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($param['type'] == 'plain'): ?>
                            <div style="<?php echo e($param['option']??''); ?>" class="<?php echo e($param['class']); ?>">
                                <?php echo e($param['hint']); ?>

                            </div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'text'): ?>
                            <input type="text" class="form-control <?php echo e($param['class']); ?>" id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                value="<?php echo e($param['value']??''); ?>">
                            <?php endif; ?>

                            <?php if($param['type'] == 'text_search'): ?>
                            <input type="text" class="form-control <?php echo e($param['class']); ?>" id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                value="<?php echo e($param['value']??''); ?>">

                            <br>
                            <div class="col-lg-12 col-sm-12">
                            <input type="hidden" name=button_type value="add">
                             <buttton type="button" class="btn d-grid btn-primary submit_search_btn"><?php echo e($submit_search_txt??'送出'); ?></button>
                            </div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'text_old_unit'): ?>
                            
                            <div class="old_unit_name_input"></div>
                           
                            <?php endif; ?>
                            

                            <?php if($param['type'] == 'text_readonly'): ?>
                            <input type="text" class="form-control <?php echo e($param['class']); ?>" id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                value="<?php echo e($param['value']??''); ?>" readonly>
                            <?php endif; ?>

                            <?php if($param['type'] == 'password'): ?>
                            <input type="password" class="form-control <?php echo e($param['class']); ?>" id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                value="<?php echo e($param['value']??''); ?>" autocomplete="off">
                            <?php endif; ?>

                            <?php if($param['type'] == 'number'): ?>
                            <input type="number" class="form-control <?php echo e($param['class']); ?>" id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                value="<?php echo e($param['value']??''); ?>">
                            <?php endif; ?>

                            <?php if($param['type'] == 'day'): ?>
                            <input type="text" class="form-control <?php echo e($param['class']); ?>" id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" data-provider="flatpickr" data-date-format="Y-m-d"
                                placeholder="<?php echo e($param['hint']); ?>" value="<?php echo e($param['value']??''); ?>">
                                
                            <?php endif; ?>



                            <?php if($param['type'] == 'checkbox'): ?>
                            <br>
                            <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                value="<?php echo e($param['value']??''); ?>">
                                <label for="vehicle1">是</label><br>
                                
                            <?php endif; ?>

                            <?php if($param['type'] == 'checkbox_2'): ?>
                            <br>
                             <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>教授</span>
                            </label>
                            <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>副教授</span>
                            </label>
                            <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>助理教授</span>
                            </label>
                            <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>研究員</span>
                            </label>
                            <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>副研究員</span>
                            </label>
                            <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>助研究員</span>
                            </label>
                            <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>研究助理</span>
                            </label>
                            <label>
                                <input type="checkbox"  id="<?php echo e($param['field']); ?>"
                                    name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                    value="<?php echo e($param['value']??''); ?>">
                                <span>助理</span>
                            </label>
                            
                           
                                
                            <?php endif; ?>

                            <?php if($param['type'] == 'select'): ?>
                            <select class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>">
                           

                                <?php $__currentLoopData = $select[$param['field']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                                <option value="<?php echo e($item[$param['option'][0]]); ?>"
                                    <?php if($param['value']==$item[$param['option'][0]]): ?> selected <?php endif; ?>>
                                    <?php echo e($item[$param['option'][1]]); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>

                            <?php if($param['type'] == 'select_firstALL'): ?>
                            <select class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>">
                                    <option value="100"
                                    <?php if($param['value']=='100'): ?> selected <?php endif; ?>>
                                    <?php echo e('所有學門'); ?></option>

                                <?php $__currentLoopData = $select[$param['field']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                                <option value="<?php echo e($item[$param['option'][0]]); ?>"
                                    <?php if($param['value']==$item[$param['option'][0]]): ?> selected <?php endif; ?>>
                                    <?php echo e($item[$param['option'][1]]); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>

                            <?php if($param['type'] == 'select_now'): ?>
                            <select class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>">
                                <?php $__currentLoopData = $select[$param['field']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                                <option value="<?php echo e($item[$param['option'][0]]); ?>"
                                    <?php if($param['value']==$item[$param['option'][0]]): ?> selected <?php endif; ?>>
                                    <?php echo e($item[$param['option'][1]]); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="now_inner"></div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'select_old'): ?>
                            <select class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>">
                                <?php $__currentLoopData = $select[$param['field']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                                <option value="<?php echo e($item[$param['option'][0]]); ?>"
                                    <?php if($param['value']==$item[$param['option'][0]]): ?> selected <?php endif; ?>>
                                    <?php echo e($item[$param['option'][1]]); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="old_inner"></div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'select_old_title'): ?>
                            
                            <div class="old_title_data"></div>
                            
                            <div class="old_inner"></div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'select_old_unit'): ?>
                            <div class="old_unit_data">
                                    
                                    
                                    
                                   
                            </div>
                             <?php endif; ?>
                            

                            <?php if($param['type'] == 'select_button'): ?>
                            <select class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>">
                                <?php $__currentLoopData = $select[$param['field']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                                <option value="<?php echo e($item[$param['option'][0]]); ?>"
                                    <?php if($param['value']==$item[$param['option'][0]]): ?> selected <?php endif; ?>>
                                    <?php echo e($item[$param['option'][1]]); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                             
                            <?php endif; ?>

                            <?php if($param['type'] == 'select_2'): ?>
                            <select class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>">
                                <?php $__currentLoopData = $select[$param['field']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                                <optgroup label="<?php echo e($item[$param['option'][0]]); ?>">
                                
                                    <?php $__currentLoopData = $unit_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($classify->unit_classify == $name->unit_classify): ?>
                                         <option value="<?php echo e($name->id); ?>"><?php echo e($name->unit_name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>

  
                            <?php if($param['type'] == 'select_multi'): ?>
                            <select class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>[]"
                                data-choices data-choices-removeItem multiple>
                                <?php $__currentLoopData = $select[$param['field']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                                <option value="<?php echo e($item[$param['option'][0]]); ?>"
                                    
                                    <?php if(is_array($param['value']) && in_array($item[$param['option'][0]], $param['value'])): ?> selected <?php endif; ?>>
                                    <?php echo e($item[$param['option'][1]]); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>

                            <?php if($param['type'] == 'textarea'): ?>
                            <textarea class="form-control <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>"
                                style="height:<?php echo e($param['option']['height']??'100'); ?>px;"><?php echo e($param['value']); ?></textarea>
                            <?php endif; ?>

                            <?php if($param['type'] == 'editor'): ?>
                            <!--  ckeditor-classic -->
                            <!-- <div class="snow-editor <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>"
                                style="height:<?php echo e($param['option']['height']??'200'); ?>px;"><?php echo $param['value']; ?></div>
                            <input type="hidden" name="<?php echo e($param['field']); ?>" id="<?php echo e($param['field']); ?>"> -->
                            <textarea class="ckeditor <?php echo e($param['class']); ?>" name="<?php echo e($param['field']); ?>"
                                style="height:<?php echo e($param['option']['height']??'200'); ?>px;"><?php echo $param['value']; ?></textarea>
                            <?php endif; ?>

                            <?php if($param['type'] == 'text_button'): ?>
                            
                            
                            <input type="text" class="form-control <?php echo e($param['class']); ?>" id="<?php echo e($param['field']); ?>"
                                name="<?php echo e($param['field']); ?>" placeholder="<?php echo e($param['hint']); ?>"
                                value="<?php echo e($param['value']??''); ?>">
                                <br>
                            <div class="col-lg-12 col-sm-12">
                            <buttton type="button" class="btn d-grid btn-primary submit_btn"><?php echo e($submit_txt??'送出'); ?></button>
                            </div>
                            <?php endif; ?>

                            

                            <?php if($param['type'] == 'image'): ?>
                            <!-- <input name="<?php echo e($param['field']); ?>" type="file" class="form-control"> -->
                            <input data-multi="false" data-ratio="<?php echo e($param['option']['ratio']); ?>"
                                data-crop="<?php echo e($param['option']['crop']); ?>"
                                data-related="<?php echo e($param['field']); ?>" class="img_upload" type="file"
                                id="imgupload_<?php echo e($param['field']); ?>" style="display: none;" accept="image/*">

                            <button type="button" class="btn btn-sm btn-info"
                                onclick="imgupload_<?php echo e($param['field']); ?>.click();">選擇照片</button>
                            <button type="button" class="btn btn-sm btn-danger" id="delphoto_<?php echo e($param['field']); ?>"
                                onclick="delete_photo('<?php echo e($param['field']); ?>');" <?php if($param['value']=='' ): ?>
                                style="display:none;" <?php endif; ?>>刪除照片</button>

                            <input type="hidden" name="<?php echo e($param['field']); ?>" id="<?php echo e($param['field']); ?>"
                                value="<?php echo e($param['value']); ?>">
                            <div id="img_<?php echo e($param['field']); ?>"
                                style="width: 256px; margin-top: 6px; background-color: #FFF; border:1px solid #DDD; padding: 2px; border-radius: 2px; <?php if($param['value'] == ''): ?> display:none; <?php endif; ?>">
                                <img class="img-thumbnail"
                                    src="<?php if($param['value'] != ''): ?> <?php echo e(env('APP_URL').Storage::url($param['value'])); ?> <?php else: ?>  <?php endif; ?>"
                                    style="width: 250px;">
                            </div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'img_multi'): ?>
                            <input data-multi="true" data-ratio="<?php echo e($param['option']['ratio']); ?>"
                                data-related="<?php echo e($param['field']); ?>" class="img_upload" type="file"
                                id="imgupload_<?php echo e($param['field']); ?>" style="display: none;" accept="image/*">

                            <button type="button" class="btn btn-sm btn-info"
                                onclick="imgupload_<?php echo e($param['field']); ?>.click();">選擇照片</button>
                            <!-- pic1.jpg;pic2.jpg; -->
                            <input type="hidden" name="<?php echo e($param['field']); ?>" id="<?php echo e($param['field']); ?>"
                                value="<?php echo e($param['value']); ?>">
                            <input type="hidden" name="picdeleted_<?php echo e($param['field']); ?>"
                                id="picdeleted_<?php echo e($param['field']); ?>" value="">
                            <div class="row pics" id="pics_<?php echo e($param['field']); ?>">
                                <?php if(isset($html[$param['field']])): ?>
                                <?php echo $html[$param['field']]; ?>

                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'file'): ?>
                            <input data-multi="true" data-related="<?php echo e($param['field']); ?>" class="file_upload"
                                type="file" id="fileupload_<?php echo e($param['field']); ?>" style="display: none;" accept=""
                                multiple>

                            <button type="button" class="btn btn-sm btn-info"
                                onclick="fileupload_<?php echo e($param['field']); ?>.click();">選擇檔案</button>
                            <!-- pic1.jpg;pic2.jpg; -->
                            <input type="hidden" name="<?php echo e($param['field']); ?>" id="<?php echo e($param['field']); ?>"
                                value="<?php echo e($param['value']); ?>">
                            <input type="hidden" name="filesdeleted_<?php echo e($param['field']); ?>"
                                id="filesdeleted_<?php echo e($param['field']); ?>" value="">
                            <div class="row files" id="files_<?php echo e($param['field']); ?>">
                                <?php if(isset($html[$param['field']])): ?>
                                <?php echo $html[$param['field']]; ?>

                                <?php endif; ?>
                            </div>
                            <?php endif; ?>


                            <?php if($param['type'] == 'privilege'): ?>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">
                                                菜單/功能
                                                <button type="button" class="all-select btn btn-sm rounded-pill btn-secondary waves-effect waves-light">全選</button>
                                            </th>
                                            <?php $__currentLoopData = $privilege_action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th scope="col"><?php echo e($action->title); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $privilege_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row" class="menu">
                                                <?php echo e($menu['name']); ?>

                                            </th>
                                            <?php $__currentLoopData = $privilege_action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <?php if(in_array($action->id, $menu['action'])): ?>
                                                    <input 
                                                        <?php if(in_array($action->id, $menu['action_enabled'])): ?> checked <?php endif; ?>
                                                        class="form-check-input" 
                                                        type="checkbox" 
                                                        id="p_<?php echo e($menu['id']); ?>_<?php echo e($action->id); ?>" 
                                                        name="p_<?php echo e($menu['id']); ?>_<?php echo e($action->id); ?>">
                                                    <label class="form-check-label" for="p_<?php echo e($menu['id']); ?>_<?php echo e($action->id); ?>"></label>
                                                    <?php endif; ?>
                                                </div>
                                            </th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                            <?php $__currentLoopData = $menu['sub']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th scope="row" class="menu text text-secondary">
                                                    ∟<?php echo e($smenu['name']); ?>

                                                </th>
                                                <?php $__currentLoopData = $privilege_action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th scope="row">
                                                    <div class="form-check">
                                                    <?php if(in_array($action->id, $smenu['action'])): ?>
                                                        <input 
                                                            <?php if(in_array($action->id, $smenu['action_enabled'])): ?> checked <?php endif; ?>
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            id="p_<?php echo e($smenu['id']); ?>_<?php echo e($action->id); ?>" 
                                                            name="p_<?php echo e($smenu['id']); ?>_<?php echo e($action->id); ?>">
                                                        <label class="form-check-label" for="p_<?php echo e($smenu['id']); ?>_<?php echo e($action->id); ?>"></label>
                                                    <?php endif; ?>
                                                    </div>
                                                </th>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($param['type'] == 'checkbox_1'): ?>
                            <div class="table-responsive">
                                <table>
                                
                                    <thead class="table-light">
                                        <tr>
                                            
                                            
                                            <th scope="col"><?php echo e($is_have); ?></th>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input 
                                                        class="form-check-input" 
                                                        type="checkbox" 
                                                        id="have" 
                                                        name="have"
                                                        >
                                                    <label class="form-check-label" for="<?php echo e($is_have); ?>"></label>
                                                </div>
                                            </th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                            <?php endif; ?>

                            <?php if($param['type'] == 'checkbox_title'): ?>
                            <div class="table-responsive">
                                <table>
                                    <thead class="table-light">
                                        <tr>
                                            
                                            <?php $__currentLoopData = $job_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th scope="col"><?php echo e($item->title); ?></th>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input 
                                                        class="form-check-input" 
                                                        type="checkbox" 
                                                        id="Jtitle_<?php echo e($item->id); ?>" 
                                                        name="Jtitle_<?php echo e($item->id); ?>"
                                                        >
                                                    <label class="form-check-label" for="<?php echo e($item->id); ?>"></label>
                                                </div>
                                            </th>
                                            
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                            <?php endif; ?>
                            <?php if($param['type'] == 'checkbox_unit_title'): ?>
                            <div class="table-responsive">
                                <table>
                                    <thead class="table-light">
                                        <tr>
                                            
                                            <?php $__currentLoopData = $unit_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th scope="col"><?php echo e($item->title); ?></th>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input 
                                                        class="form-check-input" 
                                                        type="checkbox" 
                                                        id="Utitle_<?php echo e($item->id); ?>" 
                                                        name="Utitle_<?php echo e($item->id); ?>"
                                                        >
                                                    <label class="form-check-label" for="<?php echo e($item->id); ?>"></label>
                                                </div>
                                            </th>
                                            
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                            <?php endif; ?>

                            <?php if($param['hint'] != '' && $param['required']): ?>
                            <p class="text-danger"><?php echo e($param['hint']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(isset($action_btns)): ?>

                    <?php else: ?>
                    
                     <div class="col-lg-12 col-sm-12">
                        <buttton type="button" class="btn d-grid btn-primary submit_btn"><?php echo e($submit_txt??'送出'); ?></button>
                    </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cover Modal -->
<div class="modal fade" id="coverModal" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">圖片</h5>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="coverImage" src="" alt="cover Image">
                </div>
            </div>
            <div class="modal-footer">
                <button id="coverCancel" type="button" class="btn btn-default pull-left"
                    data-dismiss="modal">取消</button>
                <button id="coverSave" type="button" class="btn btn-primary" data-dismiss="modal">儲存</button>
            </div>
        </div>
    </div>
</div>
<!-- Cover Modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js"></script>
<script src="<?php echo e(URL::asset('assets/libs/quill/quill.min.js')); ?>"></script>
<script src="https://unpkg.com/quill-html-edit-button@2.2.7/dist/quill.htmlEditButton.min.js"></script>

<script src="<?php echo e(URL::asset('js/cropper.min.js')); ?>"></script>
<!-- <script src="<?php echo e(URL::asset('assets/libs/@ckeditor/@ckeditor.min.js')); ?>"></script> -->
<script src="<?php echo e(URL::asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script> -->

<script>
$(document).ready(function(e) {
    <?php echo $custom_js ?? ''; ?>


    $('.menu').on('click', function () {
        $(this).closest('tr').find('input[type=checkbox]').each(function (index, element) {
            $(this).prop('checked', true);
        });
    });
    $('.all-select').on('click', function () {
        if ($(this).text() == '全選'){
            $(document).find('input[type=checkbox]').each(function (index, element) {
                $(this).prop('checked', true);
            });
            $(this).text('全不選')
        }else{
            $(document).find('input[type=checkbox]').each(function (index, element) {
                $(this).prop('checked', false);
            });
            $(this).text('全選')
        }
        
    });
    $(".btn-date-forever").on('click', function () {
        $(this).next('.flatpickr-input').val('2099-12-31');
    });

    ////
    $('select[name=now_unit_id]').on('change', function () {
        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/mgr/committeeman/unit_data",
            data: {
                action: 'now',
                id: $(this).val()
            },
            type: "POST",
            dataType: 'json',
            success: function(data) {
                 
                if (data.status) {
                  
                   if(data.title=='企業(含私立學校)'){
                    console.log(data);
                    console.log(data.ServiceUnit[0]);
                    console.log(data.JobTitle[0]);
                   
                     
                     $('.old_unit_title').append($('<span>曾任服務單位</span>'));
                     $('.old_unit_name_title').append($('<span>單位名稱</span>'));
                     $('.old_Jtitle').append($('<span>職稱</span>'));

                    $('.old_unit_data').append($(' <select class="form-control" name="old_unit_id"><option value='+data.ServiceUnit[0]['id']+'>'+data.ServiceUnit[0]['title']+'</option><option value='+data.ServiceUnit[1]['id']+'>'+data.ServiceUnit[1]['title']+'</option><option value='+data.ServiceUnit[2]['id']+'>'+data.ServiceUnit[2]['title']+'</option></select>'));
                    
                    $('.old_unit_name_input').append($('<input type="text" class="form-control" id="old_unit" name="old_unit" placeholder="請輸入單位名稱"> <p class="text-danger">請輸入單位名稱</p><br><br>'));
       
                    $('.old_title_data').append($(' <select class="form-control"   name="old_title_id" id="mySelect"><option value='+data.ServiceUnit[0]['id']+'>'+data.JobTitle[0]['title']+'</option><option value='+data.JobTitle[1]['id']+'>'+data.JobTitle[1]['title']+'</option><option value='+data.JobTitle[2]['id']+'>'+data.JobTitle[2]['title']+'</option><option value='+data.JobTitle[3]['id']+'>'+data.JobTitle[3]['title']+'</option></select>'));
                    $('.old_title_data').on('change', OldTitleChange);
                     
                   }else{
                    $('.old_unit_title').empty();
                    $('.old_unit_name_title').empty();
                    $('.old_Jtitle').empty();
                    $('.old_unit_data').empty();
                    $('.old_unit_name_input').empty();
                    $('.old_title_data').empty();
                    $('.old_inner').empty();
                   }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
    function OldTitleChange() {
         var x = document.getElementById("mySelect").value;
          console.log(x)
        if(x==4){
            $('.old_inner').append($('<br><input type="text" class="form-control" id="old_other_title" name="old_other_title">請輸入其他職稱<br>'));
            // onchange 事件处理逻辑
        }else{
            $('.old_inner').empty();
        }
        
  // ...
}
    function myFunction() {
    console.log(data.value)
     var x = document.getElementById("mySelect").value;
     document.getElementById("demo").innerHTML = "You selected: " + x;
      $('.old_inner').append($('<br><input type="text" id="other_test" name="other_test">請輸入其他職稱<br>'));
    }
    $('select[name=now_title_id]').on('change', function () {
        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/mgr/committeeman/title_data",
            data: {
                action: 'now',
                id: $(this).val()
            },
            type: "POST",
            dataType: 'json',
            success: function(data) {
                 
                if (data.status) {
                  
                   if(data.title=='其他' && data.type=='now'){
                    console.log(data);
                   
                     
                     $('.now_inner').append($('<br><input type="text" class="form-control" id="other_title" name="other_title">請輸入其他職稱<br>'));
                   }else{
                    $('.now_inner').empty();
                   }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
    $('select[name=now_other_title_id]').on('change', function () {
        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/mgr/committeeman/title_data",
            data: {
                action: 'now',
                id: $(this).val()
            },
            type: "POST",
            dataType: 'json',
            success: function(data) {
                 
                if (data.status) {
                  
                   if(data.title=='其他' && data.type=='now'){
                    console.log(data);
                   
                     
                     $('.now_inner').append($('<br><input type="text" class="form-control" id="other_title" name="other_title">請輸入其他職稱<br>'));
                   }else{
                    $('.now_inner').empty();
                   }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
    $('select[name=old_title_id]').on('change', function () {
        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/mgr/committeeman/title_data",
            data: {
                action: 'old',
                id: $(this).val()
            },
            type: "POST",
            dataType: 'json',
            success: function(data) {
                 
                if (data.status) {
                  
                  if(data.title=='其他' && data.type=='old'){
                    console.log(data);
                   
                      $('.old_inner').append($('<br><input type="text" class="form-control" id="other_test" name="other_test">請輸入其他職稱<br>'));
                    
                   }else{
                    $('.old_inner').empty();
                   }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
    $('select[name=old_other_title_id]').on('change', function () {
        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/mgr/committeeman/title_data",
            data: {
                action: 'old',
                id: $(this).val()
            },
            type: "POST",
            dataType: 'json',
            success: function(data) {
                 
                if (data.status) {
                  
                  if(data.title=='其他' && data.type=='old'){
                    console.log(data);
                   
                      $('.old_inner').append($('<br><input type="text" class="form-control" id="other_test" name="other_test">請輸入其他職稱<br>'));
                    
                   }else{
                    $('.old_inner').empty();
                   }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                
            }
        });
    });

    //editor console.log(data);  alert('其他')   $('select[name=now_title_id]').empty(); $('select').append($('<input type="text" id="fname" name="fname"><br><br>').val(123).text(123));

    var snowEditor = document.querySelectorAll(".snow-editor");
    snowEditor.forEach(function(item) {
        var snowEditorData = {};
        var issnowEditorVal = item.classList.contains("snow-editor");

        if (issnowEditorVal == true) {
            snowEditorData.theme = 'snow', snowEditorData.modules = {
                'toolbar': [
                    [
                    // {
                    //     'font': []
                    // }, 
                    {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    },
                    {
                        'align': []
                    }],
                    // [{
                    //     'script': 'super'
                    // }, {
                    //     'script': 'sub'
                    // }],
                    // [{
                    //     'header': [false, 1, 2, 3, 4, 5, 6]
                    // }, 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    ['link', 'image'
                        // , 'video'
                    ],
                    // ['clean']
                ],
                htmlEditButton: {
                    debug: true, // logging, default:false
                    msg: "Edit the content in HTML format", //Custom message to display in the editor, default: Edit HTML here, when you click "OK" the quill editor's contents will be replaced
                    okText: "確認", // Text to display in the OK button, default: Ok,
                    cancelText: "取消", // Text to display in the cancel button, default: Cancel
                    buttonHTML: "&lt;&gt;", // Text to display in the toolbar button, default: <>
                    buttonTitle: "Show HTML source", // Text to display as the tooltip for the toolbar button, default: Show HTML source
                    syntax: false, // Show the HTML with syntax highlighting. Requires highlightjs on window.hljs (similar to Quill itself), default: false
                    prependSelector: 'div#myelement', // a string used to select where you want to insert the overlayContainer, default: null (appends to body),
                    editorModules: {} // The default mod
                }
            };
            // snowEditorData.modules  = {
                
            // }
        }

        Quill.register("modules/htmlEditButton", htmlEditButton);
        new Quill(item, snowEditorData);
    });


    var ckClassicEditor = document.querySelectorAll(".ckeditor-classic")
    ckClassicEditor.forEach(function(ediv) {
        // var ediv = document.querySelector('.ckeditor-classic');
        var height = ediv.getAttribute('data-height');
        if (height == '')
            height = '200px';
        else
            height += 'px';

        ClassicEditor
            .create(ediv, {
                language: 'zh',
                // plugins: [  ],//Font
                // toolbar: {
                //     items: [
                //         'fontfamily', 'fontsize', '|',
                //         'alignment', '|',
                //         'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                //         'bold', 'italic', 'strikethrough', 'underline', '|',
                //         'link', '|',
                //         'bulletedList', 'numberedList', 'todoList', '|',
                //         // 'code', 'codeBlock', '|',
                //         'insertTable', 'uploadImage', 'video', '|', //'blockQuote', 
                //         'undo', 'redo'
                //     ],
                //     shouldNotGroupWhenFull: false
                // },
                // fontFamily: {
                //     options: [
                //         'default',
                //         '微軟正黑體',
                //         '新細明體'
                //     ]
                // },
                // fontSize: {
                //     options: [
                //         9,
                //         11,
                //         13,
                //         'default',
                //         17,
                //         19,
                //         21,
                //         24,
                //         28,
                //         32,
                //         40,
                //         48,
                //         64
                //     ]
                // },
                // fontColor: {
                //     colors: [
                //         // 9 colors defined here...
                //     ],
                //     columns: 3,
                // },
                // fontBackgroundColor: {
                //     columns: 6,
                // },
            })
            .then(function(editor) {
                editor.ui.view.editable.element.style.height = height;
            })
            .catch(function(error) {});
    });
    function updateForm() {
        // 選取表單元素
        var form = document.getElementById('myForm');
        console.log(form);
        // 修改表單值
       
      
        
        // 使用AJAX提交表單
      
     }

    $(document).on('click', '.submit_search_btn', function(e) {
        <?php if(isset($precheck_url) && $precheck_url != ''): ?>
        $.ajax({
            url: "<?php echo e($precheck_url); ?><?php if(isset($id)): ?>/<?php echo e($id); ?><?php endif; ?>",
            data: $("#form").serialize(),
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    submit_form();
                } else {
                    alert(data.msg);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {

            }
        });
        <?php else: ?>
        // 選取表單元素
        var form = document.getElementById('form');
        console.log(form.button_type.value);
        // 修改表單值
        form.button_type.value = 'search';
        console.log(form.button_type.value);
        
        
        submit_form();
        <?php endif; ?>
    });
    //submit form
    $(document).on('click', '.submit_btn', function(e) {
        <?php if(isset($precheck_url) && $precheck_url != ''): ?>
        $.ajax({
            url: "<?php echo e($precheck_url); ?><?php if(isset($id)): ?>/<?php echo e($id); ?><?php endif; ?>",
            data: $("#form").serialize(),
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    submit_form();
                } else {
                    alert(data.msg);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {

            }
        });
        <?php else: ?>
        submit_form();
        <?php endif; ?>
    });

    function submit_form() {
        $(document).find('.snow-editor').each(function(index, el) {
            let name = $(this).attr('name');
            $("#" + name).val($(this).find('.ql-editor').html());
        });
        <?php if(isset($ajax_form) && $ajax_form): ?>
        $.ajax({
            url: $("#form").attr('action'),
            data: $("#form").serialize(),
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    alert(data.msg);
                    location.href = data.redirect_url;
                } else {
                    alert(data.msg);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("照片上傳發生錯誤");
            }
        });
        <?php else: ?>
        $("#form").submit();
        <?php endif; ?>
    }  

    $('select[name=city]').on('change', function () {
        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/util/city",
            data: {
                action: 'dist',
                id: $(this).val()
            },
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    $('select[name=dist]').empty();
                    $.each(data.data, function (i, elem) { 
                        $('select[name=dist]').append($("<option/>").val(elem.id).text(elem.dist));
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                
            }
        });
    });
    $('.city').on('change', function () {
        let name = $(this).attr('name');
        let dist_name = name.replace('city', 'dist');
        // if ( $(`select[name=${dist_name}]`).val() != 100 ) return;
        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/util/city",
            data: {
                action: 'dist',
                id: $(this).val()
            },
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    $(`select[name=${dist_name}]`).empty();
                    $.each(data.data, function (i, elem) { 
                        <?php if(isset($dist_use) && $dist_use == 'id'): ?>
                        $(`select[name=${dist_name}]`).append($("<option/>").val(elem.id).text(elem.dist));
                        <?php else: ?>
                        $(`select[name=${dist_name}]`).append($("<option/>").val(elem.zipcode).text(elem.dist));
                        <?php endif; ?>
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                
            }
        });
    });


    //Upload files

    $(".file_upload").on('change', function(event) {
        var multiple = $(this).attr("data-multi");
        var related_id = $(this).attr("data-related");
        var formData = new FormData();
        formData.append('multi', multiple);
        formData.append('field', related_id);

        if (multiple == "true") {
            $.each($(this)[0].files, function(i, file) {
                formData.append('files[' + i + ']', file);
            });
        } else {
            formData.append('files', $(this)[0].files[0]);
        }

        $.ajax({
            url: "<?php echo e(env('APP_URL')); ?>/util/file_upload",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    $("#files_" + related_id).append(
                        data.html
                    );
                    $.each(data.data, function(index, item) {
                        $("#" + related_id).val($("#" + related_id).val() + item
                            .path + ";");
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // alert("檔案上傳發生錯誤"); 
            }
        });
    });
});

//Image crop
window.addEventListener('DOMContentLoaded', function() {
    /* crop */
    var coverImage = document.getElementById("coverImage");
    var cropper;
    var related_id;
    var ratio = 1;
    var multi;

    $(document).on("change", ".img_upload", function() {
        multi = $(this).attr("data-multi");
        related_id = $(this).attr("data-related");
        ratio = parseFloat($(this).attr("data-ratio"));
        let crop = $(this).data('crop');
        if (ratio <= 0) ratio = 0;

        if (crop === 'without') {
            let formData = new FormData();
            formData.append('multi', multi);
            formData.append('field', related_id);
            formData.append('crop', 'without');
            
            formData.append('image', $(this)[0].files[0]);
            img_upload(formData, related_id, is_crop = false);
            return;
        }

        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#coverImage").attr('src', e.target.result);
                $("#coverImage").width("100%");
            }

            reader.readAsDataURL(input.files[0]);

            $("#coverModal").modal({
                'backdrop': 'static'
            });
            $("#coverModal").modal("show");
        }
        $(this).val("");
    });

    $('#coverModal').on('shown.bs.modal', function() {
        let param = {
            // aspectRatio: ratio,
            autoCropArea: 1,
            movable: false,
            rotatable: false,
            scalable: false,
            zoomable: false,
            zoomOnTouch: false,
            zoomOnWheel: false,
            responsive: true,
        };
        if (ratio > 0) {
            param['aspectRatio'] = ratio;
        }
        cropper = new Cropper(coverImage, param);
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
    });

    $("#coverCancel").on('click', function(event) {
        $("#coverModal").modal("hide");
    });

    $("#coverSave").on('click', function(event) {
        var result = cropper.getCroppedCanvas();
        $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

        img_upload({
            imageData: result.toDataURL("image/jpeg"),
            multi: multi,
            field: related_id,
            crop: 'crop'
        }, related_id, is_crop = true);

        cropper.destroy();
        $("#coverModal").modal("hide");
    });

    /* crop end */
});

function img_upload(data, related_id, is_crop = true){
    $.ajax({
        url: "<?php echo e(env('APP_URL')); ?>/util/img_upload",
        data: data,
        // cache: false,
        contentType: ((is_crop)?'application/x-www-form-urlencoded':false),
        processData: ((is_crop)?true:false),
        type: "POST",
        dataType: 'json',
        success: function(data) {
            if (data.status) {
                if (data.multi) {
                    $("#pics_" + related_id).append(
                        data.html
                    );
                    $("#" + related_id).val($("#" + related_id).val() + data.path +
                    ";");
                } else {
                    $("#img_" + related_id + " img").attr("src", data.realpath);
                    $("#img_" + related_id).show();
                    $("#" + related_id).val(data.path);
                    $("#delphoto_" + related_id).show();
                }
            } else {
                alert(data.msg);
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("照片上傳發生錯誤");
        }
    });
}

function delete_photo(id) {
    $("#delphoto_" + id).hide();
    $("#" + id).val("");
    $("#img_" + id + " img").attr("src", "");
    $("#img_" + id).hide();
}

function del_multi_img(obj, pic, id) {
    if (!confirm("確定刪除此照片嗎?刪除後請按下方儲存鈕，才會真正刪除。")) return;
    $(obj).closest(".multi_img_item").fadeOut();
    $("#picdeleted_" + id).val($("#picdeleted_" + id).val() + pic + ";");
}

function delete_file(related_id, id, path, alarm = true) {
    if (alarm && !confirm("確定刪除此檔案?" + "\n" + "注意! 儲存後此動作才會正式生效")) return;
    $("#file_" + id).fadeTo('fast', 0, function() {
        $(this).remove();
    });
    $("#filesdeleted_" + related_id).val($("#filesdeleted_" + related_id).val() + path + ";");
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('mgr.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ichiban\resources\views/mgr/template_form.blade.php ENDPATH**/ ?>