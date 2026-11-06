<?php
    $comments = [];
    if (is_array($komentar) && $single_artikel['boleh_komentar']) {
        $comments = [];

        foreach ($komentar as $comment) {
            if ($comment['is_archived'] != 1) {
                $comments[] = $comment;
            }
        }
        $comments = array_reverse($comments);
        $forms = [
            'owner' => 'Nama',
            'email' => 'Alamat Email',
            'no_hp' => 'No. HP',
        ];
    }
    $notif = session('notif');
?>

<?php if(count($comments) > 0): ?>
    <div class="accordion" id="semuaKomentar">
        <div class="accordion-item border-t-0 border-l-0 border-r-0 rounded-none bg-white border border-gray-200">
            <h2 class="accordion-header mb-0" id="komentarLabel">
                <button class="accordion-button relative flex items-center w-full py-4 text-h5 text-left bg-white border-0 rounded-none transition focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#listKomentar" aria-expanded="false" aria-controls="listKomentar">
                    Semua Komentar
                </button>
            </h2>
            <div id="listKomentar" class="accordion-collapse border-0 collapse show" aria-labelledby="komentarLabel" data-bs-parent="#semuaKomentar">
                <div class="accordion-body py-4 px-3 lg:px-5 divide-y">
                    <!-- List Komentar -->
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex gap-x-3 py-4">
                            <div class="h-10 lg:h-12 lg:w-12 w-10 inline-flex items-center justify-center bg-gray-200 rounded-full flex-shrink-0 text-secondary-100"><i class="fa fa-comments text-lg"></i></div>
                            <div class="space-y-2">
                                <blockquote class="italic">"<?php echo e($comment['komentar']); ?></blockquote>
                                <div class="space-y-1 space-x-3 text-xs lg:text-sm">
                                    <span><i class="fa fa-user mr-1 text-accent-100"></i> <?php echo e($comment['pengguna']['nama']); ?></span>
                                    <span><i class="fa fa-calendar-alt mr-1 text-accent-100"></i> <?php echo e(tgl_indo($comment['tgl_upload'])); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if(count($comment['children']) > 0): ?>
                            <?php $__currentLoopData = $comment['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div style="margin: 0 0 0 40px;" class="flex gap-x-3 py-4">
                                    <div class="h-10 lg:h-12 lg:w-12 w-10 inline-flex items-center justify-center bg-gray-200 rounded-full flex-shrink-0 text-secondary-100"><i class="fa fa-comments text-lg"></i></div>
                                    <div class="space-y-2">
                                        <blockquote class="italic">"<?php echo e($children['komentar']); ?></blockquote>
                                        <div class="space-y-1 space-x-3 text-xs lg:text-sm">
                                            <span><i class="fa fa-user mr-1 text-accent-100"></i> <?php echo e($children['pengguna']['nama']); ?> <code>(<?php echo e($children['pengguna']['level']); ?>)</code></span>
                                            <span><i class="fa fa-calendar-alt mr-1 text-accent-100"></i> <?php echo e(tgl_indo($children['tgl_upload'])); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($single_artikel['boleh_komentar'] == 1): ?>
    <form action="<?php echo e(site_url('/add_comment/' . $single_artikel['id'])); ?>" method="POST"class="space-y-4 pt-5 pb-4" id="kolom-komentar">
        <h5 class="text-h5">Beri Komentar</h5>
        <div class="alert alert-info text-sm text-primary-100">Komentar baru terbit setelah disetujui oleh admin</div>

        <?php $alert = ($notif['status'] == -1) ? 'error' : 'success'; ?>
        <?php if($flash_message = $notif['pesan']): ?>
            <div class="alert alert-<?php echo e($alert); ?> text-sm"><i class="<?php echo e($notif['status'] != -1 ? 'fas fa-check mr-2' : ''); ?>"></i><?php echo e($flash_message); ?></div>
        <?php endif; ?>

        <div class="space-y-2">
            <label for="komentar" class="text-xs lg:text-sm">Komentar <span style="color:red">*</span></label>
            <textarea class="form-textarea" name="komentar" id="komentar" cols="30" rows="4" required><?php echo e($notif['data']['komentar']); ?></textarea>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="space-y-2">
                    <label for="<?php echo e($name); ?>" class="text-xs lg:text-sm"><?php echo e($label); ?> <?php if($name !== 'email'): ?>
                            <span style="color:red">*</span>
                        <?php endif; ?>
                    </label>
                    <input type="text" class="form-input" id="<?php echo e($name); ?>" name="<?php echo e($name); ?>" value="<?php echo e($name === 'owner' && !empty($notif['data']['nama']) ? $notif['data']['nama'] : $notif['data'][$name]); ?>" <?php echo e($name !== 'email' ? 'required' : ''); ?>>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="flex flex-col lg:flex-row gap-3">
            <div class="group">
                <img id="captcha" src="<?php echo e(site_url('captcha')); ?>" alt="CAPTCHA Image" class="max-w-full h-auto">
                <button type="button" class="hover:text-link text-xs lg:text-sm" onclick="document.getElementById('captcha').src = '<?php echo e(ci_route('captcha')); ?>?' + Math.random();">[Ganti Gambar]</button>
            </div>
            <input type="text" name="captcha_code" class="form-input" placeholder="Tulis kembali kode sebelah">
        </div>
        <button type="submit" class="btn btn-secondary">Kirim Komentar <i class="fas fa-paper-plane ml-2"></i></button>
    </form>
<?php endif; ?>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/partials/artikel/comment.blade.php ENDPATH**/ ?>