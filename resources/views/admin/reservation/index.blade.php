@extends('layouts.app')

@section('title', 'Reservation')

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

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Reservations</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table"  style="width:100%">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Time and Date</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($reservations->count() > 0)
                                            @foreach($reservations as $reservation)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$reservation->name}}</td>
                                                    <td>{{$reservation->phone}}</td>
                                                    <td>{{$reservation->email}}</td>
                                                    <td>{{$reservation->date_and_time}}</td>
                                                    <td>{{$reservation->message}}</td>
                                                    <td>
                                                        @if($reservation->status == true)
                                                            <span class="badge badge-info">Confirm</span>
                                                        @else
                                                            <span class="badge badge-danger">not confirm yet</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$reservation->created_at}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="if(confirm('Are you sure? You want to delete this?')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{$reservation->id}}').submit();
                                                            } else {
                                                                event.preventDefault();

                                                                }"
                                                        >
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                        <form id="delete-form-{{$reservation->id}}"
                                                              action="{{route('item.destroy', $reservation->id)}}"
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
