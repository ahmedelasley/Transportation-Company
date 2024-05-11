@extends('layouts.master')

@section('link')
<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">الأدوار والصلاحيات</a></li>
<li class="breadcrumb-item active">تعديل الدور</li>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="text-bold h5">تعديل الدور</div>
            </div>
        </div>

        <div class="card-body table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 330px)">



            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <div class="font-weight-bold h4"><strong>Role:</strong></div>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="font-weight-bold h4"><strong>permission:</strong></div>
                            
                            @foreach (\Spatie\Permission\Models\Permission::select('type', 'type_name')->groupBy('type', 'type_name')->get() as $data)

                            <div class="my-2 h6 font-weight-bold d-block"><b><input type="checkbox" onClick="check_uncheck_edit_checkbox{{ $data->type }}(this.checked);"> {{ $data->type_name }} </b></div>

                                <div class="row bg-light py-3">
                            
                                @foreach($permission->where('type', $data->type) as $value)
                                    <div class="col-xs-4 col-sm-4 col-md-3">
                                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'checkbox_'.$data->type)) }}
                                        {{ $value->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <script>
                                function check_uncheck_edit_checkbox{{ $data->type }}(isChecked) {
                                    if(isChecked) {
                                        $('input[class="checkbox_{{ $data->type }}"]').each(function() { 
                                            this.checked = true; 
                                        });
                                    } else {
                                        $('input[class="checkbox_{{ $data->type }}"]').each(function() {
                                            this.checked = false;
                                        });
                                    }
                                }
                            </script>
                        @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>




@endsection