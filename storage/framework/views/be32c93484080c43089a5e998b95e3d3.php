
<?php
    $url = $post->url_slug;
    $gambar = !empty($post['gambar']) ? AmbilFotoArtikel($post['gambar'], 'sedang') : gambar_desa($desa['logo']);
    $kategori = data_get($post, 'category.kategori') ?: data_get($post, 'kategori');
?>
<article class="flex gap-4 bg-surface-container-lowest p-3 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
    <a href="<?php echo e($url); ?>" class="block w-28 h-24 sm:w-32 sm:h-28 flex-shrink-0 rounded-xl overflow-hidden bg-surface-container">
        <img src="<?php echo e($gambar); ?>" alt="<?php echo e($post['judul']); ?>" class="w-full h-full object-cover">
    </a>
    <div class="flex flex-col justify-center gap-1 min-w-0">
        <?php if($kategori): ?>
            <span class="font-label-md text-caption text-primary font-semibold"><?php echo e($kategori); ?></span>
        <?php endif; ?>
        <a href="<?php echo e($url); ?>" class="font-body-bold text-body-bold text-on-surface hover:text-primary transition-colors line-clamp-2"><?php echo e($post['judul']); ?></a>
        <span class="flex items-center gap-1 font-caption text-caption text-on-surface-variant"><span class="material-symbols-outlined text-[14px]">event</span> <?php echo e(tgl_indo($post['tgl_upload'])); ?></span>
    </div>
</article>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/partials/artikel/card-compact.blade.php ENDPATH**/ ?>