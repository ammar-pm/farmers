<div class="form-group">
	<label>{{ __('common.title') }}</label>
	<input type="text" class="form-control" name="title" value="{{ $record->title or null }}">
</div>

<div class="form-group">
	<label>{{ __('common.description') }}</label>
	<textarea class="form-control" name="description" rows="3">{{ $record->description or null }}</textarea>
</div>

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