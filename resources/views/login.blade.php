@extends('layouts.default')
@section('content')
    <div class="container w-25 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>Login</h3>
                <form action="/todo/login" method="POST" autocomplete="off">

                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div>
                        <input type="text" name="password" class="form-control" placeholder="Password">

                    </div>
                    <div><button type="submit" class="btn btn-dark btn-sm px-4">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
@stop
