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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">JSON data receiver</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('input') }}">
                            @csrf

                            <div class="row mb-4">
                                <label for="jsondata" class="col-md-4 col-form-label text-md-end">JSON data</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('jsondata') is-invalid @enderror" id="jsondata" rows="6" name="jsondata" value="{{ old('jsondata') }}" placeholder="{{ old('jsondata') }}" autofocus></input>
                                    @error('jsondata')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
