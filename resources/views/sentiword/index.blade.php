@extends('layouts.afterlogin')
@section('judul','Sentiword')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Sentiword Table</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Sentiword</th>
                            <th>Positif Score</th>
                            <th>Negatif Score</th>
                            <th width="30%" class="filter-false remove sorter-false uk-text-center">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @php $i=0; @endphp

                        @foreach($sentiword as $sw)
                            <tr>
                                @php $i++;@endphp
                                <td>{{$i}}</td>
                                <td>{{$sw->text}}</td>
                                <td>{{$sw->pos_score}}</td>
                                <td>{{$sw->neg_score}}</td>
                                <td class="uk-text-center">
                                    <a class="ts_remove_row" href="#modal_edit_sentiword{{$sw->id}}" data-uk-modal="{center:true'}"><i class="md-icon material-icons">edit</i></a>
                                    <a type="hidden" name="delete_sentiword" href="/sentiword/delete/{{$sw->id}}"></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/sentiword/delete/{{$sw->id}}' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <div class="uk-modal" id="modal_edit_sentiword{{$sw->id}}">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Edit sentiword</h3>
                                    </div>
                                    <form method="post" action="/sentiword/update">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="<?php echo $sw->id;?>" name="id">
                                        <div class="uk-form-row">
                                            <div class="md-input-wrapper md-input-filled">
                                                <label>sentiword</label>
                                                <input type="text" value="<?php echo $sw->text;?>" name="sentiword" class="md-input">
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-2">
                                                        <label>Positive Score</label>
                                                        <input type="number" value="<?php echo $sw->pos_score;?>" class="md-input" name="p"/>
                                                    </div>

                                                    <div class="uk-form-row uk-width-1-2">
                                                        <label>Negative Score</label>
                                                        <input type="number" value="<?php echo $sw->neg_score;?>" class="md-input" name="n"/>
                                                    </div>
                                                </div>
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
        <a class="md-fab md-fab-primary" href="#modal_insert_sentiword" data-uk-modal="{center:true'}"><i class="material-icons">add</i></a>
    </div>
    <div class="uk-modal" id="modal_insert_sentiword">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Input Sentiword</h3>
            </div>
            <form method="post" action="/sentiword/insert">
                {{ csrf_field() }}
                <div class="uk-form-row">
                    <label>Sentiword</label>
                    <input type="text" class="md-input" name="sentiword" />
                </div>
                <div class="uk-form-row">
                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <label>Positive Score</label>
                            <input type="text" class="md-input" name="pos_score" />
                        </div>

                        <div class="uk-form-row uk-width-1-2">
                            <label>Negative Score</label>
                            <input type="text" class="md-input" name="neg_score" />
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button><button type="submit" class="md-btn md-btn-flat md-btn-flat-primary"  data-message="Top Right" data-pos="top-right">Save</button>
                </div>

            </form>
        </div>
    </div>


@endsection

