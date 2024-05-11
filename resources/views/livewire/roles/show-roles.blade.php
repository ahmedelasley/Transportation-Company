<div>
    @section('sub-title'){{ $titlePage }}@endsection
    @include('livewire.roles.modal')


            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">{{ $titlePage }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
                    </div>
                </div>
                <div class="d-flex my-xl-auto right-content">
                    @can('user-create')
                        <div class="pr-1 mb-3 mb-xl-0">
                            <button type="button" class="btn btn-primary btn-icon ml-2" data-target="#createModel" data-toggle="modal"><i class="mdi mdi-plus"></i></button>
                        </div>
                    @endcan

                    <div class="pr-1 mb-3 mb-xl-0">
                        <select class="form-control rounded" wire:model.live="paginateCount">
                            @for($i = 10; $i <= 50; $i+=10)
                            <option value='{{ $i }}'>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="pr-1 mb-3 mb-xl-0">
                        <button type="button" class="btn btn-warning  btn-icon ml-2" wire:click="resetPage"><i class="mdi mdi-refresh"></i></button>
                    </div>
                    <div class="mb-3 mb-xl-0 z-3">
                        <div class="btn-group dropdown">
                            <input type="text" class="form-control" wire:model.live="searchTerm" placeholder="Search...">
                            {{-- <button type="button" class="btn btn-primary">14</button> --}}
                            <select class="form-control rounded" wire:model.live="sortBy">
                                <option class="h6 font-weight-bold" value="id">{{ __('Sort By') }}</option>
                                @forelse (\Schema::getColumnListing('roles')  as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @empty
                                @endforelse
                            </select>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownorderBy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu z-3" aria-labelledby="dropdownorderBy" data-x-placement="bottom-start" style="">
                                <a class="dropdown-item" wire:click="orderByFunction('ASC')">ASC</a>
                                <a class="dropdown-item" wire:click="orderByFunction('DESC')">DESC</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->

            <!-- row -->
            <div class="row">
                <div class="card col-md-12">

                    <div class="card-body">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 350px)">
                            <table class="table table-striped table-striped-columns table-hover table-bordered border-primary table-sm text-center">
                                <thead class="bg-primary sticky-top" style="z-index: 0;">
                                    <tr>
                                        <th class="wd-5p bg-gray-100"><h6><b>{{ __('#') }}</b></h6></th>
                                        <th class="wd-10p"><h6><b>{{ __('Name') }}</b></h6></th>
                                        <th class="wd-10p"><h6><b>{{ __('Permissions') }}</b></h6></th>

                                        <th class="wd-10p"><h6><b>{{ __('Control') }}</b></h6></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider tx-14 tx-bold">
                                    @forelse ($roles as $value)
                                    <tr>
                                        <th class="bg-gray-100" scope="row">
                                            {{ $roles->firstItem()+$loop->index }}
                                        </th>

                                        <td> {{ $value->name }} </td>
                                        <td> {{ $value->permissions_count }} </td>

                                        <td>
                                            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#showModal" wire:click.prevent='getForm({{ $value->id }})'><i class="fa fa-eye"></i> </a>
                                            @if(!($value->id == $roles->firstItem()))
                                            <a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#assignPermissionModal" wire:click.prevent='getForm({{ $value->id }})'><i class="fa fa-lock"></i> </a>

                                            <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#updateModal" wire:click.prevent='getForm({{ $value->id }})'><i class="fa fa-edit"></i> </a>
                                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteModal" wire:click.prevent='getForm({{ $value->id }})'><i class="fa fa-trash"></i> </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13">
                                                <div class="alert alert-info tx-20" role="alert">
                                                    <span class="alert-inner--icon"><i class="ti-bell"></i></span>
                                                    <span class="alert-inner--text"><strong> {{ __('alert.Alert') }} ! </strong> {{ __('alert.There is no data yet !', ['type' => __('alert.roles')]) }}</span>
                                                </div>    
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div><!-- bd -->
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row justify-content-end">
                            {{-- <div class=""> --}}
                                <ul class="pagination">
                                    {{ $roles->withQueryString()->onEachSide(5)->links() }} 
                                </ul>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
</div>