<?php $__env->startSection('konten'); ?>

    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <div class="md-card">
                                <div class="md-card-content">
                                    <form method="GET">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="uk-form-row">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-1">
                                                    <label>Query</label>
                                                    <input type="text" id="query" name="query" class="md-input" value="<?php echo e((isset($_GET['query']))?$_GET['query']:""); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-1">
                                                    <label>Jumlah Tweet</label>
                                                    <input type="text" id="jumlahtweet" name="jumlahtweet" class="md-input" value="<?php echo e((isset($_GET['jumlahtweet']))?$_GET['jumlahtweet']:"0"); ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-1 uk-text-center">
                                                    <button type="submit" id="search" class="md-btn md-btn-primary uk-width-medium-1-1 uk-margin-small-top">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md-card uk-margin-medium-bottom">
                        <form id="adddata" method="POST" action="/adddata">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" value="0" name="jenis">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th><input type="checkbox" name="mailbox_select_all" id="mailbox_select_all" data-md-icheck />
                                            </th>
                                        <th>Tweet</th>
                                        <th>User</th>
                                        <th width="15%">Waktu Post</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $i=1;  ?>
                                    <?php for($j=0;$j<count($tweet);$j++): ?>
                                    <?php $__currentLoopData = $tweet[$j]->statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
//                                        dd($result->created_at);
                                        $date = new DateTime($result->created_at);?>
                                        <tr>
                                            <td><?php echo e($i); ?></td>
                                            <td><div class="md-card-list-item-select">
                                                    <input type="checkbox" name="tweet[]" value="<?php echo e($result->text); ?>;<?php echo e($result->user->screen_name); ?>;<?php echo e($date->format("Y-m-d h:m:s")); ?>" id="ceklist" data-md-icheck />
                                                </div></td>

                                            <td><?php echo e($result->text); ?></td>
                                            <td><?php echo e($result->user->screen_name); ?></td>
                                            <td><?php echo e($date->format("d M Y h:i:s")); ?></td>
                                            <?php  $i++; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <div class="md-fab-wrapper md-fab-speed-dial">
        <a class="md-fab md-fab-primary" href="#"><i class="material-icons">add</i></a>
        <div class="md-fab-wrapper-small">
            <button onclick="datatrainingsubmit()" data-uk-tooltip="{pos:'left'}" title="Jadikan Data Training" id="data_training_submit" class="md-fab md-fab-small md-fab-success" href="#"><i class="material-icons">add</i></button>
            <button onclick="datatestingsubmit()" data-uk-tooltip="{pos:'left'}" title="Jadikan Data Test" class="md-fab md-fab-small md-fab-danger" href="#"><i class="material-icons">add</i></button>
        </div>
    </div>

    <script>

        function datatrainingsubmit() {
            $("input[name='jenis']").val("1");
            $('#adddata').submit();
        }
        function datatestingsubmit() {
            $("input[name='jenis']").val("2");
            $('#adddata').submit();
        }
//        var valuetwo = $('#ceklist').getAttribute("name-value");
//        alert(valuetwo);

        //    $('#search').click(function() {
        //        var query = document.getElementById("query").value;
        //        var jumlahtweet = document.getElementById("jumlahtweet").value;
        //        var xmlhttp = new XMLHttpRequest();
        //        xmlhttp.onreadystatechange = function() {
        //            if (this.readyState == 4 && this.status == 200) {
        //                document.getElementById("txtHint").innerHTML = this.responseText;
        //            }
        //        }
        //        xmlhttp.open("GET", "gethint.php?q="+str, true);
        //        xmlhttp.send();
        //    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>