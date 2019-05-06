@php /** @var $item \App\Entities\Todolists\Item */ @endphp

@csrf

<div class="form-group">
    <label for="name">Naam</label>
    <input type="text" id="name" class="form-control" name="name" value="{{ old('name', isset($item) ? $item->name : '' ) }}" placeholder="Naam...">
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="date">Datum</label>
            <input type="date" id="date" class="form-control" name="date" value="{{ old('date', isset($item->display_after) ? $item->display_after->format('Y-m-d') : '' ) }}">
        </div>
        <div class="col">
            <label for="hour">Uur</label>
            <select name="hour" id="hour" class="form-control">
                @for($i = 1; $i <= 24; $i++)
                    <option value="{{ $i }}" @if(old('hour', isset($item->display_after) ? $item->display_after->format('h') : '' ) == $i){{ 'SELECTED' }}@endif>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col">
            <label for="min">Minuten</label>
            <select name="min" id="min" class="form-control">
                @for($i = 0; $i < 60; $i += 5)
                    <option value="{{ $i }}"  @if(old('min', isset($item->display_after) ? $item->display_after->format('i') : '' ) == $i){{ 'SELECTED' }}@endif>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="labels">Labels</label>
    <input type="text" name="labels" class="form-control" placeholder="Labels, gescheiden met een comma"
           value="{{ old('labels', isset($item) ? implode(',', $item->labels->pluck('name')->toArray()) : '' ) }}">
</div>

<div class="form-group">
    <label for="attachments">Bijlagen</label>
    <input type="file" multiple="multiple" name="attachments[]" class="form-control-file">
    <small class="form-text text-muted">
        Selecteer 1 of meerdere bestanden.
    </small>
</div>