@extends('layout.master')

@section('title')
    Edit Customer
@endsection

@section('content')
    @include('message')

    <!--begin::Row-->
    <div class="card">
        <div class="card-body">
            <div class="k-portlet__body">
                <div id="form-alert-message"></div>

                <form action="{{route('customers.update', $customer->id)}}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Customer Name<span class="text-danger">*</span> </label>
                            <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required />
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Customer Email<span class="text-danger">*</span> </label>
                            <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required />
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Address<span class="text-danger">*</span> </label>
                            <input type="text" name="address" value="{{ $customer->address }}" class="form-control" required />
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label>City</label>
                            <input type="text" name="city" value="{{ $customer->city }}" class="form-control" />
                            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Phone<span class="text-danger">*</span> </label>
                            <input type="number" name="phone" value="{{ $customer->phone }}" class="form-control" required />
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="exampleSelect2">Gender<span class="text-danger">*</span> </label>
                        <select class="form-control" name="gender" id="exampleSelect2" required>
                            <option value="" selected disabled></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label>Details</label>
                        <textarea name="details" class="form-control" id="details" rows="4">{!! $customer->details !!}</textarea>
                        @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-3 col-12 offset-md-9">
                                <button type="submit" class="btn btn-block btn-dark-75 waves-effect">{{ __('Save')  }}</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>

    <script type="text/javascript">

        $('select').select2({
            placeholder: "{{__('Select Gender')}}",
            allowClear: true,
            width:"100%",
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    
    <script type="text/javascript">
       $(document).ready(function () {
           CKEDITOR.replace('details');
       });
   </script>

@endsection
