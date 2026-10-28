<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="single_bottom_rightbar">
    <h2><i class="fa fa-comments"></i>&ensp;<?php echo e($judul_widget); ?></h2>
    <div id="mostPopular2" class="tab-pane fade in active" role="tabpanel">
        <ul id="ul-menu">
            <div class="box-body">
                <marquee
                    onmouseover="this.stop()"
                    onmouseout="this.start()"
                    scrollamount="3"
                    direction="up"
                    width="100%"
                    height="280"
                    align="center"
                    behavior=”alternate”
                >
                    <ul class="sidebar-latest" id="li-komentar">
                        <?php $__currentLoopData = $komen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <table class="table table-bordered table-striped dataTable table-hover">
                                    <thead class="bg-gray disabled color-palette">
                                        <tr>
                                            <th><i class="fa fa-comment"></i> <?php echo e($data['pengguna']['nama']); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <font color='green'><small><?php echo e(tgl_indo2($data['tgl_upload'])); ?></small></font><br />
                                                <?php echo e(potong_teks($data['komentar'], 50)); ?>...<a href="<?php echo e(site_url('artikel/' . buat_slug($data))); ?>">selengkapnya</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </marquee>
            </div>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/komentar.blade.php ENDPATH**/ ?>