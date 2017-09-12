<?php $__env->startSection('judul','Text Mining'); ?>
<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Text Preprocessing</h3>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                                <li class="uk-active"><a href="#">Text Preprocessing</a></li>
                                <li><a href="#">Text Tranformation</a></li>
                                <li><a href="#">Unigram</a></li>
                                <li><a href="#">Unigram Frequency Total</a></li>
                            </ul>
                            <ul id="tabs_1" class="uk-switcher uk-margin">
                                <li>
                                    <table  class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Data Awal</th>
                                            <th>Hasil Preprocessing</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php  $i=0;  ?>

                                        <?php $__currentLoopData = $datatraining; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php  $i++; ?>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e($dt->tweet); ?></td>
                                                <td>
                                                    <?php echo e($hasilpreprocessing[$i-1]); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                </li>
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Hasil Preprocessing</th>
                                            <th>Stemming</th>
                                            <th>Kata Dasar Removal</th>
                                            <th>Stopword Removal</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php  $i=0;  ?>

                                        <?php $__currentLoopData = $datatraining; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php  $i++; ?>
                                                <td><?php echo e($i); ?></td>
                                                <td>
                                                    <?php echo e($hasilpreprocessing[$i-1]); ?>

                                                </td>
                                                <td>
                                                        <?php echo e($hasilstemming[$i-1]); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($hasilbukancorpus[$i-1]); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($hasilstopwordremoval[$i-1]); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Hasil Stopword Removal</th>
                                            <th>Unigram</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php  $i=0;  ?>

                                        <?php $__currentLoopData = $datatraining; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php  $i++; ?>
                                                <td><?php echo e($i); ?></td>
                                                <td>
                                                    <?php echo e($hasilstopwordremoval[$i-1]); ?>

                                                </td>
                                                <td>
                                                    <?php $__currentLoopData = $hasilngram[$i-1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ngram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        [<?php echo e($ngram); ?>]
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <table class="uk-table" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Unigram</th>
                                            <th>Frekuensi</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php  $i=0;  ?>

                                        <?php $__currentLoopData = $hasilfrequencyngram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fngram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php  $i++; ?>
                                                <td><?php echo e($i); ?></td>
                                                <?php $__currentLoopData = $fngram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fngram2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td>
                                                    <?php echo e($fngram2); ?>

                                                </td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('.layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>