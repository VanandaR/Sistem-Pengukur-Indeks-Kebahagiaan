<?php $__env->startSection('judul','Ontology'); ?>
<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Ontologi/Keyword Table</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Kata</th>
                            <th>Parameter</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php  $i=0;  ?>

                        <?php $__currentLoopData = $ontology; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php  $i++; ?>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($o->text); ?></td>
                                <td><?php echo e($o->parameter); ?></td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" href="#modal_edit_ontology<?php echo e($o->id); ?>" data-uk-modal="{center:true'}"><i class="md-icon material-icons">edit</i></a>
                                    <a type="hidden" name="delete_ontology" href="/ontology/delete/<?php echo e($o->id); ?>"></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/ontology/delete/<?php echo e($o->id); ?>' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <div class="uk-modal" id="modal_edit_ontology<?php echo e($o->id); ?>">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Edit Ontology</h3>
                                    </div>
                                    <form method="post" action="/ontology/update">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" value="<?php echo $o->id;?>" name="id">
                                        <div class="uk-form-row">
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>Ontology</label>
                                                <input type="text" value="<?php echo $o->text;?>" name="ontology" class="md-input">
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>Parameter</label>
                                                <input type="text" value="<?php echo $o->parameter;?>" name="parameter" class="md-input">
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
        <a class="md-fab md-fab-primary" href="#modal_insert_ontology" data-uk-modal="{center:true'}"><i class="material-icons">add</i></a>
    </div>
    <div class="uk-modal" id="modal_insert_ontology">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Input ontology</h3>
            </div>
            <form method="post" action="/ontology/insert">
                <?php echo e(csrf_field()); ?>

                <div class="uk-form-row">
                    <label>Ontology</label>
                    <input type="text" class="md-input" name="ontology" />
                </div>
                <div class="uk-form-row">
                    <label>Parameter</label>
                    <input type="text" class="md-input" name="parameter" />
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                </div>
            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>