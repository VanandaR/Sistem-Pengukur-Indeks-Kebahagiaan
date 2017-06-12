@extends('layouts.afterlogin')
@section('judul','Stopword')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Stopword Table</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Stopword</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php $i=0; @endphp

                        @foreach($stopwords as $sw)
                            <tr>
                                @php $i++;@endphp
                                <td>{{$i}}</td>
                                <td>{{$sw->text}}</td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" href="#modal_edit_stopword{{$sw->id}}" data-uk-modal="{center:true'}"><i class="md-icon material-icons">edit</i></a>
                                    <a type="hidden" name="delete_stopword" href="/stopword/delete/{{$sw->id}}"></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/stopword/delete/{{$sw->id}}' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <div class="uk-modal" id="modal_edit_stopword{{$sw->id}}">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Edit Stopword</h3>
                                    </div>
                                    <form method="post" action="/stopword/update">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="<?php echo $sw->id;?>" name="id">
                                        <div class="uk-form-row">
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>Stopword</label>
                                                <input type="text" value="<?php echo $sw->text;?>" name="stopword" class="md-input">
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

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary" href="#modal_insert_stopword" data-uk-modal="{center:true'}"><i class="material-icons">add</i></a>
    </div>
    <div class="uk-modal" id="modal_insert_stopword">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Input Stopword</h3>
            </div>
            <form method="post" action="/stopword/insert">
                {{ csrf_field() }}
                <div class="uk-form-row">
                    <label>Stopword</label>
                    <input type="text" class="md-input" name="stopword" />
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Save</button>
                </div>
            </form>
        </div>
    </div>


@endsection

