<div>
    @section('sub-title'){{ $titlePage }}@endsection
    @include('livewire.settings.modal')
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">{{ $titlePage }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
                    </div>
                </div>
                <div class="d-flex my-xl-auto right-content">

                </div>
            </div>
            <!-- breadcrumb -->

            <!-- row -->
            <div class="row mg-t-20" x-data="{ settingTab: 'Main' }">
                <div class="col-lg-4 col-xl-3">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title"><i class="fa fa-coes-alt mx-3"></i> {{ __('Settings') }}</div>
                        </div>
                        <div class="card-body pt-0 ">
                            <div class="">
                                <nav class="nav main-nav-column">
                                    <a class="nav-link thumb mb-2" href="#" :class="{'active' : settingTab === 'Main' }" @click.prevent="settingTab = 'Main'">
                                        <i class="fa fa-home mx-3"></i>  {{ __('Main') }}
                                    </a>
                                    <a class="nav-link thumb mb-2" href="#" :class="{'active' : settingTab === 'Contact' }" @click.prevent="settingTab = 'Contact'">
                                        <i class="fa fa-phone-volume mx-3"></i>  {{ __('Contact') }}
                                    </a>
                                    <a class="nav-link thumb mb-2" href="#" :class="{'active' : settingTab === 'Account' }" @click.prevent="settingTab = 'Account'">
                                        <i class="fa fa-money-bill mx-3"></i>  {{ __('Account') }}
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xl-9"  x-show="settingTab === 'Main' ">
                    <div class="card custom-card">
                        <div class="card-header bg-primary-gradient">
                            <div class="card-title d-flex">
                                <div class="mx-3 btn-icon wd-60 ht-60 rounded-50 bg-gray-100"><i class="fa fa-home"></i></div>	
                                <div class="my-2 tx-28">{{ __('Main') }}</div>	
                            </div>
                            
                        </div>
                    </div>

                    <div class="row my-custom-scrollbar" style="height : calc(100vh - 350px)">
                        <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 p-2">

                            <div class="card">
                                
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-start">
                                            <div class="mr-3 btn-icon rounded-50 bg-gray-100"><i class="fa fa-home"></i></div>
                                            <div class="tx-bold tx-20">{{ __('APP Name') }}</div>
                                        </li>
                                        <li class="list-group-item list-group-item-action ">
                                            <div class="form-group">
                                                <label class="main-content-label h6 font-weight-bold">{{ $setting->where('key', 'name')->first()->value }}</label>
                                                <label class="tx-success">{{ $form->name }}</label>
                                                <input wire:keydown.enter="update('{{ $setting->where('key', 'name')->first()->id }}', 'name')" class="form-control" type="text" name="name" wire:model.live='form.name' placeholder="{{ __('APP Name') }}">
                                                @error('form.name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between">
                                            <span class="tx-primary"><i class="ti-bell"></i> <b>Created : </b>{{ $setting->where('key', 'name')->first()->createdBy->name }} {{ $setting->where('key', 'name')->first()->created_at }}</span>
                                            <span class="tx-success"><i class="ti-bell"></i> <b>Updated : </b>{{ $setting->where('key', 'name')->first()->updatedBy?->name }} {{ $setting->where('key', 'name')->first()->updatedBy != NULL ? $setting->where('key', 'name')->first()->updated_at : ''}}</span>
                                        </li>

                                    </ol>
                                </div>
                            </div>

                            <div class="card">
                                
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-start">
                                            <div class="mr-3 btn-icon rounded-50 bg-gray-100"><i class="fa fa-link"></i></div>
                                            <div class="tx-bold tx-20">{{ __('APP Link') }}</div>
                                        </li>
                                        <li class="list-group-item list-group-item-action ">
                                            <div class="form-group">
                                                <label class="main-content-label h6 font-weight-bold"><a href="{{ $setting->where('key', 'link')->first()->value }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-link"></i> {{ $setting->where('key', 'link')->first()->value }}</a></label>
                                                <label class="tx-success">{{ $form->link }}</label>
                                                <input wire:keydown.enter="update('{{ $setting->where('key', 'link')->first()->id }}', 'link')" class="form-control" type="text" name="link" wire:model.live='form.link' placeholder="{{ __('APP Link') }}">
                                                @error('form.link')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between">
                                            <span class="tx-primary"><i class="ti-bell"></i> <b>Created : </b>{{ $setting->where('key', 'link')->first()->createdBy->name }} {{ $setting->where('key', 'link')->first()->created_at }}</span>
                                            <span class="tx-success"><i class="ti-bell"></i> <b>Updated : </b>{{ $setting->where('key', 'link')->first()->updatedBy?->name }} {{ $setting->where('key', 'link')->first()->updatedBy != NULL ? $setting->where('key', 'link')->first()->updated_at : ''}}</span>
                                        </li>

                                    </ol>
                                </div>
                            </div>

                            <div class="card">
                                
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-start">
                                            <div class="mr-3 btn-icon rounded-50 bg-gray-100"><i class="fa fa-database"></i></div>
                                            <div class="tx-bold tx-20">{{ __('Backup') }}</div>
                                        </li>
                                        <li class="list-group-item list-group-item-action ">
                                            <div class="form-group">
                                                <button class="btn btn-block btn-success ripple" type="button" wire:click="backup"><i class="fa fa-download mr-2"></i>{{ __('Backup') }}</button>
                                            </div>
                                        </li>

                                    </ol>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 p-2">


                        </div>

                    </div>

                </div>
                
                <div class="col-lg-8 col-xl-9"  x-show="settingTab === 'Contact' ">
                    <div class="card custom-card">
                        <div class="card-header bg-primary-gradient">
                            <div class="card-title d-flex">
                                <div class="mx-3 btn-icon wd-60 ht-60 rounded-50 bg-gray-100"><i class="fa fa-phone"></i></div>	
                                <div class="my-2 tx-28">{{ __('Contact') }}</div>	
                            </div>
                            
                        </div>
                    </div>

                    <div class="row my-custom-scrollbar" style="height : calc(100vh - 350px)">
                        <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 p-2">
                            <div class="card">
                                
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
   
                                        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-start">
                                            <div class="mr-3 btn-icon rounded-50 bg-gray-100"><i class="fa fa-phone"></i></div>
                                            <div class="tx-bold tx-20">{{ __('Phone') }}</div>
                                        </li>
                                        <li class="list-group-item list-group-item-action ">
                                            <div class="form-group">
                                                <label class="main-content-label h6 font-weight-bold">{{ $setting->where('key', 'phone')->first()->value }}</label>
                                                <label class="tx-success">{{ $form->phone }}</label>
                                                <input wire:keydown.enter="update('{{ $setting->where('key', 'phone')->first()->id }}', 'phone')" class="form-control" type="text" name="phone" wire:model.live='form.phone' placeholder="{{ __('Phone') }}">
                                                @error('form.phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between">
                                            <span class="tx-primary"><i class="ti-bell"></i> <b>Created : </b>{{ $setting->where('key', 'phone')->first()->createdBy->name }} {{ $setting->where('key', 'phone')->first()->created_at }}</span>
                                            <span class="tx-success"><i class="ti-bell"></i> <b>Updated : </b>{{ $setting->where('key', 'phone')->first()->updatedBy?->name }} {{ $setting->where('key', 'phone')->first()->updatedBy != NULL ? $setting->where('key', 'phone')->first()->updated_at : ''}}</span>
                                        </li>

                                    </ol>
                                </div>
                            </div>

                            <div class="card">
                                
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-start">
                                            <div class="mr-3 btn-icon rounded-50 bg-gray-100"><i class="fa fa-envelope"></i></div>
                                            <div class="tx-bold tx-20">{{ __('Email') }}</div>
                                        </li>
                                        <li class="list-group-item list-group-item-action ">
                                            <div class="form-group">
                                                <label class="main-content-label h6 font-weight-bold">{{ $setting->where('key', 'email')->first()->value }}</label>
                                                <label class="tx-success">{{ $form->email }}</label>
                                                <input wire:keydown.enter="update('{{ $setting->where('key', 'email')->first()->id }}', 'email')" class="form-control" type="text" name="email" wire:model.live='form.email' placeholder="{{ __('Email') }}">
                                                @error('form.email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between">
                                            <span class="tx-primary"><i class="ti-bell"></i> <b>Created : </b>{{ $setting->where('key', 'email')->first()->createdBy->name }} {{ $setting->where('key', 'email')->first()->created_at }}</span>
                                            <span class="tx-success"><i class="ti-bell"></i> <b>Updated : </b>{{ $setting->where('key', 'email')->first()->updatedBy?->name }} {{ $setting->where('key', 'email')->first()->updatedBy != NULL ? $setting->where('key', 'email')->first()->updated_at : ''}}</span>
                                        </li>

                                    </ol>
                                </div>
                            </div>

                        </div>



                        <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 p-2">

                            <div class="card">
                                
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-start">
                                            <div class="mr-3 btn-icon rounded-50 bg-gray-100"><i class="fa fa-map-marker"></i></div>
                                            <div class="tx-bold tx-20">{{ __('Address') }}</div>
                                        </li>
                                        <li class="list-group-item list-group-item-action ">
                                            <div class="form-group">
                                                <label class="main-content-label h6 font-weight-bold">{{ $setting->where('key', 'address')->first()->value }}</label>
                                                <label class="tx-success">{{ $form->address }}</label>
                                                <input wire:keydown.enter="update('{{ $setting->where('key', 'address')->first()->id }}', 'address')" class="form-control" type="text" name="address" wire:model.live='form.address' placeholder="{{ __('Address') }}">
                                                @error('form.address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between">
                                            <span class="tx-primary"><i class="ti-bell"></i> <b>Created : </b>{{ $setting->where('key', 'address')->first()->createdBy->name }} {{ $setting->where('key', 'address')->first()->created_at }}</span>
                                            <span class="tx-success"><i class="ti-bell"></i> <b>Updated : </b>{{ $setting->where('key', 'address')->first()->updatedBy?->name }} {{ $setting->where('key', 'address')->first()->updatedBy != NULL ? $setting->where('key', 'address')->first()->updated_at : ''}}</span>
                                        </li>

                                    </ol>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                
                <div class="col-lg-8 col-xl-9"  x-show="settingTab === 'Account' ">
                    <div class="card custom-card">
                        <div class="card-header bg-primary-gradient">
                            <div class="card-title d-flex">
                                <div class="mx-3 btn-icon wd-60 ht-60 rounded-50 bg-gray-100"><i class="fa fa-money-bill"></i></div>	
                                <div class="my-2 tx-28">{{ __('Account') }}</div>	
                            </div>
                            
                        </div>
                    </div>

                    <div class="row my-custom-scrollbar" style="height : calc(100vh - 350px)">
                        <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 p-2">

                            <div class="card">
                                
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
   
                                        <li class="list-group-item list-group-item-action list-group-item-primary d-flex justify-content-start">
                                            <div class="mr-3 btn-icon rounded-50 bg-gray-100"><i class="fa fa-money-bill"></i></div>
                                            <div class="tx-bold tx-20">{{ __('Decimal rounding of prices') }}</div>
                                        </li>
                                        <li class="list-group-item list-group-item-action ">
                                            <div class="form-group">
                                                <label class="main-content-label h6 font-weight-bold">{{ $setting->where('key', 'price')->first()->value }}</label>
                                                <label class="tx-success">{{ $form->price }}</label>
                                                <input wire:keydown.enter="update('{{ $setting->where('key', 'price')->first()->id }}', 'price')" class="form-control" type="text" name="price" wire:model.live='form.price' placeholder="{{ __('Decimal rounding of prices') }}">
                                                @error('form.price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                            </div>
                                        </li>
                                        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between">
                                            <span class="tx-primary"><i class="ti-bell"></i> <b>Created : </b>{{ $setting->where('key', 'price')->first()->createdBy->name }} {{ $setting->where('key', 'price')->first()->created_at }}</span>
                                            <span class="tx-success"><i class="ti-bell"></i> <b>Updated : </b>{{ $setting->where('key', 'price')->first()->updatedBy?->name }} {{ $setting->where('key', 'price')->first()->updatedBy != NULL ? $setting->where('key', 'price')->first()->updated_at : ''}}</span>
                                        </li>

                                    </ol>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 p-2">

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


</div>
