
<?php
    $url = $post->url_slug;
    $gambar = !empty($post['gambar']) ? AmbilFotoArtikel($post['gambar'], 'sedang') : gambar_desa($desa['logo']);
    $kategori = data_get($post, 'category.kategori') ?: data_get($post, 'kategori');
    $ringkas = \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($post['isi'] ?? '')), 140);
?>
<article class="group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col">
    <a href="<?php echo e($url); ?>" class="block relative h-48 overflow-hidden bg-surface-container">
        <img src="<?php echo e($gambar); ?>" alt="<?php echo e($post['judul']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <?php if($kategori): ?>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-primary text-on-primary font-body-bold text-label-md shadow-sm"><?php echo e($kategori); ?></span>
        <?php endif; ?>
    </a>
    <div class="p-5 flex flex-col gap-3 flex-grow">
        <div class="flex items-center gap-3 text-on-surface-variant font-caption text-caption">
            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">event</span> <?php echo e(tgl_indo($post['tgl_upload'])); ?></span>
        </div>
        <a href="<?php echo e($url); ?>" class="font-headline-sm text-headline-sm text-on-surface hover:text-primary transition-colors line-clamp-2"><?php echo e($post['judul']); ?></a>
        <p class="font-caption text-caption text-on-surface-variant leading-relaxed line-clamp-3"><?php echo e($ringkas); ?></p>
    </div>
</article>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/partials/artikel/card.blade.php ENDPATH**/ ?>