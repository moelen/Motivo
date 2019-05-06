@php /** @var $item \App\Entities\Todolists\Item */ @endphp
@php /** @var $todoList \App\Entities\Todolists\TodoList */ @endphp

@extends('layouts.app')

@section('content')
    <h1>{{ $item->name }}</h1>

    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form method="post" enctype="multipart/form-data" accept-charset="utf-8">

        @include('todolist.item.partials.form')

        @if($item->attachments()->count() > 0)
            <ul class="list-group mb-3">
                @foreach($item->attachments as $attachment)
                    <li class="list-group-item">
                        <a href="{{ route('attachment.download', ['attachment' => $attachment]) }}">{{ $attachment->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <button class="btn btn-primary">Opslaan</button>
    </form>
@endsection