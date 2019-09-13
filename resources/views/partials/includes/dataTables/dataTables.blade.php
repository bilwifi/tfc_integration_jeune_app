@push('stylesheets')
    <link href="{{ asset('dataTables/dataTables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('dataTables/bootstrap3/datatables.css') }}" rel="stylesheet"> --}}
    <style type="text/css">
    	.commentaireDatatable{
    		max-width: 100px;
    		max-height: 10px;
    	}
    </style>
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
@endpush

@push('scripts')

<script src={{ asset('dataTables/datatables.min.js') }}></script> 

@endpush