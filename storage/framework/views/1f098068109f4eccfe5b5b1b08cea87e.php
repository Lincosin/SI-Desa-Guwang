
<?php
    $menuAtas = menu_tema() ?: [];
?>
<nav class="relative hidden lg:block bg-primary text-on-primary" role="navigation" aria-label="Menu utama">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ul class="flex items-stretch flex-wrap">
            <li>
                <a href="<?php echo e(site_url('/')); ?>" title="Beranda" aria-label="Beranda" class="flex items-center h-full px-4 py-3 hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-[22px]">home</span>
                </a>
            </li>

            <?php $__currentLoopData = $menuAtas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $anak = $menu['childrens'] ?? [];
                    $adaAnak = count($anak) > 0;
                    $mega = collect($anak)->contains(fn ($c) => count($c['childrens'] ?? []) > 0);
                ?>
                <li class="group <?php echo e($adaAnak && !$mega ? 'relative' : ''); ?>">
                    <?php if($adaAnak): ?>
                        <button type="button" aria-haspopup="true" class="flex items-center gap-1 h-full px-4 py-3 font-label-lg text-label-lg hover:bg-primary-container group-hover:bg-primary-container group-focus-within:bg-primary-container transition-colors">
                            <span><?php echo $menu['nama']; ?></span>
                            <span class="material-symbols-outlined text-[18px] transition-transform group-hover:rotate-180">expand_more</span>
                        </button>
                    <?php else: ?>
                        <a href="<?php echo e($menu['link_url']); ?>" class="flex items-center h-full px-4 py-3 font-label-lg text-label-lg hover:bg-primary-container transition-colors"><?php echo $menu['nama']; ?></a>
                    <?php endif; ?>

                    <?php if($adaAnak && !$mega): ?>
                        
                        <div class="absolute top-full <?php echo e($loop->index >= 5 ? 'right-0' : 'left-0'); ?> z-50 min-w-[260px] bg-surface-container-lowest text-on-surface shadow-xl rounded-b-xl border-t-4 border-tertiary-fixed invisible opacity-0 group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100 transition-all duration-150">
                            <ul class="py-2">
                                <?php $__currentLoopData = $anak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e($child['link_url']); ?>" class="block px-5 py-2.5 font-body-md text-caption hover:bg-surface-container-low hover:text-primary transition-colors"><?php echo $child['nama']; ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php elseif($adaAnak && $mega): ?>
                        
                        <?php
                            $tautanLangsung = collect($anak)->filter(fn ($c) => count($c['childrens'] ?? []) === 0);
                        ?>
                        <div class="absolute left-0 right-0 top-full z-50 bg-surface-container-lowest text-on-surface shadow-xl border-t-4 border-tertiary-fixed max-h-[70vh] overflow-y-auto invisible opacity-0 group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100 transition-all duration-150">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                                <div class="grid grid-cols-2 xl:grid-cols-4 gap-x-8 gap-y-6">
                                    <?php if($tautanLangsung->count() > 0): ?>
                                        <div>
                                            <span class="block font-body-bold text-body-bold text-primary border-b border-outline-variant/40 pb-2 mb-3"><?php echo $menu['nama']; ?></span>
                                            <ul class="space-y-1.5">
                                                <?php $__currentLoopData = $tautanLangsung; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e($child['link_url']); ?>" class="block font-body-md text-caption text-on-surface-variant hover:text-primary transition-colors"><?php echo $child['nama']; ?></a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $anak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($child['childrens'] ?? []) > 0): ?>
                                            <div>
                                                <span class="block font-body-bold text-body-bold text-primary border-b border-outline-variant/40 pb-2 mb-3"><?php echo $child['nama']; ?></span>
                                                <ul class="space-y-1.5">
                                                    <?php $__currentLoopData = $child['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cucu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <a href="<?php echo e($cucu['link_url']); ?>" class="block font-body-md text-caption text-on-surface-variant hover:text-primary transition-colors"><?php echo $cucu['nama']; ?></a>
                                                            <?php if(count($cucu['childrens'] ?? []) > 0): ?>
                                                                <ul class="ml-3 mt-1 space-y-1 border-l border-outline-variant/40 pl-3">
                                                                    <?php $__currentLoopData = $cucu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cicit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li><a href="<?php echo e($cicit['link_url']); ?>" class="block font-body-md text-caption text-on-surface-variant hover:text-primary transition-colors"><?php echo $cicit['nama']; ?></a></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</nav>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/commons/main_menu.blade.php ENDPATH**/ ?>