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

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Email') }}</label>
                        <input class="form-control" type="email" name="email" wire:model.live='form.email' >
                        @error('form.email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Password') }}</label>
                        <input class="form-control" type="password"  wire:model.live='form.password' required autocomplete="new-password">
                        @error('form.password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Confirm Password') }}</label>
                        <input class="form-control" type="password" name="password_confirmation" wire:model.live='form.password_confirmation' required autocomplete="new-password">
                        @error('form.password_confirmation')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    {{-- <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Roles') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold "  multiple wire:model.live="form.roles" >
                                @forelse ($roles as $id => $role)
                                    <option class="h6 font-weight-bold" value="{{ $id }}">{{ $role }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.roles')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div> --}}
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

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Email') }}</label>
                        <input class="form-control" type="email" name="email" wire:model.live='form.email' >
                        @error('form.email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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


<!-- Update modal -->
<div wire:ignore.self class="modal fade" id="assignRoleModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Edit Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()" wire:click="$set('isModalOpen', false)"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    {{-- <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Roles') }}</label>
                        {!! Form::select('" wire:model.live="form.roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                        @error('form.roles')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div> --}}
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Roles') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold "  multiple wire:model.live="form.roles" >
                                @forelse ($roles as $id => $role)
                                    <option class="h6 font-weight-bold" value="{{ $id }}">{{ $role }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.roles')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click="assignRole">{{ __('Save') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Update modal -->

<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="passwordModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('New Password') }}</label>
                        <input class="form-control" type="password"  wire:model.live='form.password' required autocomplete="new-password">
                        @error('form.password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Confirm Password') }}</label>
                        <input class="form-control" type="password" name="password_confirmation" wire:model.live='form.password_confirmation' required autocomplete="new-password">
                        @error('form.password_confirmation')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click="passwordChange">{{ __('Save') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
<!-- End Create modal -->