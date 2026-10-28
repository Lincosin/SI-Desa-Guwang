<?php $__env->startSection('content'); ?>
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h4 class="box-title">DOKUMEN</h4>
        </div>

        <div class="box-body box-line">
            <a href="<?php echo e(ci_route('layanan-mandiri.dokumen.form')); ?>" class="btn btn-social btn-success visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i>Tambah Dokumen</a>
        </div>

        <div class="box-body box-line">
            <?php if(session('notif')): ?>
                <?php
                    $alertClass = session('notif')['status'] == 'success' ? 'alert-success' : 'alert-danger';
                ?>
                <div class="alert <?php echo e($alertClass); ?>" role="alert">
                    <?php echo e(session('notif')['pesan']); ?>

                </div>
            <?php endif; ?>
            <?php echo $__env->make('layanan_mandiri.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-data" id="tabeldata">
                    <thead>
                        <tr>
                            <th class="padat">No</th>
                            <th class="aksi">Aksi</th>
                            <th width="20%">Jenis Dokumen</th>
                            <th>Nama Dokumen</th>
                            <th class="padat">Tanggal Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var tabelData = $('#tabeldata').DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': "<?php echo e(ci_route('layanan-mandiri.dokumen.datatables')); ?>",
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'padat',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'aksi',
                        class: 'padat',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'id_syarat',
                        name: 'id_syarat',
                        width: '20%',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'tgl_upload',
                        name: 'tgl_upload',
                        class: 'padat',
                    },
                ],
                order: [3, 'asc'],
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/dokumen/index.blade.php ENDPATH**/ ?>