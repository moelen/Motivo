@php /** @var $todolist \App\Entities\Todolists\TodoList */ @endphp

@extends('layouts.app')

@section('content')
    <h3>Todo Lijst</h3>
    <h1>{{ $todolist->name }}</h1>

    <a href="{{ route('todolist.item.create', ['todoList' => $todolist]) }}" class="btn btn-primary mb-3">Nieuwe item</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="col">Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todolist->items as $item)
                @php /** $var $item \App\Entities\Todolists\Item */ @endphp
                <tr>
                    <td>{{ $item->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection