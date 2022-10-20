@extends('layouts.default')
@section('content')
    <div class="container w-25 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>To-do List</h3>
                <form action="/todo/store" method="POST" autocomplete="off">
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Add your new todo">
                        <button type="submit" class="btn btn-dark btn-sm px-4">Add<i class="fas fa-plus"></i></button>
                    </div>
                </form>
                {{-- if tasks count --}}
                @if (count($items))
                    <ul class="list-group list-group-flush mt-3">
                        @foreach ($items as $item)

                            <li class="list-group-item">
                                <form action="/todo/delete/{{$item->id}}" method="POST">

                                    {{$item->name}}

                                    <button style='font-size:10px' type="submit" class="btn btn-dark btn-sm float-end ">delete</button>

                                </form>
                                <form action="/todo/update/{{$item->id}}" method="GET">
                                    @if($item->done==true)
                                        <input  type="checkbox" checked>
                                    @else
                                        <input  type="checkbox">
                                    @endif
                                        <button style='font-size:10px' type="submit" class="btn btn-dark btn-sm float-end ">change</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center mt-3">No Tasks!</p>
                @endif
            </div>
            @if (count($items))
                <div class="card-footer">
                    You have {{ count($items) }} pending tasks
                </div>
            @else

            @endif

            </div>

        </div>

@stop
