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

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="date">Datum</label>
                    <input type="date" id="date" class="form-control" name="date" value="{{ old('date', '') }}">
                </div>
                <div class="col">
                    <label for="hour">Uur</label>
                    <select name="hour" id="hour" class="form-control">
                        @for($i = 1; $i <= 24; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col">
                    <label for="min">Minuten</label>
                    <select name="min" id="min" class="form-control">
                        @for($i = 0; $i < 60; $i += 5)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <button class="btn btn-primary">Opslaan</button>
    </form>
@endsection