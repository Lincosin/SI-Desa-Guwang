<nav class="bg-primary-100 text-white lg:hidden block" x-data="{ menuOpen: false }" role="navigation">
    <!-- Tombol toggle -->
    <button type="button" class="w-full block text-center uppercase p-3" @click="menuOpen = !menuOpen">
        <i class="fas mr-1" :class="{ 'fa-bars': !menuOpen, 'fa-times': menuOpen }"></i>
        Menu
    </button>

    <!-- Menu utama -->
    <ul x-show="menuOpen" x-transition class="divide-y divide-primary-200">
        <?php $menu_atas = menu_tema() ?>
        <?php if($menu_atas): ?>
            <?php $__currentLoopData = $menu_atas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $has_dropdown = count($menu['childrens'] ?? []) > 0 ?>
                <li class="block relative" <?php if($has_dropdown): ?> x-data="{dropdownMain: false}" <?php endif; ?>>
                    <?php $menu_link = $has_dropdown ? '#!' : $menu['link_url'] ?>

                    <!-- LEVEL 1 -->
                    <a href="<?php echo e($menu_link); ?>"
                        class="flex w-full items-center justify-between p-3 hover:bg-secondary-100"
                        @click="dropdownMain = !dropdownMain">
                        <span class="flex-1"><?php echo $menu['nama']; ?></span>
                        <?php if($has_dropdown): ?>
                            <i class="fas fa-chevron-down fa-xs ml-2 shrink-0 transition-transform duration-300"
                                :class="{ 'rotate-180': dropdownMain }"></i>
                        <?php endif; ?>
                    </a>

                    <?php if($has_dropdown): ?>
                        <!-- LEVEL 2 -->
                        <ul class="divide-y divide-primary-200"
                            :class="{
                                'opacity-0 invisible z-[-10] scale-y-75 h-0': !dropdownMain,
                                'opacity-100 visible z-30 scale-y-100 h-auto': dropdownMain
                            }"
                            x-transition.opacity>

                            <?php $__currentLoopData = $menu['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childrens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $has_dropdown2 = count($childrens['childrens'] ?? []) > 0 ?>
                                <li <?php if($has_dropdown2): ?> x-data="{dropdownSub: false}" <?php endif; ?>>
                                    <?php $menu_link2 = $has_dropdown2 ? '#!' : $childrens['link_url'] ?>

                                    <a href="<?php echo e($menu_link2); ?>"
                                        class="flex w-full items-center justify-between py-3 pr-4 pl-6 hover:bg-primary-200 hover:text-white"
                                        @click="dropdownSub = !dropdownSub">
                                        <?php echo $childrens['nama']; ?>

                                        <?php if($has_dropdown2): ?>
                                            <i class="fas fa-chevron-right fa-xs ml-auto shrink-0 transition-transform duration-300"
                                                :class="{ 'rotate-90': dropdownSub }"></i>
                                        <?php endif; ?>
                                    </a>

                                    <?php if($has_dropdown2): ?>
                                        <!-- LEVEL 3 -->
                                        <ul class="divide-y divide-primary-200"
                                            :class="{
                                                'opacity-0 invisible z-[-10] scale-y-75 h-0': !dropdownSub,
                                                'opacity-100 visible z-30 scale-y-100 h-auto': dropdownSub
                                            }"
                                            x-transition.opacity>
                                            <?php $__currentLoopData = $childrens['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $has_dropdown3 = count($children['childrens'] ?? []) > 0 ?>
                                                <li
                                                    <?php if($has_dropdown3): ?> x-data="{dropdownSub2: false}" <?php endif; ?>>
                                                    <a href="<?php echo e($menu_link3); ?>"
                                                        class="flex w-full items-center justify-between py-3 pr-4 pl-6 hover:bg-primary-200 hover:text-white"
                                                        @click="dropdownSub2 = !dropdownSub2">
                                                        <?php echo $children['nama']; ?>

                                                        <?php if($has_dropdown3): ?>
                                                            <i class="fas fa-chevron-right fa-xs ml-auto shrink-0 transition-transform duration-300"
                                                                :class="{ 'rotate-90': dropdownSub2 }"></i>
                                                        <?php endif; ?>
                                                    </a>


                                                    <?php if($has_dropdown3): ?>
                                                        <!-- LEVEL 4 -->
                                                        <ul class="divide-y divide-primary-200"
                                                            :class="{
                                                                'opacity-0 invisible z-[-10] scale-y-75 h-0': !
                                                                    dropdownSub2,
                                                                'opacity-100 visible z-30 scale-y-100 h-auto': dropdownSub2
                                                            }"
                                                            x-transition.opacity>
                                                            <?php $__currentLoopData = $children['childrens']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ggchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li>
                                                                    <a href="<?php echo e($menu_link4); ?>"
                                                                        class="block py-3 pr-4 pl-6 hover:bg-primary-200 hover:text-white">
                                                                        <?php echo $ggchild['nama']; ?>

                                                                    </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</nav>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/commons/mobile_menu.blade.php ENDPATH**/ ?>