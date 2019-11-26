<div class="form-group">
<label>{{ __('common.title') }} *</label>
<input type="text" class="form-control" name="title" value="{{ $record->title or null }}" required>
</div>

<div class="form-group">
<label>{{ __('common.description') }}</label>
<textarea class="editable" name="description">{{ $record->description or null }}</textarea>
</div>

<div class="form-group">
<label>{{ __('common.sort') }}</label>
<input type="number" class="form-control" name="sort" value="{{ $record->sort or null }}">
</div>

<div class="form-group">
<label>{{ __('common.language') }}</label><br>
{{ Form::select('language', config('pcbs.languages'), isset($record->language) ? $record->language : " ", ['class' => 'form-control', 'data-width' => '100%']) }}
</div>

@push('plugins')
	@include('common.plugins')
@endpush