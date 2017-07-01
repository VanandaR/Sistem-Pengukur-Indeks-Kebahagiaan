@extends('.layouts.afterlogin')
@section('judul','Tabel Data Testing')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-width-medium-1-1 uk-container-center">
                <div class="md-card md-card-single">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons" id="toggleAll">&#xe8f2;</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text large">
                            FAQ
                        </h3>
                    </div>
                    <div class="md-card-content padding-reset">
                        <div class="uk-accordion uk-accordion-alt hierarchical_slide help_accordion" data-slide-children="h3" data-slide-context=".md-card-content">
                            <h3 class="uk-accordion-title">Apa fungsi dari ahli bahasa?</h3>
                            <div class="uk-accordion-content">
                                <p>Ahli bahasa berfungsi untuk mengklasifikasikan sentimen dan kategori data teks secara manual, untuk mendapatkan data training yang lebih baik, dan menguji data testing hasil klasifikasi</p>
                            </div>
                            <h3 class="uk-accordion-title">Bagaimana cara melakukan klasifikasi?</h3>
                            <div class="uk-accordion-content">
                                <p>Klik menu tweet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

