
<?php
    $url = $post->url_slug;
    $gambar = !empty($post['gambar']) && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $post['gambar']) ? AmbilFotoArtikel($post['gambar'], 'sedang') : gambar_desa($desa['logo']);
    $kategori = data_get($post, 'category.kategori') ?: data_get($post, 'kategori');
    $penulis = $post['owner'] ?? data_get($post, 'author.nama');
    $ringkas = \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($post['isi'] ?? '')), 220);
?>
<article class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between h-full">
    <a href="<?php echo e($url); ?>" class="block relative w-full h-64 sm:h-72 overflow-hidden bg-surface-container">
        <img src="<?php echo e($gambar); ?>" alt="<?php echo e($post['judul']); ?>" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
        <?php if($kategori): ?>
            <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-primary text-on-primary font-body-bold text-label-md shadow-sm"><?php echo e($kategori); ?></span>
        <?php endif; ?>
    </a>
    <div class="p-6 sm:p-8 flex flex-col justify-between flex-grow gap-4">
        <div>
            <div class="flex items-center gap-3 text-on-surface-variant font-caption text-caption mb-3">
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">event</span> <?php echo e(tgl_indo($post['tgl_upload'])); ?></span>
                <?php if($penulis): ?>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">person</span> <?php echo e($penulis); ?></span>
                <?php endif; ?>
            </div>
            <a href="<?php echo e($url); ?>" class="font-headline-md text-headline-md text-on-surface hover:text-primary transition-colors block mb-3"><?php echo e($post['judul']); ?></a>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed line-clamp-3"><?php echo e($ringkas); ?></p>
        </div>
        <a href="<?php echo e($url); ?>" class="inline-flex items-center gap-1 text-primary font-body-bold text-label-lg hover:underline">
            <span>Baca Selengkapnya</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>
</article>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/partials/artikel/card-featured.blade.php ENDPATH**/ ?>