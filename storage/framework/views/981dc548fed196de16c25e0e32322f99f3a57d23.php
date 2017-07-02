<?php $__env->startSection('judul','Sentiword'); ?>
<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Sentiword Table</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Sentiword</th>
                            <th>Positif Score</th>
                            <th>Negatif Score</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php  $i=0;  ?>

                        <?php $__currentLoopData = $sentiword; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php  $i++; ?>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($sw->text); ?></td>
                                <td><?php echo e($sw->pos_score); ?></td>
                                <td><?php echo e($sw->neg_score); ?></td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" href="#modal_edit_sentiword<?php echo e($sw->id); ?>" data-uk-modal="{center:true'}"><i class="md-icon material-icons">edit</i></a>
                                    <a type="hidden" name="delete_sentiword" href="/sentiword/delete/<?php echo e($sw->id); ?>"></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/sentiword/delete/<?php echo e($sw->id); ?>' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <div class="uk-modal" id="modal_edit_sentiword<?php echo e($sw->id); ?>">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Edit sentiword</h3>
                                    </div>
                                    <form method="post" action="/sentiword/update">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" value="<?php echo $sw->id;?>" name="id">
                                        <div class="uk-form-row">
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>sentiword</label>
                                                <input type="text" value="<?php echo $sw->text;?>" name="sentiword" class="md-input">
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-2">
                                                        <label>Positive Score</label>
                                                        <input type="number" value="<?php echo $sw->pos_score;?>" class="md-input" name="p"/>
                                                    </div>

                                                    <div class="uk-form-row uk-width-1-2">
                                                        <label>Negative Score</label>
                                                        <input type="number" value="<?php echo $sw->neg_score;?>" class="md-input" name="n"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-modal-footer uk-text-right">
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary" href="#modal_insert_sentiword" data-uk-modal="{center:true'}"><i class="material-icons">add</i></a>
    </div>
    <div class="uk-modal" id="modal_insert_sentiword">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Input Sentiword</h3>
            </div>
            <form method="post" action="/sentiword/insert">
                <?php echo e(csrf_field()); ?>

                <div class="uk-form-row">
                    <label>Sentiword</label>
                    <input type="text" class="md-input" name="sentiword" />
                </div>
                <div class="uk-form-row">
                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <label>Positive Score</label>
                            <input type="text" class="md-input" name="pos_score" />
                        </div>

                        <div class="uk-form-row uk-width-1-2">
                            <label>Negative Score</label>
                            <input type="text" class="md-input" name="neg_score" />
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary"  data-message="Top Right" data-pos="top-right">Save</button>
                </div>

            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>