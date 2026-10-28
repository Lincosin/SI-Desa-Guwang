<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    <h1>
        Pendaftar Layanan Mandiri
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Pendaftar Layanan Mandiri</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box box-info">
        <div class="box-header with-border">
            <?php if (isset($component)) { $__componentOriginal7a3eb12988970aebf81945dcf52d7c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a3eb12988970aebf81945dcf52d7c46 = $attributes; } ?>
<?php $component = App\View\Components\TambahButton::resolve(['modal' => 'true','judul' => 'Tambah','url' => 'mandiri/ajax_pin'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tambah-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TambahButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7a3eb12988970aebf81945dcf52d7c46)): ?>
<?php $attributes = $__attributesOriginal7a3eb12988970aebf81945dcf52d7c46; ?>
<?php unset($__attributesOriginal7a3eb12988970aebf81945dcf52d7c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7a3eb12988970aebf81945dcf52d7c46)): ?>
<?php $component = $__componentOriginal7a3eb12988970aebf81945dcf52d7c46; ?>
<?php unset($__componentOriginal7a3eb12988970aebf81945dcf52d7c46); ?>
<?php endif; ?>
        </div>
        <div class="box-body">
            <div class="row mepet">
                <?php echo $__env->make('admin.layouts.components.select_status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <hr class="batas">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabeldata">
                    <thead>
                        <tr>
                            <th class="padat">NO</th>
                            <th class="aksi">AKSI</th>
                            <th class="padat">NIK</th>
                            <th>Nama Penduduk</th>
                            <th class="padat">Tanggal Buat</th>
                            <th class="padat">Login Terakhir</th>
                            <th class="padat">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(session('info')): ?>
        <?php
            $info = session('info');
        ?>
        <div
            class="modal fade"
            id="pinBox"
            role="dialog"
            aria-labelledby="myModalLabel"
            aria-hidden="true"
            data-backdrop="false"
            data-keyboard="false"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header btn-info">
                        <button type='button' class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title' id='myModalLabel">PIN Warga (<?php echo e($info['nama']); ?>)</h4>
                    </div>
                    <form action="<?php echo e(ci_route('mandiri.kirim', $info['id'])); ?>" method="post" id="validasi" target="_blank">
                        <input type="hidden" id="pin" name="pin" value="<?php echo e($info['pin']); ?>">
                        <div class="modal-body">
                            Berikut adalah kode pin yang baru saja di hasilkan, silakan dicatat atau di ingat dengan baik,
                            kode pin ini sangat rahasia, dan hanya bisa dilihat sekali ini lalu setelah itu hanya bisa di
                            reset saja.<br />

                            <h4>Kode PIN : <?php echo e($info['pin']); ?></h4>

                            <?php if(session('notif_kirim_verifikasi')): ?>
                                <?php
                                    $kirim_verifikasi = session('notif_kirim_verifikasi');
                                ?>
                                <div class="callout callout-<?php echo e($kirim_verifikasi['status'] == 1 ? 'success' : 'danger'); ?>" style="margin-top: 30px;">
                                    <p><?php echo e($kirim_verifikasi['pesan']); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-social btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-sign-out"></i> Tutup</button>
                            <?php if(cek_koneksi_internet() && $info['pin'] && $info['telepon']): ?>
                                <button type="submit" class="btn btn-social btn-success btn-sm"><i class="fa fa-whatsapp"></i> Kirim</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            let status = <?php echo json_encode(request('status', 1), 512) ?>;

            $('#status').val(status).trigger('change');

            <?php if(session('info')): ?>
                $('#pinBox').modal('show');
            <?php endif; ?>

            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(ci_route('mandiri.datatables')); ?>",
                    type: "GET",
                    data: function(req) {
                        req.status = $('#status').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'padat',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'penduduk.nik',
                        name: 'penduduk.nik',
                        defaultContent: '',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'penduduk.nama',
                        name: 'penduduk.nama',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'tanggal_buat',
                        name: 'tanggal_buat',
                        searchable: false,
                        orderable: true,
                        class: 'padat'
                    },
                    {
                        data: 'last_login',
                        name: 'last_login',
                        searchable: false,
                        orderable: true,
                        class: 'padat'
                    },
                    {
                        data: 'status_label',
                        name: 'status',
                        searchable: false,
                        orderable: true,
                        class: 'padat'
                    },
                ],
                order: [
                    [4, 'desc']
                ],
                createdRow: function(row, data, dataIndex) {
                    if (!data.penduduk.telepon) {
                        $(row).addClass('select-row')
                    }
                },
            });

            if (ubah == 0 && hapus == 0) {
                TableData.column(1).visible(false);
            }

            $('#status').change(function() {
                TableData.draw();
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layanan_mandiri/daftar/index.blade.php ENDPATH**/ ?>