@extends('layouts.master')

@section('link')
<li class="breadcrumb-item active">Role</li>
@endsection

@section('statistics')
<h6>Role ({{ $roles->count()}})</h6>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="text-bold h5">Role</div>
                <div class="">
                    @can('role-create')
                        <a class="btn btn-xs btn-primary" href="{{ route('roles.create') }}"><i class="fas fa-plus"></i> create </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card-body table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 330px)">

            <table class="table table-sm table-hover table-striped  table-bordered text-center">
                <thead style="position: sticky;top: -22px"  class="table-dark">
                    <tr>
                        <th scope="col">م</th>
                        <th scope="col">Role</th>
                        <th scope="col">permission</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($roles as $key => $value)
                        <tr>
                            <th class="table-dark" scope="row">{{ $roles->firstItem()+$loop->index }}</th>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->permissions_count }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('roles.show',$value->id) }}"><i class="fas fa-eye"></i> show</a>
                                @if(!($value->id == $roles->firstItem()))
                                    @can('role-edit')
                                        <a class="btn btn-xs btn-success" href="{{ route('roles.edit',$value->id) }}"><i class="fas fa-edit"></i> edit</a>
                                    @endcan
                                    @can('role-delete')
                                        
                                        <a href="{{ route('roles.destroy', $value->id) }}" class="btn btn-xs btn-danger" data-confirm-delete="true"><i class="fas fa-times"></i> delete</a>

                                        <!-- {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $value->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('حذف', ['class' => 'btn btn-xs btn-danger', 'data-confirm-delete' => "true"]) !!}
                                        {!! Form::close() !!} -->
                                        
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection