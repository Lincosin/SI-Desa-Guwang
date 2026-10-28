<?php if($notif_percobaan): ?>
    <?php
        $sisaHari = ceil((strtotime($notif_percobaan['akhir']) - time()) / (60 * 60 * 24));
    ?>
    <div class="row">
        <div class='col-md-12'>
            <div class="callout callout-danger">
                <h4><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;Informasi Penting!</h4>
                <p align="justify">
                    OpenSID <span class='btn-default text-red btn-xs'>Lisensi Percobaan</span> tersisa <code><?php echo e($sisaHari); ?></code> Hari lagi, Silahkan hubungi pelaksana untuk upgrade ke lisensi premium.
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/home/percobaan.blade.php ENDPATH**/ ?>