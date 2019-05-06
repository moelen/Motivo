@php /** @var $todolist \App\Entities\Todolists\TodoList */ @endphp

@extends('layouts.app')

@section('content')
    <h3>Todo Lijst</h3>
    <h1>{{ $todolist->name }}</h1>

    <a href="{{ route('todolist.item.create', ['todoList' => $todolist]) }}" class="btn btn-primary mb-3">Nieuwe item</a>

    <table class="table table-striped table-hover" id="sortableItems">
        <thead>
            <tr>
                <th>Item</th>
                <th>Labels</th>
                <th>Bijlagen</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($todolist->activeItems as $item)
                @php /** @var $item \App\Entities\Todolists\Item */ @endphp
                <tr data-id="{{ $item->id }}">
                    <td>{{ $item->name }}</td>
                    <td>
                        @foreach($item->labels as $label)
                            @php /** @var $label \App\Entities\Labels\Label */ @endphp
                            <span class="badge badge-pull badge-primary">{{ ucfirst($label->name) }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach($item->attachments as $attachment)
                            @php /** @var $attachment \App\Entities\Attachments\Attachment */ @endphp
                            <a href="{{ route('attachment.download', ['attachment' => $attachment]) }}">{{ $attachment->name }}</a> <br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('todolist.item.delete', ['todoList' => $todolist, 'item' => $item]) }}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($todolist->snoozedItems()->count() > 0)
        <a class="btn btn-primary" data-toggle="collapse" href="#snoozedItems" role="button" aria-expanded="false" aria-controls="snoozedItems">
            Gesnoozede items
        </a>

        <div class="collapse" id="snoozedItems">
            <div class="card card-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Labels</th>
                        <th>Bijlagen</th>
                        <th>Zichtbaar vanaf</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($todolist->snoozedItems as $item)
                            @php /** @var $item \App\Entities\Todolists\Item */ @endphp
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @foreach($item->labels as $label)
                                        @php /** @var $label \App\Entities\Labels\Label */ @endphp
                                        <span class="badge badge-pull badge-primary">{{ ucfirst($label->name) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($item->attachments as $attachment)
                                        @php /** @var $attachment \App\Entities\Attachments\Attachment */ @endphp
                                        <a href="{{ route('attachment.download', ['attachment' => $attachment]) }}">{{ $attachment->name }}</a> <br>
                                    @endforeach
                                </td>
                                <td>{{ $item->display_after->format('d-m-Y, h:m') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <script>
        $(function() {

            /**
             * Get the form data to be submitted.
             *
             * @returns {Array}
             */
            getFormData = function() {
                let data = [];

                $('#sortableItems tbody tr').each(function() {
                    data[$(this).data('id')] = $(this).index();
                });

                return data;
            };

            /**
             * Submit post request to update order.
             */
            updateOrder = function() {
                $.ajax({
                    type: 'POST',
                    url: '/todolist/{{ $todolist->id }}/item/order',
                    data: {
                        _token: '{{ csrf_token() }}',
                        items:  getFormData(),
                    },
                })
            };

            /**
             * Add sortable listener to the table.
             */
            $('#sortableItems tbody').sortable({
                stop: updateOrder
            });
        });
    </script>
@endpush