@extends('.layouts.afterlogin')
@section('judul','Edit User')
@section('konten')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Edit User</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <form method="post" action="/user/update">
                        {{ csrf_field() }}
                        <input type="hidden" value="<?php echo $user->id;?>" name="id">
                        <div class="uk-form-row">
                            <input type="hidden" value="<?php echo $user->id;?>" name="id">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1">
                                    <label for="message">Username</label>
                                    <input type="text" class="md-input" name="username" value="{{$user->name}}" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-form-row">

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1">
                                    <label for="message">Email</label>
                                    <input type="text" class="md-input" name="email" value="{{$user->email}}" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-1 uk-width-large-1-1">
                                    <select id="select_demo_1" name="role" data-md-selectize>

                                        <option value="">Role</option>
                                        @foreach($role as $r)
                                            <option value="{{$r->id}}" {{($user->role_id==$r->id)?"selected":""}}>{{$r->nama}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

