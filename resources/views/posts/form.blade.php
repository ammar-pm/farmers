<div class="form-group">
	<label>{{ __('common.title') }} *</label>
	<input type="text" class="form-control" name="title" value="{{ $record->title ?? '' }}" required>
</div>

<div class="form-group">
	<label>Related title *</label>
@if(isset($lang_records))
<select class="form-control" name="related_id">
	<option value='' selected></option>
	@foreach($lang_records  as $rec)
		<option  value='{{ $rec->id }}' {{ ($rec->id  == $record->related_id)? 'SELECTED' : '' }} >{{ $rec->title }}</option>
	@endforeach
</select>
@endif
</div>

<div class="form-group">
	<label>{{ __('common.subline') }}</label>
	<input type="text" class="form-control" name="subline" value="{{ $record->subline ?? '' }}">
</div>

<div class="form-group">
	<label>{{ __('common.summary') }}</label>
	<textarea class="form-control" name="summary">{{ $record->summary ?? '' }}</textarea>
</div>

<div class="form-group">
	<label>{{ __('common.description') }}</label>
	<textarea class="editable" name="description">{{ $record->description ?? '' }}</textarea>
</div>


<div class="form-group">
	<label>{{ __('common.image') }}</label>
	<input type="file" class="form-control" name="image">
</div>

@if(isset($record->image))

<p><img src="/storage/images/{{ $record->image }}" width="102"></p>

@endif


<label>{{ __('common.type') }}</label><br>

<div class="radio">
	<label for="Stories"><input type="radio" id="Stories" value="stories" name="type" {{ isset($record->type) && $record->type == 'stories' ? "checked" : ""}}> {{ __('common.stories') }}</label>
</div>

<div class="radio">
	<label for="News"><input type="radio" id="News" value="news" name="type" {{ isset($record->type) && $record->type == 'news' ? "checked" : ""}}> {{ __('common.news') }}</label>
</div>

<div class="radio">
	<label for="Pages"><input type="radio" id="Pages" value="pages" name="type" {{ isset($record->type) && $record->type == 'pages' ? "checked" : ""}}> {{ __('common.pages') }}</label>
</div>

<div class="radio">
	<label for="Topics"><input type="radio" id="Topics" value="topics" name="type" {{ isset($record->type) && $record->type == 'topics' ? "checked" : ""}}> {{ __('common.topics') }}</label>
</div>

<div class="checkbox">
<input type="hidden" name="public" value="0">
<label><input type="checkbox" name="public" value="1" {{ isset($record->public) && $record->public == 1 ? "checked" : ""}}> {{ __('common.public') }} </label>
</div>

<div class="checkbox">
<input type="hidden" name="featured" value="0">
<label><input type="checkbox" name="featured" value="1" {{ isset($record->featured) && $record->featured == 1 ? "checked" : ""}}> {{ __('common.featured') }} </label>
</div>

<div class="checkbox">
<input type="hidden" name="comments" value="0">
<label><input type="checkbox" name="comments" value="1" {{ isset($record->comments) && $record->comments == 1 ? "checked" : ""}}> {{ __('common.comments') }} </label>
</div>

<label>{{ __('common.language') }}</label><br>

<div class="radio">
	<label for="English"><input type="radio" id="English" value="en" name="language" {{ isset($record->language) && $record->language == 'en' ? "checked" : ""}}> English</label>
</div>

<div class="radio">
	<label for="Arabic"><input type="radio" id="Arabic" value="ar" name="language" {{ isset($record->language) && $record->language == 'ar' ? "checked" : ""}}> العربية</label>
</div>


@push('plugins')
	@include('common.plugins')
@endpush

