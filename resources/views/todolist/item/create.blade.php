@extends('layouts.app')

@section('content')
    <h1>Nieuw item toevoegen aan {{ request('todoList')->name }}</h1>

    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form method="post" enctype="multipart/form-data" accept-charset="utf-8">

        @csrf

        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" id="name" class="form-control" name="name" value="{{ old('name', '') }}" placeholder="Naam...">
        </div>

        <button class="btn btn-primary">Opslaan</button>
    </form>
@endsection