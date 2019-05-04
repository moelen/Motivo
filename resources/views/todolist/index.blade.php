@extends('layouts.app')

@section('content')
    <h1>Todo Lijsten</h1>

    <a href="{{ route('todolist.create') }}" class="btn btn-primary mb-3">Nieuwe Lijst</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="col">Naam</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todolists as $list)
                <tr>
                    <td>{{ $list->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection