<?php $__env->startPush('css'); ?>
    <style>
        .ringkasan-surat .info-box { min-height: 64px; margin-bottom: 12px; box-shadow: 0 1px 2px rgba(0, 0, 0, .12); }
        .ringkasan-surat .info-box-icon { width: 64px; height: 64px; line-height: 64px; font-size: 28px; }
        .ringkasan-surat .info-box-content { margin-left: 64px; padding: 8px 10px; }
        .ringkasan-surat .info-box-text { white-space: normal; font-size: 12px; line-height: 1.3; }
        .ringkasan-surat .info-box-number { font-size: 20px; }
        .ringkasan-surat a.ringkasan-tautan, .ringkasan-surat a.ringkasan-tautan:hover { color: inherit !important; text-decoration: none; }
        .tahapan-surat { min-width: 230px; }
        .tahapan-surat ol { display: flex; list-style: none; margin: 0; padding: 0; }
        .tahapan-surat li { flex: 1; position: relative; text-align: center; font-size: 11px; color: #999; }
        .tahapan-surat li::before { content: ''; position: absolute; top: 11px; left: -50%; width: 100%; height: 2px; background: #ddd; }
        .tahapan-surat li:first-child::before { display: none; }
        .tahapan-surat .titik { position: relative; z-index: 1; display: inline-block; width: 22px; height: 22px; line-height: 22px; border-radius: 50%; background: #ddd; color: #fff; font-weight: bold; }
        .tahapan-surat .label-tahap { display: block; margin-top: 3px; line-height: 1.2; }
        .tahapan-surat li.selesai, .tahapan-surat li.aktif, .tahapan-surat li.perhatian { color: #333; }
        .tahapan-surat li.selesai::before, .tahapan-surat li.aktif::before, .tahapan-surat li.perhatian::before { background: #00a65a; }
        .tahapan-surat li.selesai .titik { background: #00a65a; }
        .tahapan-surat li.aktif .titik { background: #3c8dbc; box-shadow: 0 0 0 3px rgba(60, 141, 188, .25); }
        .tahapan-surat li.perhatian .titik { background: #f39c12; box-shadow: 0 0 0 3px rgba(243, 156, 18, .25); }
        .tahapan-surat li.aktif .label-tahap, .tahapan-surat li.perhatian .label-tahap { font-weight: bold; }
        .tahapan-catatan { margin-top: 6px; font-size: 12px; color: #555; }
        /* KUSTOM permohonan dibatalkan */
        .alasan-batal { font-size: 12px; padding: 6px 8px; background: #fdf1f0; border-left: 3px solid #dd4b39; border-radius: 2px; }
        .alasan-batal-isi { margin-top: 3px; color: #333; white-space: normal; }
        .filter-permohonan { margin-bottom: 10px; }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layanan_mandiri.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box box-solid">
        <div class="box-header with-border bg-green">
            <h4 class="box-title">Surat</h4>
        </div>
        <div class="box-body box-line">
            <a href="<?php echo e(ci_route('layanan-mandiri.surat.buat')); ?>" class="btn btn-social btn-success visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-pencil-square-o"></i>Buat Surat
            </a>
            <a href="<?php echo e(ci_route('layanan-mandiri.arsip-surat')); ?>" class="btn btn-social btn-primary visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-file-zip-o"></i>Arsip Surat
            </a>
            <a href="<?php echo e(ci_route('layanan-mandiri.permohonan-surat')); ?>" class="btn btn-social bg-purple visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                <i class="fa fa-file-word-o"></i>Permohonan Surat
            </a>
        </div>
        <div class="box-body box-line">
            <h4><b>DAFTAR PERMOHONAN SURAT</b></h4>
        </div>
        
        <div class="box-body box-line">
            <div class="row ringkasan-surat">
                <div class="col-xs-12 col-sm-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-hourglass-half"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sedang Diproses</span>
                            <span class="info-box-number"><?php echo e($ringkasan['diproses']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-pencil"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Perlu Dilengkapi</span>
                            <span class="info-box-number"><?php echo e($ringkasan['dilengkapi']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <a href="<?php echo e(ci_route('layanan-mandiri.arsip-surat')); ?>" class="ringkasan-tautan" title="Lihat di Arsip Surat">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Selesai</span>
                                <span class="info-box-number"><?php echo e($ringkasan['selesai']); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php if($ringkasan['siap'] > 0): ?>
                <div class="callout callout-success" style="margin-bottom: 0;">
                    <p><i class="fa fa-thumbs-o-up"></i> <b><?php echo e($ringkasan['siap']); ?> surat</b> sudah disetujui <?php echo e($sebutan_kades); ?>. Tekan <b>Lihat Surat</b> atau unduh suratnya, lalu tekan <b>Selesai</b> setelah surat Anda terima.</p>
                </div>
            <?php elseif($ringkasan['dilengkapi'] > 0): ?>
                <div class="callout callout-warning" style="margin-bottom: 0;">
                    <p><i class="fa fa-pencil"></i> <b><?php echo e($ringkasan['dilengkapi']); ?> permohonan</b> perlu dilengkapi. Tekan <b>Lengkapi Surat</b> pada permohonan tersebut.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="box-body">
            
            <div class="filter-permohonan">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-primary filter-tampil" data-tampil="aktif"><i class="fa fa-list"></i> Permohonan</button>
                    <button type="button" class="btn btn-sm btn-default filter-tampil" data-tampil="dibatalkan"><i class="fa fa-times-circle"></i> Dibatalkan <span class="badge"><?php echo e($ringkasan['dibatalkan']); ?></span></button>
                </div>
                <?php if($ringkasan['dibatalkan'] > 0): ?>
                    
                    <button type="button" class="btn btn-sm btn-danger hapus-dibatalkan hapus-semua-dibatalkan" style="display: none; margin-left: 5px;"
                        data-url="<?php echo e(ci_route('layanan-mandiri.surat.hapus-dibatalkan')); ?>" data-semua="1"><i class="fa fa-trash-o"></i> Hapus Semua yang Dibatalkan</button>
                <?php endif; ?>
                <p class="text-muted small keterangan-filter" style="margin: 6px 0 0;">Permohonan yang dibatalkan otomatis disembunyikan dari daftar ini setelah <?php echo e($hari_tampil_dibatalkan); ?> hari. Semua permohonan yang dibatalkan tetap bisa dilihat di <b>Dibatalkan</b>.</p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-data" id="tabeldata">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>No Antrean</th>
                            <th>Jenis Surat</th>
                            <th>Tahapan</th>
                            <th>Tanggal Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal-lihat-surat" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" style="width: 95%; max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lihat Surat</h4>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <iframe src="about:blank" style="display: block; width: 100%; height: 75vh; border: 0;" title="Pratinjau surat"></iframe>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-social bg-fuchsia btn-sm unduh-surat" download><i class="fa fa-download"></i>Unduh PDF</a>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal-hapus-dibatalkan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="#" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus Riwayat Permohonan</h4>
                </div>
                <div class="modal-body">
                    <p class="pesan-hapus"></p>
                    <p class="text-muted">Riwayat yang dihapus tidak bisa dikembalikan. Dokumen syarat di menu <b>Dokumen</b> tidak ikut terhapus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-social btn-danger btn-sm"><i class="fa fa-trash-o"></i>Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal fade" id="modal-selesai-surat" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="#" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tandai Surat Selesai</h4>
                </div>
                <div class="modal-body">
                    <p>Tandai surat <b class="judul-surat"></b> sebagai selesai?</p>
                    <p class="text-muted">Pastikan Anda sudah melihat atau mengunduh suratnya. Setelah selesai, surat pindah ke menu <b>Arsip Surat</b> dan tetap bisa diunduh lagi kapan saja.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-social btn-success btn-sm"><i class="fa fa-check-circle"></i>Ya, Selesai</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var tampil = 'aktif'; // KUSTOM permohonan dibatalkan
            var tabelData = $('#tabeldata').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': {
                    'url': '<?php echo e(base_url('layanan-mandiri/permohonan-surat')); ?>',
                    // KUSTOM permohonan dibatalkan: filter Permohonan / Dibatalkan
                    'data': function(d) {
                        d.tampil = tampil;
                    }
                },
                'order': [
                    [5, 'desc'] // KUSTOM: kolom Tahapan ditambahkan
                ],
                'columnDefs': [{
                        'searchable': false,
                        'targets': [0, 1, 4]
                    },
                    {
                        'orderable': false,
                        'targets': [0, 1, 4]
                    }
                ],
                'columns': [{
                        data: 'DT_RowIndex',
                        class: 'padat',
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                    },
                    {
                        data: 'no_antrian',
                        class: 'padat',
                    },
                    {
                        data: 'surat.nama',
                        name: 'surat.nama',
                    },
                    {
                        data: 'tahapan',
                        name: 'tahapan',
                    },
                    {
                        data: 'created_at',
                        class: 'padat',
                    },
                ],
            });

            // KUSTOM permohonan dibatalkan: ganti filter daftar
            $('.filter-tampil').on('click', function() {
                tampil = $(this).data('tampil');
                $('.filter-tampil').removeClass('btn-primary').addClass('btn-default');
                $(this).removeClass('btn-default').addClass('btn-primary');
                $('.keterangan-filter').toggle(tampil === 'aktif');
                $('.hapus-semua-dibatalkan').toggle(tampil === 'dibatalkan'); // KUSTOM hapus riwayat
                tabelData.ajax.reload();
            });

            // KUSTOM lihat surat: tampilkan surat yang sudah jadi di jendela pratinjau; di layar kecil dibuka di tab baru.
            // Modal dipindah ke body agar tidak terkurung efek CSS (blur/transform) pembungkus konten tema.
            $('#modal-lihat-surat').appendTo('body');
            $('#tabeldata').on('click', 'a.lihat-surat', function(e) {
                if (window.innerWidth < 768) {
                    return;
                }
                e.preventDefault();
                var url = $(this).attr('href');
                var modal = $('#modal-lihat-surat');
                modal.find('.modal-title').text($(this).data('judul') || 'Lihat Surat');
                modal.find('iframe').attr('src', url);
                modal.find('.unduh-surat').attr('href', url);
                modal.modal('show');
            });

            $('#modal-lihat-surat').on('hidden.bs.modal', function() {
                $(this).find('iframe').attr('src', 'about:blank');
            });

            // KUSTOM: tombol Selesai -> konfirmasi, lalu kirim (POST) ke layanan-mandiri/surat/selesai/{id}
            $('#modal-selesai-surat').appendTo('body');
            $('#tabeldata').on('click', 'button.selesai-surat', function(e) {
                e.preventDefault();
                var modal = $('#modal-selesai-surat');
                modal.find('form').attr('action', $(this).data('url'));
                modal.find('.judul-surat').text($(this).data('judul') || '');
                modal.modal('show');
            });
            // KUSTOM hapus riwayat: konfirmasi, lalu kirim (POST) ke layanan-mandiri/surat/hapus-dibatalkan/{id?}
            $('#modal-hapus-dibatalkan').appendTo('body');
            $(document).on('click', 'button.hapus-dibatalkan', function(e) {
                e.preventDefault();
                var modal = $('#modal-hapus-dibatalkan');
                modal.find('form').attr('action', $(this).data('url'));
                if ($(this).data('semua')) {
                    modal.find('.pesan-hapus').html('Hapus <b>semua</b> riwayat permohonan yang dibatalkan?');
                } else {
                    modal.find('.pesan-hapus').empty().append('Hapus riwayat permohonan ', $('<b>').text($(this).data('judul') || 'surat'), ' yang dibatalkan?');
                }
                modal.modal('show');
            });
            $('#modal-hapus-dibatalkan form').on('submit', function() {
                $(this).find('button[type=submit]').prop('disabled', true);
            });
            $('#modal-selesai-surat form').on('submit', function() {
                $(this).find('button[type=submit]').prop('disabled', true);
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/surat/permohonan.blade.php ENDPATH**/ ?>