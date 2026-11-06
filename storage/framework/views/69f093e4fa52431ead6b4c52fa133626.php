<?php echo $__env->make('admin.layouts.components.jsondiffpatch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="box box-info">
    <div class="box-body">
        <div class="row mepet">
            <div class="col-sm-2">
                <select class="form-control input-sm select2" id="log_name" name="log_name">
                    <option value="">Pilih Kategori</option>
                    <?php $__currentLoopData = $nama_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control input-sm select2" id="log_event" name="log_event">
                    <option value="">Pilih Peristiwa</option>
                    <?php $__currentLoopData = $peristiwa_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control input-sm select2" id="username" name="username">
                    <option value="">Pilih Pengguna</option>
                    <?php $__currentLoopData = $pengguna_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <hr class="batas">
        <div class="table-responsive">
            <table class="table table-bordered table-hover tabel-daftar" id="tabel-logaktifitas">
                <thead class="bg-gray judul-besar">
                    <tr>
                        <th class="padat">No</th>
                        <th class="padat">Aksi</th>
                        <th class="padat">Kategori</th>
                        <th class="padat">Peristiwa</th>
                        <th class="padat">Subjek Tipe</th>
                        <th class="padat">Penyebab Tipe</th>
                        <th class="padat">Pengguna</th>
                        <th>Deskripsi</th>
                        <th class="padat">Dibuat Pada</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="logDetailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-exclamation-triangle text-red"></i> &nbsp;Detail Log Aktivitas</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-perubahan" data-toggle="tab">Perubahan</a></li>
                    <li><a href="#tab-properties" data-toggle="tab">Properti Lain</a></li>
                </ul>
                <div class="tab-content" style="margin-top: 15px;">
                    <div class="tab-pane active" id="tab-perubahan">
                        <div id="json-diff-output"></div>
                    </div>
                    <div class="tab-pane" id="tab-properties">
                        <table class="table table-bordered table-striped" id="properties-table">
                            <thead>
                                <tr>
                                    <th>Kunci</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-social btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-sign-out"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    let TableData;
    let tableLogAktifitasInitialized = false;

    function loadLogAktifitas() {
        if (tableLogAktifitasInitialized) {
            return;
        }

        TableData = $('#tabel-logaktifitas').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[8, 'desc']],
            ajax: {
                url: "<?php echo e(route('info_sistem.datatables-log')); ?>",
                data: function(d) {
                    d.log_name = $('#log_name').val();
                    d.log_event = $('#log_event').val();
                    d.username = $('#username').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', class: 'padat', searchable: false, orderable: false },
                { data: 'aksi', name: 'aksi', class: 'padat', searchable: false, orderable: false },
                { data: 'log_name', name: 'log_name', class: 'padat' },
                {
                    data: function(data) {
                        switch (data.event) {
                            case 'created': return '<h6><span class="label label-success">Dibuat</span></h6>';
                            case 'updated': return '<h6><span class="label label-warning">Diubah</span></h6>';
                            case 'deleted': return '<h6><span class="label label-danger">Dihapus</span></h6>';
                            case 'Gagal': return `<h6><span class="label label-danger">${data.event}</span></h6>`;
                            default: return `<h6><span class="label label-info">${data.event}</span></h6>`;
                        }
                    },
                    name: 'event',
                    class: 'padat',
                },
                { data: 'subject_type', name: 'subject_type', class: 'padat' },
                { data: 'causer_type', name: 'causer_type', class: 'padat' },
                { data: 'username', name: 'username', class: 'padat' },
                { data: 'description', name: 'description' },
                { data: 'created_at', name: 'created_at', class: 'padat' }
            ]
        });

        $('#log_name, #log_event, #username').on('select2:select', function () {
            TableData.draw();
        });

        tableLogAktifitasInitialized = true;
    }

    $(document).on('click', '.btn-detail-log', function(e) {
        e.preventDefault();

        if (! TableData) {
            return;
        }

        const row = TableData.row($(this).closest('tr')).data();
        const props = row.properties || {};
        const changes = {
            old: props.old || {},
            attributes: props.attributes || {}
        };

        // Tampilkan perubahan (diff)
        if (Object.keys(changes.old).length && Object.keys(changes.attributes).length) {
            const delta = jsondiffpatch.diff(changes.old, changes.attributes);
            const htmlDiff = jsondiffpatch.formatters.html.format(delta, changes.old);
            $('#json-diff-output').html(htmlDiff);
        } else {
            $('#json-diff-output').html('<div class="text-muted text-center">Tidak ada perubahan data.</div>');
        }

         // Tampilkan properti lain (selain old dan attributes)
        const otherProps = Object.assign({}, props);
        delete otherProps.old;
        delete otherProps.attributes;

        const $tbody = $('#properties-table tbody');
        $tbody.empty();

        if (Object.keys(otherProps).length) {
            $.each(otherProps, function(key, val) {
                let valDisplay;
                try {
                    let parsed = (typeof val === 'string') ? JSON.parse(val) : val;
                    valDisplay = (typeof parsed === 'object') ? `<pre>${JSON.stringify(parsed, null, 2)}</pre>` : parsed;
                } catch (e) {
                    valDisplay = val;
                }
                $tbody.append(`<tr><td>${key}</td><td>${valDisplay}</td></tr>`);
            });
        } else {
            $tbody.append(`<tr><td colspan="2" class="text-muted text-center">Tidak ada properti tambahan.</td></tr>`);
        }

        $('#logDetailModal').modal('show');
    });
</script>
<?php $__env->stopPush(); ?>

<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/setting/info_sistem/log_aktivitas.blade.php ENDPATH**/ ?>