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
                        <label class="main-content-label h6 font-weight-bold">{{ __('Phone') }}</label>
                        <input class="form-control" type="text" name="phone_number" wire:model.live='form.phone_number' >
                        @error('form.phone_number')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Email') }}</label>
                        <input class="form-control" type="email" name="email" wire:model.live='form.email' >
                        @error('form.email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Address') }}</label>
                        <input class="form-control" type="text" name="address" wire:model.live='form.address' >
                        @error('form.address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Area') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.area_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Area') }}" ></option>
                                @forelse ($areas as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.area_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Know US') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.social_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Know US') }}" ></option>
                                @forelse ($socials as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.social_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Category') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.category_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Category') }}" ></option>
                                @forelse ($categories as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.category_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Date') }}</label>
                        <input class="form-control" type="datetime-local" name="date" wire:model.live='form.date' >
                        @error('form.date')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Notes') }}</label>
                        <input class="form-control" type="text" name="notes" wire:model.live='form.notes' >
                        @error('form.notes')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Status') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.status_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Status') }}" ></option>
                                @forelse ($statuses as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.status_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Phone') }}</label>
                        <input class="form-control" type="text" name="phone_number" wire:model.live='form.phone_number' >
                        @error('form.phone_number')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Email') }}</label>
                        <input class="form-control" type="email" name="email" wire:model.live='form.email' >
                        @error('form.email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Address') }}</label>
                        <input class="form-control" type="text" name="address" wire:model.live='form.address' >
                        @error('form.address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Area') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.area_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Area') }}" ></option>
                                @forelse ($areas as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.area_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Know US') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.social_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Know US') }}" ></option>
                                @forelse ($socials as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.social_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Category') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.category_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Category') }}" ></option>
                                @forelse ($categories as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.category_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Date') }}</label>
                        <input class="form-control" type="datetime-local" name="date" wire:model.live='form.date' >
                        @error('form.date')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Notes') }}</label>
                        <input class="form-control" type="text" name="notes" wire:model.live='form.notes' >
                        @error('form.notes')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Status') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.status_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Status') }}" ></option>
                                @forelse ($statuses as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty

                                @endforelse

                            </select>
                        </div>
                        @error('form.status_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Client Profile') }}</h6>

                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()" wire:click="$set('isModalOpen', false)"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-sm-12 col-xl-12 col-lg-12">
                        
						<div class="card user-wideget user-wideget-widget widget-user">
							<div class="widget-user-header bg-primary">
								<h3 class="widget-user-username">{{ $form->name }}</h3>
								<h5 class="widget-user-desc">{{ $form->category_name }}</h5>
							</div>
							<div class="widget-user-image">
								<img src="{{URL::asset('assets/img/faces/17.jpg')}}" class="brround" alt="User Avatar">
							</div>
							<div class="user-wideget-footer">
								<div class="row">
									<div class="col-sm-4 border-left">
										<div class="description-block">
											<h5 class="description-header">3,200</h5>
											<span class="description-text">SALES</span>
										</div>
									</div>
									<div class="col-sm-4 border-left">
										<div class="description-block">
											<h5 class="description-header">13,000</h5>
											<span class="description-text">FOLLOWERS</span>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="description-block">
											<h5 class="description-header">35</h5>
											<span class="description-text">PRODUCTS</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-sm-12 col-lg-12 col-xl-12">
						<div class="">
							<a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
							<div class="main-content-body main-content-body-contacts card custom-card">
								<div class="main-contact-info-body">
									<div class="media-list pb-0">
										<div class="media">
											<div class="media-body">
												<div>
													<label>Phone</label> <span class="tx-medium">{{ $form->phone_number }}</span>
												</div>
												<div>
													<label>Email</label> <span class="tx-medium">{{ $form->email }}</span>
												</div>
											</div>
										</div>
                                        <div class="media">
											<div class="media-body">
												<div>
													<label>Current Address</label> <span class="tx-medium">{{ $form->address }}</span>
												</div>
											</div>
										</div>
										<div class="media">
											<div class="media-body">
												<div>
													<label>Area</label> <span class="tx-medium">{{ $form->area_name }}</span>
												</div>
												<div>
													<label>Know US</label> <span class="tx-medium">{{ $form->social_name }}</span>
												</div>
											</div>
										</div>

										<div class="media mb-0">
											<div class="media-body">
												<div>
													<label>Notes</label> <span class="tx-medium">{{ $form->notes }}</span>
												</div>
											</div>
										</div>
                                        <div class="media mb-0">
											<div class="media-body">
												<div>
													<label>Created By</label> <span class="tx-medium">{{ $form->created_by }}: {{ $form->created_at }}</span>
												</div>
											</div>
										</div>

                                        <div class="media mb-0 mx-2 pb-2">
											<div class="media-body">
												<div>
													<label>Phones</label>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('#') }}</th>
                                                                    <th>{{ __('Phone') }}</th>
                                                                    <th>{{ __('Category') }}</th>
                                                                    <th>{{ __('Control') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    @php
                                                                        $i=1
                                                                    @endphp
                                                                    @forelse ($form->phones as $phone)
                                                                        <tr>
                                                                            <th class="bg-gray-100" scope="row">{{ $i++ }}</th>
                                                                            <td>{{ $phone->phone}}</td>
                                                                            <td>{{ $phone->category->name}}</td>
                                                                            <td>
                                                                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deletePhoneModal" wire:click.prevent='getFormInside({{ $phone->id }})'><i class="fa fa-trash"></i> </a>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                    @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Show modal -->


<!-- show Phones Modal -->
<div wire:ignore.self class="modal fade" id="showPhonesModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Show Phones') }} [ {{ $form->name }} ]</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()" wire:click="$set('isModalOpen', false)"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $i=1
                                @endphp
                                @forelse ($form->phones as $phone)
                                    <tr>
                                        <th class="bg-gray-100" scope="row">{{ $i++ }}</th>
                                        <td>{{ $phone->phone}}</td>
                                        <td>{{ $phone->category->name}}</td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deletePhoneModal" wire:click.prevent='getFormInside({{ $phone->id }})'><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End show Phones Model -->

<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="phoneModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Add Data') }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Phone') }}</label>
                        <input class="form-control" type="text" name="phone" wire:model.live='form.phone' >
                        @error('form.phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="main-content-label h6 font-weight-bold">{{ __('Category') }}</label>
  
                        <div class="input-group" >
                            <select class="form-control h6 font-weight-bold" wire:model.live="form.category_id" >
                                <option class="h6 font-weight-bold" label="{{ __('Choose Category') }}" ></option>
                                @forelse ($categoriesPhones as $value)
                                    <option class="h6 font-weight-bold" value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                @endforelse

                            </select>
                        </div>
                        @error('form.category_id')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click="savePhone">{{ __('Save') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
<!-- End Create modal -->

<!-- Delete Phone modal -->
<div wire:ignore.self class="modal fade" id="deletePhoneModal" >
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
                <button class="btn ripple btn-danger" type="button" wire:click="deletePhone">{{ __('Delete') }}</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Phone modal -->