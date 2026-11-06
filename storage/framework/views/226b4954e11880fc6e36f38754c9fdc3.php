<?php $__env->startSection('content'); ?>
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h4 class="box-title">Profil</h4>
        </div>
        <div class="box-body box-line">
            <h4><b>BIODATA PENDUDUK</b></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-data">
                    <tbody>
                        <tr>
                            <th colspan="3" class="judul">Data Dasar</th>
                        </tr>
                        <tr>
                            <td width="30%">NIK</td>
                            <td class="padat">:</td>
                            <td><?php echo e($penduduk->nik); ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->nama)); ?></td>
                        </tr>
                        <tr>
                            <td>Status Kepemilikan KTP</td>
                            <td>:</td>
                            <td>
                                <table class="table table-bordered table-hover table-data">
                                    <tbody>
                                        <tr class="judul">
                                            <th>Wajib KTP</th>
                                            <th>KTP-EL</th>
                                            <th>Status Rekam</th>
                                            <th>Tag ID Card</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo e(strtoupper($penduduk->wajib_ktp)); ?></td>
                                           <td><?php echo e(strtoupper(App\Enums\StatusRekamEnum::valueOf($penduduk->ktp_el))); ?></td>
                                            <td><?php echo e(strtoupper(App\Enums\StatusKTPEnum::valueOf($penduduk->status_rekam))); ?></td>
                                            <td><?php echo e($penduduk->tag_id_card); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Kartu Keluarga</td>
                            <td>:</td>
                            <td>
                                <?php echo e($penduduk->keluarga->no_kk); ?>

                                <?php if($penduduk->status_dasar != '1' && $penduduk->no_kk != $penduduk->log_no_kk): ?>
                                    ( waktu peristiwa [<?php echo e($penduduk->status_dasar); ?>]: [<?php echo e($penduduk->log_no_kk); ?>] )
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor KK Sebelumnya</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->no_kk_sebelumnya); ?></td>
                        </tr>
                        <tr>
                            <td>Hubungan Dalam Keluarga</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->penduduk_hubungan); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->jenis_kelamin); ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->agama); ?></td>
                        </tr>
                        <tr>
                            <td>Status Penduduk</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper(App\Enums\StatusPendudukEnum::valueOf($penduduk->status))); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="judul">Data Kelahiran</th>
                        </tr>
                        <tr>
                            <td>Akta Kelahiran</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->akta_lahir)); ?></td>
                        </tr>
                        <tr>
                            <td>Tempat / Tanggal Lahir</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->tempatlahir)); ?> / <?php echo e(strtoupper($penduduk->tanggallahir?->format('d-m-Y'))); ?></td>
                        </tr>
                        <tr>
                            <td>Tempat Dilahirkan</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->dilahirkan); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelahiran</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->jenisLahir); ?></td>
                        </tr>
                        <tr>
                            <td>Kelahiran Anak Ke</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->kelahiran_anak_ke); ?></td>
                        </tr>
                        <tr>
                            <td>Penolong Kelahiran</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->penolongLahir)); ?></td>
                        </tr>
                        <tr>
                            <td>Berat Lahir</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->berat_lahir); ?> Gram</td>
                        </tr>
                        <tr>
                            <td>Panjang Lahir</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->panjang_lahir); ?> cm</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="judul">Data Pendidikan dan Pekerjaan</th>
                        </tr>
                        <tr>
                            <td>Pendidikan dalam KK</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->pendidikan_kk); ?></td>
                        </tr>
                        <tr>
                            <td>Pendidikan sedang ditempuh</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->pendidikan_sedang); ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td><?php echo e($data->pekerjaan); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="judul">Data Kewarganegaraan</th>
                        </tr>
                        <tr>
                            <td>Suku/Etnis</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->suku)); ?></td>
                        </tr>
                        <tr>
                            <td>Warga Negara</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->warganegara)); ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Paspor</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->dokumen_pasport)); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Berakhir Paspor</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper(tgl_indo_out($penduduk->tanggal_akhir_paspor))); ?></td>
                        </tr>
                        <tr>
                            <td>Nomor KITAS/KITAP</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->dokumen_kitas)); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="judul">Data Orang Tua</th>
                        </tr>
                        <tr>
                            <td>NIK Ayah</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->ayah_nik)); ?></td>
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->nama_ayah)); ?></td>
                        </tr>
                        <tr>
                            <td>NIK Ibu</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->ibu_nik)); ?></td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->nama_ibu)); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="judul">Data Alamat</th>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->telepon)); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Email</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->email)); ?></td>
                        </tr>
                        <tr>
                            <td>Telegram</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->telegram); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->keluarga->alamat)); ?></td>
                        </tr>
                        <tr>
                            <td>Dusun</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->wilayah->dusun)); ?></td>
                        </tr>
                        <tr>
                            <td>RT/ RW</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->wilayah->rt)); ?> / <?php echo e($penduduk->wilayah->rw); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Sebelumnya</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->alamat_sebelumnya)); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="judul">Data Perkawinan</th>
                        </tr>
                        <tr>
                            <td>Status Kawin</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->statusPerkawinan)); ?></td>
                        </tr>
                        <?php if($penduduk->status_kawin != 1): ?>
                            <tr>
                                <td>Akta perkawinan</td>
                                <td>:</td>
                                <td><?php echo e(strtoupper($penduduk->akta_perkawinan)); ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal perkawinan</td>
                                <td>:</td>
                                <td><?php echo e($penduduk->tanggalperkawinan ? date('d-m-Y', strtotime($penduduk->tanggalperkawinan)) : ''); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if($penduduk->status_kawin != 1 && $penduduk->status_kawin != 2): ?>
                            <tr>
                                <td>Akta perceraian</td>
                                <td>:</td>
                                <td><?php echo e(strtoupper($penduduk->akta_perceraian)); ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal perceraian</td>
                                <td>:</td>
                                <td><?php echo e(strtoupper($penduduk->tanggalperceraian)); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th colspan="3" class="judul">Data Kesehatan</th>
                        </tr>
                        <tr>
                            <td>Golongan Darah</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->golongan_darah); ?></td>
                        </tr>
                        <tr>
                            <td>Cacat</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->cacat); ?></td>
                        </tr>
                        <tr>
                            <td>Sakit Menahun</td>
                            <td>:</td>
                            <td><?php echo e(strtoupper($penduduk->sakit_menahun)); ?></td>
                        </tr>
                        <?php if($penduduk->status_kawin == App\Enums\StatusKawinEnum::KAWIN): ?>
                            <tr>
                                <td>Akseptor KB</td>
                                <td>:</td>
                                <td><?php echo e(strtoupper($penduduk->cara_kb)); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if($penduduk->id_sex == App\Enums\JenisKelaminEnum::PEREMPUAN): ?>
                            <tr>
                                <td>Status Kehamilan</td>
                                <td>:</td>
                                <td><?php echo e(strtoupper(App\Enums\HamilEnum::valueOf($penduduk->hamil))); ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Nama/Nomor Asuransi Kesehatan</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->asuransi . ' / ' . strtoupper($penduduk->no_asuransi)); ?></td>
                        </tr>
                        <tr>
                            <td>Nomor BPJS Ketenagakerjaan</td>
                            <td>:</td>
                            <td><?php echo e($penduduk->bpjs_ketenagakerjaan); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box-body box-line">
            <h4><b>KEANGGOTAAN KELOMPOK</b></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-data datatable-polos">
                    <thead>
                        <tr>
                            <th width="padat">No</th>
                            <th width="80%">Nama Kelompok</th>
                            <th width="20%">Kategori Kelompok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($kelompok): ?>
                            <?php $__currentLoopData = $kelompok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($item?->kelompok->nama); ?></td>
                                    <td><?php echo e($item?->kelompok?->kelompokMaster?->kelompok); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center" colspan="3">Data tidak tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/profil/index.blade.php ENDPATH**/ ?>