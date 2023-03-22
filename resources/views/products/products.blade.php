@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Products</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

<div class="row">
    <!--/div-->


    <!--div-->
   <!-- Button trigger modal -->
   <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
          @include('products.create')
      <br><br>
      {{-- @include('sections.create') --}}
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th class="border-bottom-0">#</th>
                <th class="border-bottom-0">Product Name</th>
                <th class="border-bottom-0">Section Name</th>
                <th class="border-bottom-0">Description </th>
                <th class="border-bottom-0">Created By </th>
                <th class="border-bottom-0">Process </th>
            </tr>
        </thead>
        @foreach ($products as $product)
        <tbody>
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->section->section_name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->Created_by}}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#EditProducts{{$product->id}}">
                        <i class="fa fa-edit"></i>
                       </button>
                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteProducts{{$product->id}}">
                        <i class="fa-solid fa-trash"></i>
                       </button>
                  </td>
            </tr>
           @include('products.edit')
           @include('products.delete')
        </tbody>
        @endforeach
      </table>
    <!--/div-->


</div>
</div>
<!-- row closed -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
