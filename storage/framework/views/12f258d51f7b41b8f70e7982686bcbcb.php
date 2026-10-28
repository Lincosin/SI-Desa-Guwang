<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    <h1>
        <?php echo e(SebutanDesa('Identitas [Desa]')); ?>

        <small>Ubah Data</small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('identitas_desa')); ?>"><?php echo e(SebutanDesa('Identitas [Desa]')); ?></a></li>
    <li class="active">Ubah Data</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.identitas_desa.info_kades', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo form_open_multipart($form_action, 'class="form-horizontal" id="validasi"'); ?>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile preview-img">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo e(gambar_desa($main['path_logo'])); ?>" alt="Logo">
                    <br />
                    <p class="text-center text-bold">Lambang <?php echo e(ucwords(setting('sebutan_desa'))); ?></p>
                    <p class="text-muted text-center text-red">(Kosongkan, jika logo tidak berubah)</p>
                    <br />
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="ukuran">Dimensi logo (persegi)</label>
                        <div class="col-sm-12">
                            <input
                                id="ukuran"
                                name="ukuran"
                                class="form-control input-sm number"
                                min="100"
                                max="400"
                                type="text"
                                placeholder="Kosongkan jika ingin dimensi bawaan"
                            />
                        </div>
                    </div>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control file-path" readonly>
                        <input type="file" class="hidden file-input" name="logo" accept=".gif,.jpg,.jpeg,.png,.webp">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat file-browser"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-body box-profile preview-img">
                    <img class="img-responsive" src="<?php echo e(gambar_desa($main['path_kantor_desa'], true)); ?>" alt="Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?>">
                    <br />
                    <p class="text-center text-bold">Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?></p>
                    <p class="text-muted text-center text-red">(Kosongkan, jika kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?> tidak
                        berubah)</p>
                    <br />
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control file-path" readonly>
                        <input type="file" class="hidden file-input" name="kantor_desa" accept=".gif,.jpg,.jpeg,.png,.webp">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat file-browser"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#umum" data-toggle="tab">Umum</a></li>
                    <?php if($cek_profil_desa): ?>
                    <li><a href="#profil" data-toggle="tab">Profil</a></li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <?php echo $__env->make('admin.identitas_desa.tab-umum', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php if($cek_profil_desa): ?>
                        <?php echo $__env->make('admin.identitas_desa.tab-profil', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin.layouts.components.select2_desa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="<?php echo e(asset('bootstrap/js/jquery.inputmask.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            let _hash = window.location.hash.substring(1)
            if (_hash) {
                $('ul.nav.nav-tabs a[href="#' + _hash + '"]').click()
            }
            var koneksi = "<?php echo e(cek_koneksi_internet()); ?>";
            var koneksi_pantau = <?php echo e($status_pantau); ?>

            var demo = "<?php echo e(config_item('demo')); ?>";

            tampil_kode_desa();

            if (koneksi && koneksi_pantau) {
                $("#nama_desa").attr('type', 'hidden');

                var server_pantau = "<?php echo e(config_item('server_pantau')); ?>";
                var token_pantau = "<?php echo e(config_item('token_pantau')); ?>";

                // Ambil Nama dan Kode Wilayah dari Pantau > Wilayah
                $('[name="pilih_desa"]').change(function() {
                    $.ajax({
                        type: 'GET',
                        url: server_pantau + '/index.php/api/wilayah/ambildesa?token=' +
                            token_pantau + '&id_desa=' + $(this).val(),
                        dataType: 'json',
                        success: function(data) {
                            $('[name="nama_desa"]').val(data.KODE_WILAYAH[0].nama_desa);
                            $('[name="kode_desa"]').val(data.KODE_WILAYAH[0].kode_desa);
                            $('[name="nama_kecamatan"]').val(data.KODE_WILAYAH[0].nama_kec);
                            $('[name="kode_kecamatan"]').val(data.KODE_WILAYAH[0].kode_kec);
                            $('[name="nama_kabupaten"]').val(hapus_kab_kota(huruf_awal_besar(
                                data.KODE_WILAYAH[0].nama_kab)));
                            $('[name="kode_kabupaten"]').val(data.KODE_WILAYAH[0].kode_kab);
                            $('[name="nama_propinsi"]').val(huruf_awal_besar(data.KODE_WILAYAH[
                                0].nama_prov));
                            $('[name="kode_propinsi"]').val(data.KODE_WILAYAH[0].kode_prov);
                            $('[name="kode_desa_bps"]').val(data.KODE_WILAYAH[0]?.bps_kemendagri_desa?.kode_desa_bps ?? '');
                        }
                    });
                });

                function hapus_kab_kota(str) {
                    return str.replace(/KAB |KOTA /gi, '');
                }
            } else {
                $("#nama_desa").attr('type', 'text');
                $("#kode_desa").removeAttr('readonly');
                $("#kode_desa_bps").removeAttr('readonly');
                $("#kode_desa").inputmask('9999999999');
                $("#nama_kecamatan").removeAttr('readonly');
                $("#nama_kabupaten").removeAttr('readonly');
                $("#nama_propinsi").removeAttr('readonly');
            }

            $('#kades').change(function() {
                var nip = $("#kades option:selected").attr("data-nip");
                $("#nip_kepala_desa").val(nip);
            });

            // simpan
            $(document).on("submit", "form#validasi", function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Sedang Menyimpan',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                $.ajax({
                        url: $(this).attr("action"),
                        type: $(this).attr("method"),
                        dataType: "JSON",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                    })
                    .done(function(response) {
                        if (demo == false) {
                            $.ajax({
                                    url: `<?php echo e(config_item('server_layanan')); ?>/api/v1/pelanggan/pemesanan`,
                                    headers: {
                                        "Authorization": `Bearer <?php echo e($list_setting->firstWhere('key', 'layanan_opendesa_token')?->value); ?>`,
                                        "X-Requested-With": `XMLHttpRequest`,
                                    },
                                    type: 'Post',
                                })
                                .done(function(response) {
                                    let data = {
                                        body: response
                                    }

                                    $.ajax({
                                        url: `${SITE_URL}pelanggan/pemesanan`,
                                        type: 'Post',
                                        dataType: 'json',
                                        data: data,
                                    })
                                })
                        }

                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Ubah Data',
                            })
                            window.location.replace(`${SITE_URL}identitas_desa`);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Ubah Data',
                                text: response.message,
                            })
                        }
                    })
                    .fail(function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Ubah Data',
                            text: response.message,
                        })
                    });
            });
        });

        function tampil_kode_desa() {
            var kode_desa = $('#kode_desa').val();
            $('#kode_kecamatan').val(kode_desa.substr(0, 6));
            $('#kode_kabupaten').val(kode_desa.substr(0, 4));
            $('#kode_propinsi').val(kode_desa.substr(0, 2));
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/identitas_desa/form.blade.php ENDPATH**/ ?>