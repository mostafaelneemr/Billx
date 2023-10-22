@if($errors->any())
    <div class="alert alert-custom alert-danger fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        @foreach($errors->all() as $error)
            <div class="alert-text">{{$error}}</div>
        @endforeach
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@elseif(Session::has('status'))
    <div class="alert alert-custom alert-success fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ Session::get('status') }}</div>
        <div class="alert-close">
            {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
                {{-- <span aria-hidden="true"><i class="la la-close"></i></span> --}}
            </button>
        </div>
    </div>
@endif