<?php $__env->startSection('judul','Tabel Data Training'); ?>
<?php $__env->startSection('konten'); ?>

    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Data Training</h4>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-1-1  ">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h4 class="heading_c uk-margin-bottom">Distribusi</h4>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-1-4">
                                    <canvas id="distribusi_sentimen"></canvas>
                                </div>
                                <div class="uk-width-large-1-4">
                                    <canvas id="distribusi_category"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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

                        <?php $__currentLoopData = $datatraining; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php  $i++; ?>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($dt->user); ?></td>
                                <td><?php echo e($dt->tweet); ?></td>
                                <td><?php echo e($dt->post_time); ?></td>
                                <td><?php echo e($dt->classification->manual_sentimen_label); ?></td>
                                <td><?php echo e($dt->classification->manual_category_label); ?></td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" href="/datatraining/edit/<?php echo e($dt->id); ?>"><i class="md-icon material-icons">edit</i></a>
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

    <script>
        var sentimenData = {
            labels : [
                <?php $__currentLoopData = $distribusisentimen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                '<?php echo e($ds->manual_sentimen_label); ?>',
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            ],
            datasets : [
                {
                    backgroundColor: ["#2196F3", "#4CAF50"],
                    data : [
                        <?php $__currentLoopData = $distribusisentimen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($ds->total); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }
            ]

        }
        var categoryData = {
            labels : [
                <?php $__currentLoopData = $distribusicategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<?php echo e($dc->manual_category_label); ?>',
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            ],
            datasets : [
                {
                    backgroundColor: ["#f44336", "#E91E63",
                        "#9C27B0", "#673AB7", "#3F51B5", "#2196F3", "#03A9F4", "#00BCD4", "#009688", "#4CAF50",'#8BC34A'],
                    data : [
                        <?php $__currentLoopData = $distribusicategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($dc->total); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }
            ]

        }
        var s=new Chart(document.getElementById("distribusi_sentimen"), {
            type: 'pie',
            data: sentimenData,
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Sentimen Data'
                }
            }
        });
        var s=new Chart(document.getElementById("distribusi_category"), {
            type: 'pie',
            data: categoryData,
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Kategori Data'
                }
            }
        });
//        var myPieChart = new Chart(document.getElementById("distribusi_sentimen"), {
//            type: 'pie',
//            data: {
//                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
//                datasets: [{
//                    label: "Population (millions)",
//                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
//                    data: [2478,5267,734,784,433]
//                }]
//            },
//            options: {
//                title: {
//                    display: true,
//                    text: 'Predicted world population (millions) in 2050'
//                }
//            }
//        });
//        var distribisisentimen = new Chart(document.getElementById("distribusi_sentimen").getContext("2d")).Bar(sentimenData);
//        var distribisikategori = new Chart(document.getElementById("distribusi_category").getContext("2d")).Bar(categoryData);
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('.layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>