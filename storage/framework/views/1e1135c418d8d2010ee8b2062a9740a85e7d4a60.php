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
            <script>
                var sentimenData = {
                    labels : [
                        <?php $__currentLoopData = $indekskebahagiaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nilai=>$ik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                '<?php echo e(($nilai)); ?>',
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                    datasets : [
                        {
                            borderColor: ["#2196F3"],
                            data : [
                                <?php $__currentLoopData = $indekskebahagiaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        '<?php echo e($ik); ?>',
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
                            text: 'Indeks Kebahagiaan'
                        }
                    }
                });
            </script>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>