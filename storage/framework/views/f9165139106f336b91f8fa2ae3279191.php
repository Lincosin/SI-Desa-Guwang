<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<!-- TODO: Pindahkan ke external css -->
<style>
    #sinergi_program {
        text-align: center;
    }

    #sinergi_program table {
        margin: auto;
    }

    #sinergi_program img {
        max-width: 100%;
        max-height: 100%;
        transition: all 0.5s;
        -o-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -webkit-transition: all 0.5s;
    }

    #sinergi_program img:hover {
        transition: all 0.3s;
        -o-transition: all 0.3s;
        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transform: scale(1.5);
        -moz-transform: scale(1.5);
        -o-transform: scale(1.5);
        -webkit-transform: scale(1.5);
        box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
    }
</style>
<div class="single_bottom_rightbar">
    <h2 class="box-title"><i class="fa fa-external-link"></i>&ensp;
        <?php echo e($judul_widget); ?>

    </h2>
    <div id="sinergi_program" class="box-body">
        <table>
            <?php
                $sinergi_program = sinergi_program();
                $perbaris = (int) (setting('gambar_sinergi_program_perbaris') ?: 3);

                // Calculate the total number of iterations needed
                $totalIterations = count($sinergi_program) + (($perbaris - (count($sinergi_program) % $perbaris)) % $perbaris);
            ?>

            <?php for($key = 0; $key < $totalIterations; $key++): ?>
                <?php if($key % $perbaris === 0): ?>
                    <tr>
                <?php endif; ?>

                <?php if($key < count($sinergi_program)): ?>
                    <td>
                        <center>
                            <a href="<?php echo e($sinergi_program[$key]['tautan']); ?>" target="_blank">
                                <img style="padding: 3px;" src="<?php echo e($sinergi_program[$key]['gambar_url']); ?>" alt="Gambar <?php echo e($sinergi_program[$key]['judul']); ?>">
                            </a>
                        </center>
                    </td>
                <?php endif; ?>

                <?php if($key % $perbaris === $perbaris - 1 || $key === $totalIterations - 1): ?>
                    </tr>
                <?php endif; ?>
            <?php endfor; ?>
        </table>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/sinergi_program.blade.php ENDPATH**/ ?>