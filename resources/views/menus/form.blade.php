<div class="form-group">
<label>{{ __('common.title') }} *</label>
<input type="text" class="form-control" name="title" value="{{ $record->title or null }}" required>
</div>

<div class="form-group">
<label>{{ __('common.link') }} *</label>
<input type="text" class="form-control" name="link" value="{{ $record->link or null }}" required>
</div>


<div class="form-group">
<label>{{ __('common.sort') }}</label>
<input type="number" class="form-control" name="sort" value="{{ $record->sort or null }}">
</div>

<label>{{ __('common.location') }}</label><br>

<div class="radio">
	<label for="Header"><input type="radio" id="Header" value="header" name="location" {{ isset($record->location) && $record->location == 'header' ? "checked" : ""}}> Header</label>
</div>

<div class="radio">
	<label for="Footer"><input type="radio" id="Footer" value="footer" name="location" {{ isset($record->location) && $record->location == 'footer' ? "checked" : ""}}> Footer</label>
</div>

<label>{{ __('common.language') }}</label><br>

<div class="radio">
	<label for="English"><input type="radio" id="English" value="en" name="language" {{ isset($record->language) && $record->language == 'en' ? "checked" : ""}}> English</label>
</div>

<div class="radio">
	<label for="Arabic"><input type="radio" id="Arabic" value="ar" name="language" {{ isset($record->language) && $record->language == 'ar' ? "checked" : ""}}> العربية</label>
</div>