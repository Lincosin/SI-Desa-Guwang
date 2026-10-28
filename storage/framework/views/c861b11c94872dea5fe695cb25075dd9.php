<div class="btn-group btn-group-vertical">
    <a class="btn btn-social <?php echo e($type); ?> btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="<?php echo e($icon); ?>"></i> <?php echo e($judul); ?>

    </a>
    <ul class="dropdown-menu" role="menu">
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(! isset($value['can']) || $value['can']): ?>
                <li>
                    <a href="<?php echo e(site_url($value['url'])); ?>" <?php if(isset($value['id'])): ?> id="<?php echo e($value['id']); ?>" <?php endif; ?>
                        class="btn btn-social btn-block btn-sm<?php echo e(isset($value['data']['class']) ? ' ' . $value['data']['class'] : ''); ?>"
                        title="<?php echo e($value['judul']); ?>" 
                        <?php if(isset($value['data']['id'])): ?> id="<?php echo e($value['data']['id']); ?>" <?php endif; ?>
                        <?php if(isset($value['data']['onclick'])): ?> onclick="<?php echo e($value['data']['onclick']); ?>" <?php endif; ?>
                        <?php if(isset($value['target']) && $value['target']): ?> target="_blank" <?php endif; ?>
                        <?php if($value['modal']): ?> 
                            <?php if(isset($value['data'])): ?>
                                <?php
                                    $hasModalAttributes = false;
                                    foreach($value['data'] as $key => $val) {
                                        if (str_starts_with($key, 'data-') && in_array($key, ['data-remote', 'data-toggle', 'data-target', 'data-title'])) {
                                            $hasModalAttributes = true;
                                            break;
                                        }
                                    }
                                ?>
                                <?php $__currentLoopData = $value['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataKey => $dataValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!in_array($dataKey, ['id', 'onclick', 'class'])): ?>
                                        <?php echo e($dataKey); ?>="<?php echo e($dataValue); ?>"
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$hasModalAttributes): ?>
                                    data-remote="false" data-toggle="modal" data-target="<?php echo e(isset($value['target']) ? $value['target'] : '#modalBox'); ?>" data-title="<?php echo e($value['judul']); ?>"
                                <?php endif; ?>
                            <?php else: ?>
                                data-remote="false" data-toggle="modal" data-target="<?php echo e(isset($value['target']) ? $value['target'] : '#modalBox'); ?>" data-title="<?php echo e($value['judul']); ?>"
                            <?php endif; ?>
                        <?php endif; ?>>
                        <i class="<?php echo e($value['icon']); ?>"></i> <?php echo e($value['judul']); ?>

                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/buttons/split.blade.php ENDPATH**/ ?>