@extends('layouts.app')
@section('title')
Create Todo
@endsection
@section('content')
<h1 class="text-center my-5" style="text-shadow:0 0.3rem 0.5rem rgb(0 0 0 / 30%);">Create Todo</h1>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                Create new Todo
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                        <li class="list-group-item">
                            {{$error}}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="store-todo" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="description" id="5" rows="5"
                            placeholder="Description"></textarea>
                    </div>
                    <div class="form-group text-center m-0">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection