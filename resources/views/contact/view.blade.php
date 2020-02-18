@extends('layouts/app');

@section('content')

{{--    @php--}}
{{--        error_reporting(0);--}}
{{--    @endphp--}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-center">
                        Product List
                    </div>
                    <div class="card-body">
                        @if(session('deletestatus'))
                            <div class="alert alert-danger">
                                {{ session('deletestatus') }}
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr class="bg-dark text-light">
                                <th scope="col">Sl. No.</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
{{--                                <th scope="col">Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($contactmessages as $contactmessage)
                                <tr class="{{($contactmessage->read_status==1)?"bg-info":""}}">
                                    <td>{{$loop->index +1}}</td>
                                    {{-- <td>{{App\Category::find($product->category_id)->category_name}}</td> --}}
                                    <td>{{ $contactmessage->first_name}}</td>
                                    <td>{{ $contactmessage->last_name}}</td>
                                    <td>{{ $contactmessage->subject}}</td>
                                    <td>{{ $contactmessage->message}}</td>
{{--                                    <td>--}}
{{--                                        <div class="btn-group hidden-xs" role="group">--}}
{{--                                            <a href="{{ url('delete/product') }}/ {{$product->id}}" class="btn btn-sm btn-danger">Delete</a>--}}
{{--                                            <a href="{{ url('edit/product') }}/ {{$product->id}}" class="btn btn-sm btn-warning">Edit</a>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @empty
                                <tr class="text-center text-danger">
                                    <td colspan="9">No data Available</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
{{--                        {{$products->links()}}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection()
