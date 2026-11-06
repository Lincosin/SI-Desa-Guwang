<?php $__env->startSection('content'); ?>
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h4 class="box-title">DOKUMEN</h4>
        </div>
        <div class="box-body box-line">
            <div class="form-group">
                <?php echo $__env->make('admin.layouts.components.tombol_kembali_layanan_mandiri', ['url' => site_url('layanan-mandiri/dokumen'), 'label' => 'Dokumen'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
        <div class="box-body box-line">
            <h4><b><?php echo e($aksi); ?> DOKUMEN</b></h4>
        </div>

        <div class="box-body">
            <?php if(session('notif')): ?>
                <?php
                    $alertClass = session('notif')['status'] == 'success' ? 'alert-success' : 'alert-danger';
                ?>
                <div class="alert <?php echo e($alertClass); ?>" role="alert">
                    <?php echo e(session('notif')['pesan']); ?>

                </div>
            <?php endif; ?>
            <form id="validasi" action="<?php echo e($form_action); ?>" method="POST" enctype="multipart/form-data">
                <input type="number" class="hidden" name="id_pend" value="<?php echo e($id_pend); ?>" />
                <input type="hidden" name="dok_warga" value="<?php echo e($dokumen['dok_warga']); ?>" />
                <div class="form-group">
                    <label for="nama_dokumen">Nama Dokumen</label>
                    <input id="nama_dokumen" name="nama" class="form-control required <?php echo e($cek_anjungan['keyboard'] == 1 ? 'kbvtext' : ''); ?>" type="text" placeholder="Nama Dokumen" value="<?php echo e($dokumen['nama']); ?>" />
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Dokumen</label>
                    <select class="form-control select2 required" name="id_syarat" id="id_syarat">
                        <option value=""> -- Pilih Jenis Dokumen -- </option>
                        <?php $__currentLoopData = $jenis_syarat_surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->ref_syarat_id); ?>" <?php echo e($data->ref_syarat_id == $dokumen['id_syarat'] ? 'selected' : ''); ?>>
                                <?php echo e($data->ref_syarat_nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">File Dokumen</label>
                    <div class="input-group">
                        <input type="text" class="form-control <?php if(!$dokumen['id']): ?> required <?php endif; ?>" id="file_path" name="satuan" readonly />
                        <input type="file" class="hidden" id="file" name="satuan" accept=".jpg,.jpeg,.png,.pdf" />
                        <input type="hidden" name="old_file" value="<?php echo e($dokumen['satuan']); ?>" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-danger btn-flat" onclick="kamera();" id="ambil_kamera"><i class="fa fa-camera"></i> Kamera</button>
                            <button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                        </span>
                    </div>
                </div>
                <span class="help-block"><code>Kosongkan jika tidak ingin mengubah dokumen. Ukuran maksimal <strong><?php echo e(max_upload(true)); ?></strong>.</code></span>
                </hr>
                <?php if(!empty($kk)): ?>
                    <p><strong>Centang jika dokumen yang diupload berlaku juga untuk anggota keluarga di bawah ini. </strong></p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $kk[0]->anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item['nik'] != $nik): ?>
                                        <tr>
                                            <td class="padat">
                                                <input type="checkbox" name="anggota_kk[]" value="<?php echo e($item['id']); ?>" <?php echo e(in_array($item['id'], $anggota ?? []) ? 'checked' : ''); ?>>
                                            </td>
                                            <td><?php echo e($item['nik']); ?></td>
                                            <td><?php echo e($item['nama']); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                <?php endif; ?>

                <button type="submit" class="btn btn-social btn-info"><i class="fa fa-check"></i> Simpan</button>
            </form>
        </div>
    </div>
    <?php echo $__env->make('admin.layouts.components.capture', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/dokumen/form.blade.php ENDPATH**/ ?>