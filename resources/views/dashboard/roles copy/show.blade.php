@extends('layouts.master')

@section('link')
<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>

<li class="breadcrumb-item active">{{ $role->name }}</li>
@endsection

@section('statistics')
<h6>Permissions ({{ $role->permissions->count()}})</h6>
@endsection

@section('content')



<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="text-bold h5">{{ $role->name }}</div>
            </div>
        </div>

        <div class="card-body table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 330px)">
            <div class="font-weight-bold h4"><strong>Permissions:</strong></div>
            @foreach (\Spatie\Permission\Models\Permission::select('type', 'type_name')->groupBy('type', 'type_name')->get() as $data)

                <div class="my-2 h6 font-weight-bold d-block"><b>{{ $data->type_name }} </b></div>

                <div class="row bg-light py-3">
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions->where('type', $data->type) as $value)
                            <div class="col-xs-4 col-sm-4 col-md-3">
                                <label>{{ $value->name }}</label>
                                <br/>
                            </div>
                        @endforeach
                    @endif
                </div>

            @endforeach

        </div>
    </div>
</div>



@endsection