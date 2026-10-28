<?php $__env->startSection('content'); ?>
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
            <h4><b>DAFTAR ARSIP SURAT</b></h4>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-data" id="tabeldata">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nomor Surat</th>
                            <th>Jenis Surat</th>
                            <th>Ditandatangani Oleh</th>
                            <th>Tanggal</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var isTte = "<?php echo e(setting('tte')); ?>";
            var tabelData = $('#tabeldata').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': '<?php echo e(base_url('layanan-mandiri/arsip-surat')); ?>',
                'order': [
                    [5, 'desc']
                ],
                'columnDefs': [{
                        'searchable': false,
                        'targets': [0, 1]
                    },
                    {
                        'orderable': false,
                        'targets': [0, 1]
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
                        data: 'no_surat',
                        class: 'padat',
                    },
                    {
                        data: null,
                        render: function(data) {
                            return data?.format_surat?.nama ?? ''
                        },
                        name: 'formatSurat.nama',
                    },
                    {
                        data: 'nama_pamong',
                        class: 'padat'
                    },
                    {
                        data: 'tanggal',
                        class: 'padat',
                    },
                ],
            });

            $('button.keterangan').click(function(event) {
                $(this).popover('show');
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

            // KUSTOM lihat surat: kolom Aksi tetap tampil walau TTE nonaktif, karena berisi tombol Lihat/Unduh surat
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/surat/arsip.blade.php ENDPATH**/ ?>