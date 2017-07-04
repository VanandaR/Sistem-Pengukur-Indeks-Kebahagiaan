<?php $__env->startSection('konten'); ?>
    <?php
//    require_once 'twitteroauth/twitteroauth.php';
//    define('CONSUMER_KEY', '0Y9KZFaZaUI67BQ5RjBcPPhSN'); //isikan dengan CONSUMER_KEY anda
//    define('CONSUMER_SECRET', 'ey1LZH8xYegJ0h9EIB0m2nsD18shVcJHZtxlNfcHKdzTR5tbyK'); //isikan dengan CONSUMER_KEY anda
//    define('ACCESS_TOKEN', '3014251646-J0LadQ2pyEAs0xLwnhwxu5nv27gZL8of0NAPzGB'); //isikan dengan CONSUMER_KEY anda
//    define('ACCESS_TOKEN_SECRET', 'R06seEsYZdaPy2LkpHz54JLhLxBx0snXg2AdpPuaBipdY'); //isikan dengan CONSUMER_KEY anda





//    $results = search($query);
    //    dd($results);
    ?>


    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Indeks Kebahagiaan Hari ini</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Tweet</th>
                            <th>Sentimen</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php  $i=0;  ?>
                        <?php $__currentLoopData = $tweethariini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td><?php echo e($tweet->text); ?></td>
                                <td><?php echo e($klasifikasisentimen['hasil'][$i]); ?></td>
                                <?php  $i++; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <form action="/streaming/save" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($indekskebahagiaan['hasil']); ?>" name="indekskebahagiaan">
                        <input type="hidden" value="<?php echo e(date("Y-m-d")); ?>" name="tanggal">
                    <table class="uk-table" cellspacing="0" width="100%">

                        <tbody>

                            <tr>
                                <td>Tweet Positif</td>
                                <td><?php echo e($indekskebahagiaan['positif']); ?></td>

                            </tr>
                            <tr>
                                <td>Tweet Negatif</td>
                                <td><?php echo e($indekskebahagiaan['negatif']); ?></td>

                            </tr>
                            <tr>
                                <td>Indeks kebahagiaan hari ini :</td>
                                <td><?php echo e($indekskebahagiaan['hasil']); ?></td>

                            </tr>
                            <tr>
                                <td>Tanggal :</td>
                                <td><?php echo e(date("d M Y")); ?></td>
                            </tr>


                        </tbody>
                    </table>
                    <div class=" uk-text-right" style="border-top:1px solid rgba(0,0,0,.12); margin-top: 20px; padding-top:20px">
                        <a href="/streaming" class="md-btn md-btn-flat uk-modal-close">Close</a><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                    </div>
                    </form>

                </div>
            </div>



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