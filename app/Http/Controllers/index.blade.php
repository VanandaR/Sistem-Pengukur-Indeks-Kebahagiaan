@extends('.layouts.afterlogin')
@section('judul','Tabel Data Testing')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Data Testing</h4>
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
                        @php $i=0; @endphp

                        @foreach($datatesting as $dt)
                            <tr>
                                @php $i++;@endphp
                                <td>{{$i}}</td>
                                <td>{{$dt->user}}</td>
                                <td>{{$dt->tweet}}</td>
                                <td>{{$dt->post_time}}</td>
                                <td>{{$dt->classification->manual_sentimen_label}}</td>
                                <td>{{$dt->classification->manual_category_label}}</td>
                                <td class="uk-text-center">
                                    <a href="/datatesting/edit/{{$dt->id}}"><i class="md-icon material-icons">edit</i></a>
                                    <a class="ts_remove_row" onclick="UIkit.modal.confirm('Apakah kamu yakin?', function(){location.href='/datatraining/delete/{{$dt->id}}' });"><i class="md-icon material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

