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

<div class="form-group">
	<label>Geo_Code</label>
	<input type="text" class="form-control" name="sort" value="{{ $record->geo_code or null }}">
</div>


<div class="form-group">
	<label>Geojson</label>
	<input type="file" class="form-control" name="geojson">
</div>

@if(isset($record->geojson))

	<p><a href="/storage/geojsons/{{ $record->geojson }}" width="64">{{ __('common.downloadfile') }}</a></p>

@endif

<div class="row">

	<div class="col-md-6">
		<div class="form-group">
			<label>{{ __('common.latitude') }}</label>
			<input type="text" class="form-control" name="latitude" value="{{ $record->latitude or null }}">
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label>{{ __('common.longitude') }}</label>
			<input type="text" class="form-control" name="longitude" value="{{ $record->longitude or null }}">
		</div>
	</div>

</div><!--Row-->

<label>{{ __('common.language') }}</label><br>

<div class="radio">
	<label for="English"><input type="radio" id="English" value="en" name="language" {{ isset($record->language) && $record->language == 'en' ? "checked" : ""}}> English</label>
</div>

<div class="radio">
	<label for="Arabic"><input type="radio" id="Arabic" value="ar" name="language" {{ isset($record->language) && $record->language == 'ar' ? "checked" : ""}}> العربية</label>
</div>