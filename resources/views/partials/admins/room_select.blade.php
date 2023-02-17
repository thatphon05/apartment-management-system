<select onchange="inputChange(event)"
        class="form-select @error('room_id') is-invalid @enderror"
        name="room_id">
    <option value="0">โปรดเลือกห้อง</option>
    @foreach($rooms as $room)
        <option value="{{ $room->id }}"
            @selected(request()->query('room') == $room->id)
            @selected(old('room_id') == $room->id)
        >
            อาคาร {{ $room->floor->building->name }}
            ชั้น {{ $room->floor->name }} ห้อง {{ $room->name }}
        </option>
    @endforeach
</select>
@error('room_id')
<div class="invalid-feedback">{{ $message }}</div> @enderror
