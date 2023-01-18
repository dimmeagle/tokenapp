@extends('layouts.app')
@if(Session::has('message'))
    <p class="alert alert-info">
        @foreach(explode('<br>', session('message')) as $msg)
            {{ $msg }}
            @if(!$loop->last)
                <br>
            @endif
        @endforeach
    </p>
@endif
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Request records list</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Request data</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody class="align-content-md-center">
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->user_id }}</td>
                    <td>{{ unserialize($record->request_data) }}</td>
                    <td>{{ $record->created_at }}</td>
                    <td>{{ $record->updated_at }}</td>
                    <td align="center">
                        <form method="GET" action="{{ route('records.edit',$record) }}">
                            @csrf
                            <button name="sumbit" class="btn btn-primary">Change</button>
                        </form>
                    </td>
                    <td align="center">
                        <form method="POST" action="{{ route('records.destroy',$record) }}">
                            @csrf
                            @method('DELETE')
                            <button name="sumbit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('data.create') }}" mehod="POST">
            <button name="sumbit" class="btn btn-primary">Add new record</button>
        </form>
    </div>
@endsection
