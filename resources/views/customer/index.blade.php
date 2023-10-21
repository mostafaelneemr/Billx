@extends('layout.master')

@section('style')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Customers
@endsection

@section('content')

    {{-- @include('message') --}}

<!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">Projects
            </div>
            <div class="card-toolbar">
                <a href="{{ route('customers.create') }}" class="btn btn-success">Add Customer </a>
            </div>
        </div>

        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="table_id">
                <thead>
                <tr>
                    <th>customer name</th>
                    <th>customer address</th>
                    <th>customer phone</th>
                    <th>customer gender</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/js/pages/crud/datatables/basic/paginations.js')}}"></script>



    
@endsection

@push('js')
<script type="text/javascript">
    function deleteCustomer($routeName,$reload){

        if(!confirm("Do you want to delete this Customer?")){ return false; }

        if($reload == undefined){ $reload = 3000; }
        addLoading();

        $.post(
            $routeName,
            {
                '_method':'DELETE',
                '_token':$('meta[name="csrf-token"]').attr('content')
            },
            function(response){
                removeLoading();
                if(isJSON(response)){
                    $data = response;
                    if($data.status == true){
                        toastr.success($data.message, 'Success !', {"closeButton": true});
                        $('#table_id').DataTable().ajax.reload();
                    }else{
                        toastr.error($data.message, 'Error !', {"closeButton": true});
                    }
                }
            }
        )
    }
</script>

<script type="text/javascript">
    $(function () {

        $datatable = $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "DESC"],
            ],
            "pageLength": 25,
            ajax: "{{ Route('customers.index', ['datatable' => true]) }}",
            columns: [
                { data:'name', },
                { data:'address', },
                { data:'phone', },
                { data:'gender', },
                { data:'action', },
            ],
        });

    });
</script>
@endpush