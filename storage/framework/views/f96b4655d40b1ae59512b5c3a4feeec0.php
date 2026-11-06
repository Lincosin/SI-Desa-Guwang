<?php
    $url = $post->url_slug;
    $abstract = potong_teks(strip_tags($post['isi']), 300);
    $punya_gambar = !empty($post['gambar']);
    $image = $punya_gambar ? AmbilFotoArtikel($post['gambar'], 'sedang') : gambar_desa($desa['logo']);
?>

<article class="smd-post smd-spotlight">
    <a href="<?php echo e($url); ?>" class="smd-post__media <?php echo e($punya_gambar ? '' : 'smd-post__media--logo'); ?>" tabindex="-1" aria-hidden="true">
        <img src="<?php echo e($image); ?>" alt="" loading="lazy">
        <?php if($post['kategori']): ?>
            <span class="smd-badge"><?php echo e($post['category']['kategori'] ?? $post['kategori']); ?></span>
        <?php endif; ?>
    </a>
    <div class="smd-post__body">
        <ul class="smd-meta">
            <li><i class="far fa-calendar-alt" aria-hidden="true"></i> <?php echo e(tgl_indo($post['tgl_upload'])); ?></li>
            <li><i class="far fa-user" aria-hidden="true"></i> <?php echo e($post['owner']); ?></li>
        </ul>
        <h3 class="smd-post__title">
            <a href="<?php echo e($url); ?>"><?php echo e(potong_teks($post['judul'], 90)); ?><?php echo e(strlen($post['judul']) > 90 ? '...' : ''); ?></a>
        </h3>
        <p class="smd-post__excerpt"><?php echo potong_teks(html_entity_decode($abstract), 140); ?><?php echo e(strlen($abstract) > 140 ? '...' : ''); ?></p>
        <a href="<?php echo e($url); ?>" class="smd-post__more">Baca selengkapnya <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
    </div>
</article>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/partials/artikel/list.blade.php ENDPATH**/ ?>