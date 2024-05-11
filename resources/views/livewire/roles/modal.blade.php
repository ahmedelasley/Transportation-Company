<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="createModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Name') }}</label>
                        <input class="form-control" type="text" name="name" wire:model.live='form.name' >
                        @error('form.name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="font-weight-bold h4"><strong>permission:</strong></div>
                            
                            @foreach (\Spatie\Permission\Models\Permission::select('type', 'type_name')->groupBy('type', 'type_name')->get() as $data)
    
    
                                <div class="row bg-light py-3">
                                    @php
                                        $permissionsPluck = $permissions->where('type', $data->type);
                                    @endphp
                                    @foreach($permissionsPluck->pluck('name','id')->all() as $id => $value)
                                        <div class="col-xs-4 col-sm-4 col-md-3">
                                            <label>
                                                <input wire:model.live='form.permissions' type="checkbox" value="{{ $id }}">
                                                {{ $value }}
                                            </label>
                                            <br/>
                                        </div>
                                    @endforeach

                                </div>
                            @endforeach
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click="save">{{ __('Save') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
<!-- End Create modal -->

<!-- Update modal -->
<div wire:ignore.self class="modal fade" id="updateModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Edit Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()" wire:click="$set('isModalOpen', false)"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Name') }}</label>
                        <input class="form-control" type="text" name="name" wire:model.live='form.name' >
                        @error('form.name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="font-weight-bold h4"><strong>permission:</strong></div>
                            
                            @foreach (\Spatie\Permission\Models\Permission::select('type', 'type_name')->groupBy('type', 'type_name')->get() as $data)
    
    
                                <div class="row bg-light py-3">
                                    @php
                                        $permissionsPluck = $permissions->where('type', $data->type);
                                    @endphp
                                    @foreach($permissionsPluck->pluck('name','id')->all() as $id => $value)
                                        <div class="col-xs-4 col-sm-4 col-md-3">
                                            <label>
                                                <input wire:model.live='form.permissions' type="checkbox"  value="{{ $id }}" {{ in_array($id, $rolePermissions) }}>
                                                {{ $value }}
                                            </label>
                                            <br/>
                                        </div>
                                    @endforeach

                                </div>
                            @endforeach
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click="update">{{ __('Save') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Update modal -->


<!-- Delete modal -->
<div wire:ignore.self class="modal fade" id="deleteModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Delete Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()" wire:click="$set('isModalOpen', false)"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h4 class="card-title mb-1 tx-center">{{ __('Are you sure you want to Permanently Remove this data?') }}</h4>
                <form id="form" >
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-danger" type="button" wire:click="delete">{{ __('Delete') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete modal -->

<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="assignPermissionModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Assign Permission') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="font-weight-bold h4"><strong>permission:</strong></div>
                            
                            @foreach (\Spatie\Permission\Models\Permission::select('type', 'type_name')->groupBy('type', 'type_name')->get() as $data)
    
    
                                <div class="row bg-light py-3">
                                    @php
                                        $permissionsPluck = $permissions->where('type', $data->type);
                                    @endphp
                                    @foreach($permissionsPluck->pluck('name','id')->all() as $id => $value)
                                        <div class="col-xs-4 col-sm-4 col-md-3">
                                            <label>
                                                <input wire:model.live='form.permissions' type="checkbox"  value="{{ $id }}" {{ in_array($id, $rolePermissions) }}>
                                                {{ $value }}
                                            </label>
                                            <br/>
                                        </div>
                                    @endforeach

                                </div>
                            @endforeach
                        </div>
                    </div>
    

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click="assignPermissions">{{ __('Save') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
<!-- End Create modal -->