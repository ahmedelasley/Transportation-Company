<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="createModel" >
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" class="row" >
                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Trip Date') }}</label>
                        <input class="form-control" type="datetime-local" name="date" wire:model.live='form.date' >
                        @error('form.date')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    {{-- <div class="form-group col-sm-6 col-xl-2 col-lg-2 offset-md-2">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Code') }}</label>
                        <input class="form-control" type="text" name="code"  wire:model.live='form.code' readonly>
                        @error('form.code')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div> --}}

                    <div class="form-group col-sm-6 col-xl-3 col-lg-3 offset-md-6">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Desrved Date') }}</label>
                        <input class="form-control" type="datetime-local" name="desrved_date" wire:model.live='form.desrved_date' >
                        @error('form.desrved_date')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-xl-12 col-lg-12 d-block my-3 border-bottom border-5 border-primary"></div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Client') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.client_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Client') }}" ></option>
                                @forelse ($clients as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.client_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('From Area') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.from_area" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Area') }}" ></option>
                                @forelse ($from_areas as $value)
                                    @if ($value->parent_id == NULL)
                                        <option class="h6 font-weight-bold tx-white bg-primary" label="{{ $value->name }}" ></option>
                                    @else
                                        <option class="" value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endif
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.from_area')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Direction') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.direction" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Direction') }}" ></option>
                                <option class="h6 font-weight-bold" value="One Way">{{ __('One Way') }}</option>
                                <option class="h6 font-weight-bold" value="Round Trip">{{ __('Round Trip') }}</option>
                                <option class="h6 font-weight-bold" value="Wait">{{ __('Wait') }}</option>
                            </select>
                        </div>
                        @error('form.direction')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Company') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.company_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Company') }}" ></option>
                                @forelse ($companies as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.company_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>


                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('To Area') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.to_area" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Area') }}" ></option>
                                @forelse ($to_areas as $value)
                                    @if ($value->parent_id == NULL)
                                        <option class="h6 font-weight-bold tx-white bg-primary" label="{{ $value->name }}" ></option>
                                    @else
                                        <option class="" value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endif
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.to_area')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Vehicle') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.vehicle_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Vehicle') }}" ></option>
                                @forelse ($vehicles as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.vehicle_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-xl-12 col-lg-12 d-block my-3 border-bottom border-5 border-primary"></div>

                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Service Cost') }}</label>
                        <input class="form-control" type="number" min="0" name="service_cost" wire:model.live='form.service_cost' >
                        @error('form.service_cost')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group col-sm-6 col-xl-3 col-lg-3 ">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Wait Cost') }}</label>
                        <input class="form-control" type="number" min="0" name="wait_cost" wire:model.live='form.wait_cost' >
                        @error('form.wait_cost')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group  col-sm-6 col-xl-3 col-lg-3 offset-md-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Total') }}</label>
                        <span class="form-control" > {{ (is_numeric($form->service_cost) ? $form->service_cost : 0) +  (is_numeric($form->wait_cost) ? $form->wait_cost : 0) }}</span>
                    </div>

                    <div class="form-group  col-sm-6 col-xl-3 col-lg-3 offset-md-9">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Paid') }}</label>
                        <input class="form-control" type="number" min="0" name="paid" wire:model.live='form.paid' >
                        @error('form.paid')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-3 offset-md-9 d-block my-3 border-bottom border-5 border-primary"></div>


                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Category') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.category_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Category') }}" ></option>
                                @forelse ($categories as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.category_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Status') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.status_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Status') }}" ></option>
                                @forelse ($statuses as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.status_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group  col-sm-6 col-xl-3 col-lg-3 offset-md-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Rest') }}</label>
                        <span class="form-control" > {{ ( (is_numeric($form->service_cost) ? $form->service_cost : 0 ) +  (is_numeric($form->wait_cost) ? $form->wait_cost : 0) ) - (is_numeric($form->paid) ? $form->paid : 0) }}</span>
                    </div>
                    <div class="col-sm-12 col-xl-12 col-lg-12 d-block my-3 border-bottom border-5 border-primary"></div>

                    <div class="form-group col-sm-12 col-xl-12 col-lg-12 ">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Notes') }}</label>
                        <input class="form-control" type="text"  name="notes" wire:model.live='form.notes' >
                        @error('form.notes')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Edit Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()" wire:click="$set('isModalOpen', false)"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" class="row" >
                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Trip Date') }}</label>
                        <input class="form-control" type="datetime-local" name="date" wire:model.live='form.date' >
                        @error('form.date')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-2 col-lg-2 offset-md-2">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Code') }}</label>
                        <input class="form-control" type="text" name="code"  wire:model.live='form.code' readonly>
                        @error('form.code')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group col-sm-6 col-xl-3 col-lg-3 offset-md-2">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Desrved Date') }}</label>
                        <input class="form-control" type="datetime-local" name="desrved_date" wire:model.live='form.desrved_date' >
                        @error('form.desrved_date')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-xl-12 col-lg-12 d-block my-3 border-bottom border-5 border-primary"></div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Client') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.client_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Client') }}" ></option>
                                @forelse ($clients as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.client_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('From Area') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.from_area" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Area') }}" ></option>
                                @forelse ($from_areas as $value)
                                    @if ($value->parent_id == NULL)
                                        <option class="h6 font-weight-bold tx-white bg-primary" label="{{ $value->name }}" ></option>
                                    @else
                                        <option class="" value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endif
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.from_area')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Direction') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.direction" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Direction') }}" ></option>
                                <option class="h6 font-weight-bold" value="One Way">{{ __('One Way') }}</option>
                                <option class="h6 font-weight-bold" value="Round Trip">{{ __('Round Trip') }}</option>
                                <option class="h6 font-weight-bold" value="Wait">{{ __('Wait') }}</option>
                            </select>
                        </div>
                        @error('form.direction')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Company') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.company_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Company') }}" ></option>
                                @forelse ($companies as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.company_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>


                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('To Area') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.to_area" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Area') }}" ></option>
                                @forelse ($to_areas as $value)
                                    @if ($value->parent_id == NULL)
                                        <option class="h6 font-weight-bold tx-white bg-primary" label="{{ $value->name }}" ></option>
                                    @else
                                        <option class="" value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endif
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.to_area')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group col-sm-6 col-xl-4 col-lg-4">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Vehicle') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.vehicle_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Vehicle') }}" ></option>
                                @forelse ($vehicles as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.vehicle_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-12 col-xl-12 col-lg-12 d-block my-3 border-bottom border-5 border-primary"></div>

                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Service Cost') }}</label>
                        <input class="form-control" type="number" min="0" name="service_cost" wire:model.live='form.service_cost' >
                        @error('form.service_cost')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group col-sm-6 col-xl-3 col-lg-3 ">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Wait Cost') }}</label>
                        <input class="form-control" type="number" min="0" name="wait_cost" wire:model.live='form.wait_cost' >
                        @error('form.wait_cost')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group  col-sm-6 col-xl-3 col-lg-3 offset-md-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Total') }}</label>
                        <span class="form-control" > {{ (is_numeric($form->service_cost) ? $form->service_cost : 0) +  (is_numeric($form->wait_cost) ? $form->wait_cost : 0) }}</span>
                    </div>

                    <div class="form-group  col-sm-6 col-xl-3 col-lg-3 offset-md-9">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Paid') }}</label>
                        <input class="form-control" type="number" min="0" name="paid" wire:model.live='form.paid' >
                        @error('form.paid')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-3 offset-md-9 d-block my-3 border-bottom border-5 border-primary"></div>


                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Category') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.category_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Category') }}" ></option>
                                @forelse ($categories as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.category_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-sm-6 col-xl-3 col-lg-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Status') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.status_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Status') }}" ></option>
                                @forelse ($statuses as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                    <option class="h6 font-weight-bold" label="{{ __('No Data') }}"></option>
                                @endforelse

                            </select>
                        </div>
                        @error('form.status_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group  col-sm-6 col-xl-3 col-lg-3 offset-md-3">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Rest') }}</label>
                        <span class="form-control" > {{ ( (is_numeric($form->service_cost) ? $form->service_cost : 0 ) +  (is_numeric($form->wait_cost) ? $form->wait_cost : 0) ) - (is_numeric($form->paid) ? $form->paid : 0) }}</span>
                    </div>
                    <div class="col-sm-12 col-xl-12 col-lg-12 d-block my-3 border-bottom border-5 border-primary"></div>

                    <div class="form-group col-sm-12 col-xl-12 col-lg-12 ">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Notes') }}</label>
                        <input class="form-control" type="text"  name="notes" wire:model.live='form.notes' >
                        @error('form.notes')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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


<!-- Show modal -->
<div wire:ignore.self class="modal fade" id="showModal" >
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Trip Details') }} [ {{ $form->code }} ]</h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()" wire:click="$set('isModalOpen', false)"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">Invoice</h1>
										<div class="billed-from">
											<h6>{{ SettingHelper::setting('name') }}</h6>
											<p>{{ SettingHelper::setting('address') }}<br>
											Tel No: {{ SettingHelper::setting('phone') }}<br>
											Email: {{ SettingHelper::setting('email') }}</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">Receipt To</label>
											<div class="billed-to">
												<h6>{{ $form->clientOrCompany }}</h6>
												<p>{{ $form->clientOrCompanyAddress }}<br>
                                                    {{ $form->clientOrCompanyPhone }}<br>
												Email: {{ $form->clientOrCompanyEmail }}</p>
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">Trip Information</label>
											<p class="invoice-info-row"><span>{{ __('Code') }}</span> <span>{{ $form->code }}</span></p>
											<p class="invoice-info-row"><span>{{ __('Client / Company') }}</span> <span>{{ $form->clientOrCompany }}</span></p>
											<p class="invoice-info-row"><span>{{ __('Date') }}</span> <span>{{ $form->date }}</span></p>
											<p class="invoice-info-row"><span>{{ __('Desrved Date') }}</span> <span>{{ $form->desrved_date }}</span></p>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="tx-center">{{ __('From Area') }}</th>
													<th class="tx-center">{{ __('To Area') }}</th>
													<th class="tx-center">{{ __('Direction') }}</th>
													<th class="tx-center">{{ __('Vehicle') }}</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="tx-center">{{ $form->fromAea }}</td>
													<td class="tx-center">{{ $form->toAea }}</td>
													<td class="tx-center">{{ $form->direction }}</td>
													<td class="tx-center">{{ $form->vehicle_name }}</td>
												</tr>

												<tr>
													<td class="" colspan="2" rowspan="5">
														<div class="">
															<label class="main-content-label tx-13">Notes</label>
															<p>{{ $form->notes }}</p>
														</div>
													</td>
													<td class="tx-right">{{ __('Service Cost')}}</td>
													<td class="tx-right" colspan="2">{{ number_format($form->service_cost, SettingHelper::setting('price') ) }}</td>
												</tr>
                                                <tr>
													<td class="tx-right">{{ __('Wait Cost')}}</td>
													<td class="tx-right" colspan="2">{{ number_format($form->wait_cost, SettingHelper::setting('price') ) }}</td>
                                                </tr>
                                                <tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('Total')}}</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">{{ number_format($form->service_cost + $form->wait_cost, SettingHelper::setting('price') ) }}</h4>
													</td>
                                                </tr>
												<tr>
													<td class="tx-right">{{ __('Paid')}}</td>
													<td class="tx-right" colspan="2">{{ number_format($form->paid, SettingHelper::setting('price') ) }}</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('Rest')}}</td>
													<td class="tx-right" colspan="2">{{ number_format(( $form->service_cost + $form->wait_cost ) -  $form->paid, SettingHelper::setting('price') ) }}</td>
												</tr>

											</tbody>

										</table>
                                        <span><b>Created : </b>{{ $form->created_by }} {{ $form->created_at }}</span>
                                        <span><b>Updated : </b>{{ $form->updated_by }} {{ $form->updated_at }}</span>
									</div>
									{{-- <hr class="mg-b-40"> --}}

								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
            </div>
            <div class="modal-footer">
                {{-- <button class="btn ripple btn-danger" data-dismiss="modal" type="button" wire:click="close()"><i class="mdi mdi-printer ml-1"></i> {{ __('Print') }}</button> --}}
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Show modal -->