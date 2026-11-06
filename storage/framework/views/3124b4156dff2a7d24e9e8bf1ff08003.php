<h5 class="text-h5">Bagikan Artikel Ini</h5>
<div class="flex space-x-2">
    <?php
        $url = $post['url_slug'];
        $title = $post['judul'] ?? 'Bagikan Artikel Ini';
        $shareButtons = [
            [
                'url' => 'http://www.facebook.com/sharer.php?u=' . $url,
                'icon' => 'fa-facebook-f',
                'color' => 'bg-blue-600',
                'prefix' => 'fab',
            ],
            [
                'url' => 'http://twitter.com/share?text=' . rawurlencode($title) . '&url=' . $url . '&via=opensid',
                'icon' => 'fa-twitter',
                'color' => 'bg-sky-500',
                'prefix' => 'fab',
            ],
            [
                'url' => 'https://telegram.me/share/url?url=' . $url . '&text=' . rawurlencode($title),
                'icon' => 'fa-telegram-plane',
                'color' => 'bg-sky-400',
                'prefix' => 'fab',
            ],
            [
                'url' => 'https://api.whatsapp.com/send?text=' . rawurlencode($title . ' ' . $url),
                'icon' => 'fa-whatsapp',
                'color' => 'bg-green-500',
                'prefix' => 'fab',
            ],
            [
                'url' => 'mailto:?subject=' . rawurlencode($title) . '&body=' . rawurlencode("Baca selengkapnya di $url"),
                'icon' => 'fa-envelope',
                'color' => 'bg-red-500',
                'prefix' => 'fas', // envelope is a solid icon
            ],
        ];
    ?>

    
    <?php $__currentLoopData = $shareButtons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($sm['url']); ?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center <?php echo e($sm['color']); ?> h-10 w-10 rounded-full" title="Bagikan ke <?php echo e(ucfirst(str_replace('fa-', '', $sm['icon']))); ?>">
            <i class="<?php echo e($sm['prefix']); ?> fa-xl <?php echo e($sm['icon']); ?> text-white"></i>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/commons/share.blade.php ENDPATH**/ ?>