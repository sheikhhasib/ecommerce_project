@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Create Time</th>
                            <th>Update At</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_users as $user)



                            
                            <tr>
                            <th>{{ $user->name }}</th>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
