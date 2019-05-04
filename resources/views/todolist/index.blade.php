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
                <tr data-link="{{ route('todolist.show', ['todoList' => $list ]) }}">
                    <td>{{ $list->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('js')
    <script>
        $(function() {
            /**
             * Listener for redirect on click table row.
             */
            $('body').on('click', '.table tr', function () {
                var url = $(this).data('link');

                if (url != undefined) {
                    window.location = url;
                }
            });
        });
    </script>
@endpush