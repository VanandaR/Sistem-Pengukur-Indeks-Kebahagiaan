<?php $__env->startSection('judul','Tabel Data Testing'); ?>
<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Data Testing</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Username</th>
                            <th>Tweet</th>
                            <th>Post Time</th>
                            <th>Manual Sentimen</th>
                            <th>Manual Kategori</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php  $i=0;  ?>

                        <?php $__currentLoopData = $datatesting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php  $i++; ?>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($dt->user); ?></td>
                                <td><?php echo e($dt->tweet); ?></td>
                                <td><?php echo e($dt->post_time); ?></td>
                                <td><?php echo e($dt->classification->manual_sentimen_label); ?></td>
                                <td><?php echo e($dt->classification->manual_category_label); ?></td>
                                <td class="uk-text-center">
                                    <a href="/datatesting/edit/<?php echo e($dt->id); ?>"><i class="md-icon material-icons">edit</i></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/datatraining/delete/<?php echo e($dt->id); ?>' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('.layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>