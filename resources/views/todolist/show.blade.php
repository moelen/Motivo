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
            @foreach($todolist->activeItems as $item)
                @php /** @var $item \App\Entities\Todolists\Item */ @endphp
                <tr>
                    <td>{{ $item->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a class="btn btn-primary" data-toggle="collapse" href="#snoozedItems" role="button" aria-expanded="false" aria-controls="snoozedItems">
        Gesnoozede items
    </a>

    <div class="collapse" id="snoozedItems">
        <div class="card card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Item</th>
                    <th>Zichtbaar vanaf</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($todolist->snoozedItems as $item)
                        @php /** @var $item \App\Entities\Todolists\Item */ @endphp
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->display_after->format('d-m-Y, h:m') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection