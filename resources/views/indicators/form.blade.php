<div class="form-group">
	<label>{{ __('common.title') }}</label>
	<input type="text" class="form-control" name="title" value="{{ $record->title or null }}">
</div>

<div class="form-group">
	<label>{{ __('common.value') }}</label>
	<input type="text" class="form-control" name="value" value="{{ $record->value or null }}">
</div>

<div class="form-group">
	<label>{{ __('common.icon') }} <small>SVG or PNG</small></label>
	<input type="file" class="form-control" name="icon">
</div>

@if(isset($record->icon))

<p><img src="/storage/icons/{{ $record->icon }}" width="64"></p>

@endif


<div class="form-group">
	<label>{{ __('common.sort') }}</label>
	<input type="text" class="form-control" name="sort" value="{{ $record->sort or null }}">
</div>

<label>{{ __('common.language') }}</label><br>

<div class="radio">
	<label for="English"><input type="radio" id="English" value="en" name="language" {{ isset($record->language) && $record->language == 'en' ? "checked" : ""}}> English</label>
</div>

<div class="radio">
	<label for="Arabic"><input type="radio" id="Arabic" value="ar" name="language" {{ isset($record->language) && $record->language == 'ar' ? "checked" : ""}}> العربية</label>
</div>