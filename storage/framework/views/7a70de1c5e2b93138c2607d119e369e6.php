<?php echo form_open($form_action, 'id="validasi"'); ?>

<div class="modal-body">
    <table class="table table-hover">
        <tr>
            <th width="20%">NIK</td>
            <td width="1%"> : </td>
            <td><?php echo e($penduduk['nik']); ?></td>
        </tr>
        <tr>
            <th>Nama Warga</td>
            <td> : </td>
            <td><?php echo e($penduduk['nama']); ?></td>
        </tr>
        
        <tr>
            <th>No. HP</td>
            <td> : </td>
            <td><?php echo e($penduduk['telepon'] ?: '-'); ?></td>
        </tr>
        <tr>
            <th>Email</td>
            <td> : </td>
            <td><?php echo e($penduduk['email'] ?: '-'); ?></td>
        </tr>
    </table>
    <div class="box box-danger">
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Scan KTP</label>
                <img class="img-responsive" src="<?php echo e(base_url("desa/upload/pendaftaran/{$penduduk['scan_ktp']}")); ?>" alt="Scan KTP" />
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Scan KK</label>
                <img class="img-responsive" src="<?php echo e(base_url("desa/upload/pendaftaran/{$penduduk['scan_kk']}")); ?>" alt="Scan KK" />
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Foto Selfie</label>
                <img class="img-responsive" src="<?php echo e(base_url("desa/upload/pendaftaran/{$penduduk['foto_selfie']}")); ?>" alt="Foto Selfie" />
            </div>
        </div>
    </div>
    <div class="form-group">
        
        <label style="margin-top: 10px; margin-bottom: 0px;">Setelah diverifikasi, beri tahu warga melalui : </label>
        <div class="radio">
            <label style="font-size: 13.7px;">
                <input type="radio" value="tanpa_kirim" id="tanpa_kirim" name="pilihan_kirim" checked> Tidak dikirim (beri tahu warga sendiri)
            </label>
        </div>
        <?php if($tgl_verifikasi_email): ?>
            <div class="radio">
                <label style="font-size: 13.7px;">
                    <input type="radio" value="kirim_email" id="kirim_email" name="pilihan_kirim"> Email
                </label>
            </div>
        <?php endif; ?>

        <?php if($tgl_verifikasi_telegram): ?>
            <div class="radio">
                <label style="font-size: 13.7px;">
                    <input type="radio" value="kirim_telegram" id="kirim_telegram" name="pilihan_kirim"> Telegram
                </label>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-social btn-flat btn-danger btn-sm pull-left"><i class='fa fa-times'></i> Batal</button>

    <button type="submit" class="btn btn-social btn-flat btn-info btn-sm" id="ok"><i class='fa fa-check'></i> Verifikasi &amp; Aktifkan</button>
</div>
</form>
<?php echo $__env->make('admin.layouts.components.form_modal_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layanan_mandiri/daftar/ajax_verifikasi_warga.blade.php ENDPATH**/ ?>