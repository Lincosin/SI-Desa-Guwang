<div class="tab-pane active" id="umum">
<div class="box-header with-border">
    <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => ci_route('identitas_desa'), 'label' => 'Data Identitas
    ' . ucwords(setting('sebutan_desa'))], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="box-body">
    <?php $koneksi = cek_koneksi_internet() && $status_pantau ? true : false; ?>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="nama_desa">Nama
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-8">
            <?php if($koneksi): ?>
            <select
                id="pilih_desa"
                name="pilih_desa"
                class="form-control input-sm select-nama-desa"
                data-placeholder="<?php echo e($main['nama_desa']); ?> - <?php echo e($main['nama_kecamatan']); ?> - <?php echo e($main['nama_kabupaten']); ?> - <?php echo e($main['nama_propinsi']); ?>"
                data-token="<?php echo e(config_item('token_pantau')); ?>"
                data-tracker='<?php echo e(config_item('server_pantau')); ?>'
                style="display: none;"></select>
            <?php endif; ?>
            <input
                type="hidden"
                id="nama_desa"
                class="form-control input-sm nama_desa required"
                minlength="3"
                maxlength="50"
                name="nama_desa"
                value="<?php echo e($main['nama_desa']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="kode_desa">Kode
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-2">
            <input
                readonly
                id="kode_desa"
                name="kode_desa"
                class="form-control input-sm <?php echo e(jecho($koneksi, false, 'bilangan')); ?> required"
                <?php echo e(jecho($koneksi, false, 'minlength="10" maxlength="10"')); ?>

                type="text"
                onkeyup="tampil_kode_desa()"
                placeholder="Kode <?php echo e(ucwords(setting('sebutan_desa'))); ?>"
                value="<?php echo e($main['kode_desa']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="kode_desa_bps">Kode BPS
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-2">
            <input
                id="kode_desa_bps"
                name="kode_desa_bps"
                type="text"
                class="form-control input-sm number"
                readonly
                value="<?php echo e($main['kode_desa_bps']); ?>"
                <?php echo e(jecho($koneksi, false, 'minlength="10" maxlength="10"')); ?> />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="kode_pos">Kode Pos
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-2">
            <input
                id="kode_pos"
                name="kode_pos"
                class="form-control input-sm number"
                minlength="5"
                maxlength="5"
                type="text"
                placeholder="Kode Pos <?php echo e(ucwords(setting('sebutan_desa'))); ?>"
                value="<?php echo e($main['kode_pos']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="pamong_id">
            <?php echo e(ucwords(setting('sebutan_kepala_desa'))); ?></label>
        <div class="col-sm-8">
            <input class="form-control input-sm" type="text" placeholder="Nama <?php echo e(ucwords(setting('sebutan_kepala_desa'))); ?>" value="<?php echo e($main['nama_kepala_desa']); ?>" readonly />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">NIP <?php echo e(ucwords(setting('sebutan_kepala_desa'))); ?></label>
        <div class="col-sm-8">
            <input class="form-control input-sm" type="text" placeholder="NIP <?php echo e(ucwords(setting('sebutan_kepala_desa'))); ?>" value="<?php echo e($main['nip_kepala_desa']); ?>" readonly />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="alamat_kantor">Alamat Kantor
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-8">
            <textarea
                id="alamat_kantor"
                name="alamat_kantor"
                class="form-control input-sm alamat required"
                maxlength="100"
                placeholder="Alamat Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?>"
                rows="3"
                style="resize:none;"><?php echo e($main['alamat_kantor']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="email_desa">E-Mail
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-8">
            <input
                id="email_desa"
                name="email_desa"
                class="form-control input-sm email"
                maxlength="50"
                type="email"
                placeholder="E-Mail <?php echo e(ucwords(setting('sebutan_desa'))); ?>"
                value="<?php echo e($main['email_desa']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="telepon">Nomor Telepon
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-8">
            <input
                id="telepon"
                name="telepon"
                class="form-control input-sm bilangan"
                type="text"
                maxlength="15"
                placeholder="Telepon <?php echo e(ucwords(setting('sebutan_desa'))); ?>"
                value="<?php echo e($main['telepon']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="telepon">Nomor Ponsel
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-8">
            <input
                id="telepon-operator"
                name="nomor_operator"
                class="form-control input-sm bilangan"
                type="text"
                maxlength="15"
                placeholder="Nomor Ponsel"
                value="<?php echo e($main['nomor_operator']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="website">Website
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></label>
        <div class="col-sm-8">
            <input
                id="website"
                name="website"
                class="form-control input-sm url"
                maxlength="50"
                type="text"
                placeholder="Website <?php echo e(ucwords(setting('sebutan_desa'))); ?>"
                value="<?php echo e($main['website']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="nama_kecamatan">Nama
            <?php echo e(ucwords(setting('sebutan_kecamatan'))); ?></label>
        <div class="col-sm-8">
            <input
                readonly
                id="nama_kecamatan"
                name="nama_kecamatan"
                class="form-control input-sm required"
                type="text"
                placeholder="Nama <?php echo e(ucwords(setting('sebutan_kecamatan'))); ?>"
                value="<?php echo e($main['nama_kecamatan']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="kode_kecamatan">Kode
            <?php echo e(ucwords(setting('sebutan_kecamatan'))); ?></label>
        <div class="col-sm-2">
            <input
                readonly
                id="kode_kecamatan"
                name="kode_kecamatan"
                class="form-control input-sm required"
                type="text"
                placeholder="Kode <?php echo e(ucwords(setting('sebutan_kecamatan'))); ?>"
                value="<?php echo e($main['kode_kecamatan']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="nama_kecamatan">Nama
            <?php echo e(ucwords(setting('sebutan_camat'))); ?></label>
        <div class="col-sm-8">
            <input
                id="nama_kepala_camat"
                name="nama_kepala_camat"
                class="form-control input-sm nama required"
                maxlength="50"
                type="text"
                placeholder="Nama <?php echo e(ucwords(setting('sebutan_camat'))); ?>"
                value="<?php echo e($main['nama_kepala_camat']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="nip_kepala_camat">NIP
            <?php echo e(ucwords(setting('sebutan_camat'))); ?></label>
        <div class="col-sm-4">
            <input
                id="nip_kepala_camat"
                name="nip_kepala_camat"
                class="form-control input-sm nomor_sk"
                maxlength="50"
                type="text"
                placeholder="NIP <?php echo e(ucwords(setting('sebutan_camat'))); ?>"
                value="<?php echo e($main['nip_kepala_camat']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="nama_kabupaten">Nama
            <?php echo e(ucwords(setting('sebutan_kabupaten'))); ?></label>
        <div class="col-sm-8">
            <input
                readonly
                id="nama_kabupaten"
                name="nama_kabupaten"
                class="form-control input-sm required"
                type="text"
                placeholder="Nama <?php echo e(ucwords(setting('sebutan_kabupaten'))); ?>"
                value="<?php echo e($main['nama_kabupaten']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="kode_kabupaten">Kode
            <?php echo e(ucwords(setting('sebutan_kabupaten'))); ?></label>
        <div class="col-sm-2">
            <input
                readonly
                id="kode_kabupaten"
                name="kode_kabupaten"
                class="form-control input-sm required"
                type="text"
                placeholder="Kode <?php echo e(ucwords(setting('sebutan_kabupaten'))); ?>"
                value="<?php echo e($main['kode_kabupaten']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="nama_propinsi">Nama Provinsi</label>
        <div class="col-sm-8">
            <input
                readonly
                id="nama_propinsi"
                name="nama_propinsi"
                class="form-control input-sm required"
                type="text"
                placeholder="Nama Propinsi"
                value="<?php echo e($main['nama_propinsi']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="kode_propinsi">Kode Provinsi</label>
        <div class="col-sm-2">
            <input
                readonly
                id="kode_propinsi"
                name="kode_propinsi"
                class="form-control input-sm required"
                type="text"
                placeholder="Kode Provinsi"
                value="<?php echo e($main['kode_propinsi']); ?>" />
        </div>
    </div>
    <hr>
    <h5 class="text-bold"> KONTAK PEMBERITAHUAN</h5>
    <?php
    $required = !config_item('demo_mode') ? 'required' : '';
    ?>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="nama_kontak">Nama <?php echo e(ucwords(setting('sebutan_pemerintah_desa'))); ?></label>
        <div class="col-sm-8">
            <input
                id="nama_kontak"
                name="nama_kontak"
                class="form-control input-sm nama <?php echo e($required); ?>"
                type="text"
                placeholder="Nama"
                value="<?php echo e($main['nama_kontak']); ?>"
                maxlength="50" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="hp_kontak">No. HP/WA</label>
        <div class="col-sm-8">
            <input
                id="hp_kontak"
                name="hp_kontak"
                class="form-control input-sm angka <?php echo e($required); ?>"
                type="text"
                placeholder="No. HP"
                value="<?php echo e($main['hp_kontak']); ?>"
                maxlength="15" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="jabatan_kontak">Jabatan</label>
        <div class="col-sm-8">
            <input
                id="jabatan_kontak"
                name="jabatan_kontak"
                class="form-control input-sm nama <?php echo e($required); ?>"
                type="text"
                placeholder="Jabatan"
                value="<?php echo e($main['jabatan_kontak']); ?>"
                maxlength="50" />
        </div>
    </div>
</div>
<div class="box-footer">
    <button type="reset" class="btn btn-social btn-danger btn-sm"><i class="fa fa-times"></i>
        Batal</button>
    <button type="submit" class="btn btn-social btn-info btn-sm pull-right simpan"><i class="fa fa-check"></i>
        Simpan</button>
</div>
</div><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/identitas_desa/tab-umum.blade.php ENDPATH**/ ?>