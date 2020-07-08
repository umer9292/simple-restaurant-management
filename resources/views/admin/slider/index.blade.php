@extends('layouts.app')

@section('title', 'Slider')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('admin.partial.message')

                    <a href="{{route('slider.create')}}" class="btn btn-primary">Add New Slider</a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">All Slider</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table"  style="width:100%">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Sub Title</th>
                                            <th>Image</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($sliders->count() > 0)
                                            @foreach($sliders as $slider)
                                                <tr>
                                                    <td>{{$slider->id}}</td>
                                                    <td>{{$slider->title}}</td>
                                                    <td>{{$slider->sub_title}}</td>
                                                    <td>{{$slider->image}}</td>
                                                    <td>{{$slider->created_at}}</td>
                                                    <td>{{$slider->updated_at}}</td>
                                                    <td>
                                                        <a href="{{route('slider.edit', $slider->id)}}" class="btn btn-sm btn-info">
                                                            <i class="material-icons">mode_edit</i>
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="if(confirm('Are you sure? You want to delete this?')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{$slider->id}}').submit();
                                                            } else {
                                                                event.preventDefault();

                                                                }"
                                                        >
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                        <form id="delete-form-{{$slider->id}}"
                                                              action="{{route('slider.destroy', $slider->id)}}"
                                                              method="post"
                                                              style="display: none"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{--    https://code.jquery.com/jquery-3.5.1.js--}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="hhttps://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
