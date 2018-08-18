<select class="form-control select2" name="{{ $row->field }}">
    <?php $default = null; $selected_value = null; ?>
    @if(isset($items))
        @foreach($items as $item)
            <option value="{{ $item->id }}" @if($default == $item->id && $selected_value === NULL){{ 'selected="selected"' }}@endif @if($selected_value == $item->id){{ 'selected="selected"' }}@endif>{{ $item->title }}</option>
        @endforeach
    @endif
</select>