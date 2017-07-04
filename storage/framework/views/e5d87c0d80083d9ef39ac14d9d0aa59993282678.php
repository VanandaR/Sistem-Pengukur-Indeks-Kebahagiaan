<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">

            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a">Date range</h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_start">Start Date</label>
                                        <input class="md-input" type="text" id="uk_dp_start">
                                    </div>
                                </div>
                                <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_end">End Date</label>
                                        <input class="md-input" type="text" id="uk_dp_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-1-1  ">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Indeks Kebahagiaan</h4>
                            <canvas id="distribusi_sentimen"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Indeks</th>
                            <th>Tanggal</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php  $i=0;  ?>
                        <?php $__currentLoopData = $happiness; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $happy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($happy->index); ?></td>
                                <td><?php echo e($happy->date); ?></td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/streaming/delete/<?php echo e($happy->id); ?>' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                                <?php  $i++; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid">
                        <div class="uk-width-medium-1-1">
                            <a class="md-btn md-btn-danger md-btn-block" href="/streaming/klasifikasi">Klasifikasi Hari Ini</a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var sentimenData = {
                    labels : [
                        <?php $__currentLoopData = $happiness; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                '<?php echo e($ik->date); ?>',
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                    datasets : [
                        {
                            data : [
                                <?php $__currentLoopData = $happiness; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        '<?php echo e($ik->index); ?>',
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            ]
                        }
                    ]

                }
                var s=new Chart(document.getElementById("distribusi_sentimen"), {
                    type: 'line',
                    data: sentimenData,
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Sentimen Data'
                        }
                    }
                });
            </script>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>