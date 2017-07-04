<?php $__env->startSection('konten'); ?>
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="">
                                <h3>Selamat Datang <?php echo e(Auth::user()->role->nama); ?>, <?php echo e(Auth::user()->name); ?></h3>
                            </div>
                            <?php if(Auth::user()->role_id==2): ?>
                                <p>Sudah tahu tugas ahli bahasa? Jika belum silahkan klik <a href="/FAQ">FAQ</a>.</p>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-1">
                                        <a class="md-btn md-btn-danger md-btn-block" href="/tweet">Mulai Klasifikasi</a>
                                    </div>
                                </div>
                                <style>

                                </style>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php if(Auth::user()->role_id==1): ?>
                <div class=" uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-2 uk-grid-width-xlarge-1-4 uk-text-center hierarchical_show" data-uk-grid-margin>
                    <a href="/tweet">
                        <div class="md-bg-indigo-50 md-card md-card-hover md-card-overlay">
                            <div class="md-card-content">
                                <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                    <span class="epc_chart_icon"><i class="material-icons">&#xe1b3;</i></span>

                                </div>
                            </div>
                            <div class="md-card-overlay-content">
                                <div class="uk-clearfix md-card-overlay-header">
                                    <h3 class="md-color-light-blue-1000">
                                        Tweet
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="/datatraining/tabel">
                        <div class="md-bg-yellow-50 md-card md-card-hover md-card-overlay">
                            <div class="md-card-content">
                                <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                    <span class=" epc_chart_icon"><i class="material-icons">&#xe85d;</i></span>
                                </div>
                            </div>
                            <div class="md-card-overlay-content">
                                <div class="uk-clearfix md-card-overlay-header">
                                    <h3>
                                        Data Training
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/datatesting/tabel">
                        <div class="md-bg-red-blue-50 md-card md-card-hover md-card-overlay">
                            <div class="md-card-content">
                                <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                    <span class="epc_chart_icon"><i class="material-icons">&#xe862;</i></span>
                                </div>
                            </div>
                            <div class="md-card-overlay-content">
                                <div class="uk-clearfix md-card-overlay-header">
                                    <h3>
                                        Data Testing
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/streaming">
                        <div class="md-bg-green-50 md-card md-card-hover md-card-overlay">
                            <div class="md-card-content">
                                <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                    <span class="epc_chart_icon"><i class="material-icons">&#xe865;</i></span>
                                </div>
                            </div>
                            <div class="md-card-overlay-content">
                                <div class="uk-clearfix md-card-overlay-header">
                                    <h3>
                                        Indeks Kebahagiaan
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

        </div>
        <?php endif; ?>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.afterlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>