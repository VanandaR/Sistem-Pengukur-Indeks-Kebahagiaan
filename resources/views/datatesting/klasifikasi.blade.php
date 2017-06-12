@extends('.layouts.afterlogin')
@section('judul','Tabel Data Testing')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Data Training</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Tweet</th>
                            <th>NB Positive Probability</th>
                            <th>NB Negative Probability</th>
                            <th>Klasifikasi Sentimen</th>

                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php $i=0; @endphp

                        @foreach($datatesting as $dt)
                            <tr>
                                @php $i++;@endphp
                                <td>{{$i}}</td>
                                <td>{{$dt->tweet}}</td>
                                <td>0.7</td>
                                <td>0.3</td>
                                <td>Positif</td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" href="#modal_edit_stopword{{$dt->id}}" data-uk-modal="{center:true'}"><i class="md-icon material-icons">edit</i></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/datatraining/delete/{{$dt->id}}' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <div class="uk-modal" id="modal_edit_stopword{{$dt->id}}">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Edit Stopword</h3>
                                    </div>
                                    <form method="post" action="/stopword/update">
                                        {{ csrf_field() }}
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
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

