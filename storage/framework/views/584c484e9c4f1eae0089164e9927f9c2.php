

<div class="container">
    <?php echo $__env->renderWhen($transparansi && empty($isBeranda), 'theme::partials.apbdesa', $transparansi, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</div>

<?php
    $ikonSosmed = [
        'facebook' => 'fa-facebook-f',
        'twitter' => 'fa-twitter',
        'instagram' => 'fa-instagram',
        'telegram' => 'fa-telegram',
        'whatsapp' => 'fa-whatsapp',
        'youtube' => 'fa-youtube',
    ];
    $daftarSosmed = collect($sosmed ?? [])->filter(fn ($s) => !empty($s['link']) && isset($ikonSosmed[strtolower($s['nama'] ?? '')]));
    $namaDesaFooter = ucfirst(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
    $jamFooter = collect($jam_kerja ?? []);
?>

<?php echo $__env->make('theme::commons.back_to_top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<footer class="w-full bg-inverse-surface text-inverse-on-surface pt-space-xl pb-space-lg mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-lg mb-space-xl">
            
            <div class="flex flex-col gap-space-sm">
                <div class="flex items-center gap-space-sm">
                    <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="Logo <?php echo e($namaDesaFooter); ?>" class="h-9 w-auto object-contain">
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm text-tertiary-fixed font-bold"><?php echo e($namaDesaFooter); ?></span>
                        <span class="font-caption text-caption text-inverse-on-surface/70">
                            <?php echo e(ucfirst(setting('sebutan_kecamatan_singkat'))); ?> <?php echo e(ucwords($desa['nama_kecamatan'])); ?>, <?php echo e(ucfirst(setting('sebutan_kabupaten_singkat'))); ?> <?php echo e(ucwords($desa['nama_kabupaten'])); ?>

                        </span>
                    </div>
                </div>
                <p class="font-body-md text-caption text-inverse-on-surface/80 leading-relaxed">
                    Portal resmi informasi, transparansi, dan layanan publik <?php echo e($namaDesaFooter); ?>.
                </p>
                <?php if($daftarSosmed->count() > 0): ?>
                    <div class="flex items-center gap-2 mt-2">
                        <?php $__currentLoopData = $daftarSosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($sm['link']); ?>" target="_blank" rel="noopener" title="<?php echo e($sm['nama']); ?>" class="w-8 h-8 rounded-full bg-surface-container-highest/10 hover:bg-primary hover:text-on-primary flex items-center justify-center transition-colors">
                                <i class="fab <?php echo e($ikonSosmed[strtolower($sm['nama'])]); ?>"></i>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="flex flex-col gap-space-sm">
                <span class="font-headline-sm text-headline-sm text-surface-bright border-b border-surface-container-highest/10 pb-2">Tautan Cepat</span>
                <ul class="flex flex-col gap-2 font-body-md text-caption text-inverse-on-surface/80">
                    <?php if(setting('layanan_mandiri') == 1): ?>
                        <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="<?php echo e(site_url('layanan-mandiri')); ?>">Layanan Mandiri</a></li>
                    <?php endif; ?>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="<?php echo e(site_url('pengaduan')); ?>">Pengaduan Warga</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="<?php echo e(site_url('peraturan-desa')); ?>">Produk Hukum</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="<?php echo e(site_url('informasi-publik')); ?>">Informasi Publik</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="<?php echo e(site_url('pembangunan')); ?>">Pembangunan</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="<?php echo e(site_url('data-statistik/jenis-kelamin')); ?>">Statistik</a></li>
                    <li class="flex items-center gap-1.5 hover:text-tertiary-fixed transition-colors"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">chevron_right</span><a href="<?php echo e(site_url('galeri')); ?>">Galeri</a></li>
                </ul>
            </div>

            
            <div class="flex flex-col gap-space-sm">
                <span class="font-headline-sm text-headline-sm text-surface-bright border-b border-surface-container-highest/10 pb-2">Kontak &amp; Alamat</span>
                <div class="flex flex-col gap-3 font-body-md text-caption text-inverse-on-surface/80">
                    <?php if(!empty($desa['alamat_kantor'])): ?>
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] text-tertiary-fixed mt-0.5">location_on</span>
                            <span><?php echo e($desa['alamat_kantor']); ?><?php if(!empty($desa['kode_pos'])): ?>, Kode Pos <?php echo e($desa['kode_pos']); ?><?php endif; ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($desa['email_desa'])): ?>
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-tertiary-fixed">mail</span><span><?php echo e($desa['email_desa']); ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($desa['telepon'])): ?>
                        <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-tertiary-fixed">call</span><span><?php echo e($desa['telepon']); ?></span></div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="flex flex-col gap-space-sm">
                <span class="font-headline-sm text-headline-sm text-surface-bright border-b border-surface-container-highest/10 pb-2">Jam Pelayanan</span>
                <?php if($jamFooter->count() > 0): ?>
                    <div class="p-3 rounded-xl bg-surface-container-highest/10 flex flex-col gap-2 font-caption text-caption text-inverse-on-surface/90">
                        <?php $__currentLoopData = $jamFooter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex justify-between items-center">
                                <span class="text-inverse-on-surface/70"><?php echo e($hari->nama_hari); ?></span>
                                <span class="font-body-bold"><?php echo e($hari->status ? substr((string) $hari->jam_masuk, 0, 5) . ' - ' . substr((string) $hari->jam_keluar, 0, 5) : 'Libur'); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <div class="flex items-center gap-4 font-caption text-caption text-inverse-on-surface/80">
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px] text-tertiary-fixed">visibility</span> Hari ini: <?php echo e($statistik_pengunjung['hari_ini'] ?? 0); ?></span>
                    <span>Total: <?php echo e($statistik_pengunjung['total'] ?? 0); ?></span>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-surface-container-highest/10 flex flex-col md:flex-row items-center justify-between gap-3 font-caption text-caption text-inverse-on-surface/70 text-center md:text-left">
            <span>&copy; <?php echo e(date('Y')); ?> Pemerintah <?php echo e($namaDesaFooter); ?>. Hak cipta dilindungi.</span>
            <span>
                Tema dimodifikasi dari <a href="https://www.trivusi.web.id" class="underline" target="_blank" rel="noopener">Esensi <?php echo e($themeVersion); ?></a> &bull;
                <a href="https://opensid.my.id" class="underline" target="_blank" rel="noopener">OpenSID <?php echo e(ambilVersi()); ?></a>
            </span>
            <?php if(setting('tte')): ?>
                <img src="<?php echo e(asset('assets/images/bsre.png?v', false)); ?>" alt="Bsre" style="width: 150px;" />
            <?php endif; ?>
        </div>
    </div>
</footer>
<?php /**PATH D:\laragon\www\opensid\/desa/themes/temaku/resources/views/commons/footer.blade.php ENDPATH**/ ?>