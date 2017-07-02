<?php $__env->startSection('judul','Data Testing Manual'); ?>
<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Data Testing Manual</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Tweet</th>
                            <th>Positive Score</th>
                            <th>Negative Score</th>
                            <th>Lexicon Classification</th>
                            <th>Sentiment Label</th>
                            <th>Category Label</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php  $j=0;  ?>

                        <?php $__currentLoopData = $datatesting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php  $j=$j+1; ?>
                                <td><?php echo e($j); ?></td>
                                <td><?php echo e($dt->tweet); ?></td>
                                <td><?php echo e($dt->classification->lexicon_pos_score); ?></td>
                                <td><?php echo e($dt->classification->lexicon_pos_score); ?></td>
                                <td></td>
                                <td><?php echo e($dt->classification->manual_sentimen_label); ?></td>
                                <td><?php echo e($dt->classification->manual_category_label); ?></td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" href="#modal_edit_stopword<?php echo e($dt->id); ?>" data-uk-modal="{center:true'}"><i class="md-icon material-icons">edit</i></a>
                                </td>
                            </tr>
                            <div class="uk-modal" id="modal_edit_stopword<?php echo e($dt->id); ?>">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Klasifikasi</h3>
                                    </div>
                                    <form method="post" action="/datatesting/manual/label">
                                        <?php echo e(csrf_field()); ?>


                                        <input type="hidden" value="<?php echo $dt->classification->id;?>" name="id">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <label for="message">Tweet</label>
                                                <textarea disabled class="md-input" name="tweet" cols="10" rows="3" data-parsley-validation-threshold="10"><?php echo e($dt->tweet); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-medium-1-1">
                                                <div class="uk-form-row">
                                                    <label for="gender" class="uk-form-label">Klasifikasi Sentimen</label>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-1">
                                                            <input type="radio" name="sentimen" id="radio_demo_1" value="positif" />
                                                            <label class="inline-label">Positif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-1">
                                                            <input type="radio" name="sentimen" id="radio_demo_2" value="negatif"/>
                                                            <label class="inline-label">Negatif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-1">
                                                            <input type="radio" name="sentimen" id="radio_demo_1" value="netral"/>
                                                            <label class="inline-label">Netral</label>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="uk-form-row">
                                                    <label for="gender" class="uk-form-label">Klasifikasi Kategori<span class="req">*</span></label>
                                                </div>
                                                <?php  $kategori=array("Pekerjaan","Pendapatan Rumah Tangga","Kondisi Rumah dan Aset"
                                                ,"Pendidikan","Kesehatan","Keharmonisan Keluarga","Hubungan Sosial","Ketersediaan Waktu Luang"
                                                ,"Kondisi Lingkungan","Kondisi Keamanan", "Tidak Terkategori")  ?>

                                                <?php for($i=0;$i<11;$i++): ?>
                                                    <div class="uk-form-row">
                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-1">
                                                            <span class="icheck-inline">
                                                                <input type="radio" name="kategori" value="<?php echo e(strtolower($kategori[$i])); ?>"/>
                                                                <label class="inline-label"><?php echo e($kategori[$i]); ?></label>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                                <div class="uk-modal-footer uk-text-right">
                                                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                                                </div>
                                            </div>
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


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>