<?php $__env->startSection('judul','Tabel Data Testing'); ?>

<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Klasifikasi</h3>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                                <li class="uk-active"><a href="#">Klasifikasi Sentimen</a></li>
                                <li><a href="#">Klasifikasi Kategori</a></li>
                                <li><a href="#">Uji Performansi Sentimen</a></li>
                                <li><a href="#">Uji Performansi Kategori</a></li>
                            </ul>
                            <ul id="tabs_1" class="uk-switcher uk-margin">
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Tweet</th>
                                            <th>Probabilitas Positif</th>
                                            <th>Probabilitas Negatif</th>
                                            <th>Probabilitas Netral</th>
                                            <th>Klasifikasi Sentimen</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php  $i=0;  ?>

                                        <?php $__currentLoopData = $datatesting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php  $i++; ?>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e($dt->tweet); ?></td>
                                                <td><?php echo e($klasifikasisentimen[$i-1]['positif']); ?></td>
                                                <td><?php echo e($klasifikasisentimen[$i-1]['negatif']); ?></td>
                                                <td><?php echo e($klasifikasisentimen[$i-1]['netral']); ?></td>
                                                <td><?php echo e($klasifikasisentimen['hasil'][$i-1]); ?></td>
                                            </tr>
                                            <div class="uk-modal" id="modal_edit_stopword<?php echo e($dt->id); ?>">
                                                <div class="uk-modal-dialog">
                                                    <div class="uk-modal-header">
                                                        <h3 class="uk-modal-title">Edit Stopword</h3>
                                                    </div>
                                                    <form method="post" action="/stopword/update">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" value="<?php echo $dt->id;?>" name="id">
                                                        <div class="uk-form-row">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Stopword</label>
                                                                <input type="text" value="<?php echo $dt->text;?>" name="stopword" class="md-input">
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
                                </li>
                                <li>
                                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Tweet</th>

                                            <th>Prob. Pekerjaan</th>
                                            <th>Prob. PRT</th>
                                            <th>Prob. KRDA</th>
                                            <th>Prob. Pendidikan</th>
                                            <th>Prob. Kesehatan</th>
                                            <th>Prob. Keluarga</th>
                                            <th>Prob. Sosial</th>
                                            <th>Prob. Waktu Luang</th>
                                            <th>Prob. Lingkungan</th>
                                            <th>Prob. Keamanan</th>
                                            <th>Prob. Tidak Terkategori</th>
                                            <th>Klasifikasi Kategori</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php  $i=0;  ?>

                                        <?php $__currentLoopData = $datatesting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                
                                                <?php  $i++; ?>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e($dt->tweet); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['pekerjaan']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['pendapatan rumah tangga']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['kondisi rumah dan aset']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['pendidikan']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['kesehatan']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['keharmonisan keluarga']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['hubungan sosial']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['ketersediaan waktu luang']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['kondisi lingkungan']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['kondisi keamanan']); ?></td>
                                                <td><?php echo e($klasifikasikategori[$i-1]['tidak terkategori']); ?></td>
                                                <td><?php echo e($klasifikasikategori['hasil'][$i-1]); ?></td>
                                            </tr>
                                            <div class="uk-modal" id="modal_edit_stopword<?php echo e($dt->id); ?>">
                                                <div class="uk-modal-dialog">
                                                    <div class="uk-modal-header">
                                                        <h3 class="uk-modal-title">Edit Stopword</h3>
                                                    </div>
                                                    <form method="post" action="/stopword/update">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" value="<?php echo $dt->id;?>" name="id">
                                                        <div class="uk-form-row">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Stopword</label>
                                                                <input type="text" value="<?php echo $dt->text;?>" name="stopword" class="md-input">
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
                                </li>
                                <li>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <h3>Average</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Rata-rata</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultsentimen['average']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$average): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($average); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Recall</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Recall</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultsentimen['recall']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$recall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($recall); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Precision</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Precision</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultsentimen['precision']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$precision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($precision); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>F1 Score</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai F1 Score</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultsentimen['f1score']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$f1score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($f1score); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Support</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Support</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultsentimen['support']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($support); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <h3>Average</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Rata-rata</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultkategori['average']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$average): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($average); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Recall</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Recall</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultkategori['recall']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$recall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($recall); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Precision</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Precision</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultkategori['precision']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$precision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($precision); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-2">
                                            <h3>F1 Score</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai F1 Score</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultkategori['f1score']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$f1score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($f1score); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <h3>Support</h3>
                                            <table  class="uk-table" width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%">No</th>
                                                    <th>Class</th>
                                                    <th>Nilai Support</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  $i=0;  ?>
                                                <?php $__currentLoopData = $reportresultkategori['support']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php  $i++; ?>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($key); ?></td>
                                                        <td><?php echo e($support); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('.layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>