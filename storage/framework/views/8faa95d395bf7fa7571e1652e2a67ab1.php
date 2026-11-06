<?php if($paginator->hasPages()): ?>
    <nav>
        <p class="text-xs lg:text-sm py-3">Halaman <?php echo e($paginator->currentPage()); ?> dari <?php echo e($paginator->lastPage()); ?></p>
        <ul class="pagination flex gap-2 flex-wrap">
            
            <li class="page-item">
                <a href="<?php echo e($paginator->url(1)); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200"><i class="fas fa-arrow-left"></i></a>
            </li>
            <?php if($paginator->onFirstPage()): ?>
            <?php else: ?>
                <li class="page-item">
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200"><i data-feather="chevron-left" class="fas fa-chevron-left inline-block"></i></a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?php echo e($element); ?></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="page-item" aria-current="page"><span class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-primary-100 text-white hover:text-white hover:bg-primary-200"><?php echo e($page); ?></span></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page-item">
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200"><i class="fas fa-chevron-right inline-block"></i></a>
                </li>
            <?php else: ?>
            <?php endif; ?>
            <li class="page-item">
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>" class="page-link py-1 px-3 rounded-lg shadow inline-block border hover:border-primary-100 bg-white hover:text-primary-200"><i class="fas fa-arrow-right inline-block"></i></a>
            </li>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/pagination-tailwind.blade.php ENDPATH**/ ?>