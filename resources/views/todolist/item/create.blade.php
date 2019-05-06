@extends('layouts.app')

@section('content')
    <h1>Nieuw item toevoegen aan {{ request('todoList')->name }}</h1>

    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form method="post" enctype="multipart/form-data" accept-charset="utf-8">

        @include('todolist.item.partials.form')

        <button class="btn btn-primary">Opslaan</button>
    </form>
@endsection