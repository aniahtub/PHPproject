@extends('layouts.app')
@section('title')
Single Todo:{{$todo->name}}
@endsection
@section('content')
<h1 class="text-center my-5" style="text-shadow:0 0.3rem 0.5rem rgb(0 0 0 / 30%);">
    {{$todo->name}}
</h1>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                Details
            </div>
            <div class="card-body">
                {{$todo->description}}
            </div>
        </div>
        <a href="/todo/{{$todo->id}}/delete" class="btn btn-sm btn-danger float-right m-2">Delete</a>
        <a href="/todo/{{$todo->id}}/edit" class="btn btn-sm btn-info float-right my-2">Edit</a>
    </div>
</div>
@endsection