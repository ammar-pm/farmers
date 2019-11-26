
	{{ csrf_field() }}

	<div class="form-group">
		<label>{{ __('common.name') }} *</label>
		<input type="text" name="name" class="form-control" value="{{ $record->name or null }}" required>
	</div>

	<div class="form-group">
		<label for="org_name">org_name</label>
		<input name="org_name" type="text" class="form-control" id="org_name" value="{{ $record->org_name or null }}" >
	</div>

	<div class="form-group">
		<label>data_use*</label><br>
    <input type="radio" name="data_use" value="personal" {{(isset($record->data_use) && $record->data_use == 'personal')?'checked':''}}> Personal<br>
    <input type="radio" name="data_use" value="organisation" {{(isset($record->data_use) && $record->data_use == 'organisation')?'checked':''}}> Organisation<br>
</div>

<div class="form-group">
    <label>type_of_org*</label><br>
    <input type="radio" name="type_of_org" value="governmental"  {{(isset($record->type_of_org) && $record->type_of_org == 'governmental')?'checked':''}}> Governmental<br>
    <input type="radio" name="type_of_org" value="civil"  {{(isset($record->type_of_org) && $record->type_of_org == 'civil')?'checked':''}}> civil<br>
    <input type="radio" name="type_of_org" value="private_sector"  {{(isset($record->type_of_org) && $record->type_of_org == 'private_sector')?'checked':''}}> Private Sector<br>
    <input type="radio" name="type_of_org" value="international"  {{(isset($record->type_of_org) && $record->type_of_org == 'international')?'checked':''}}> international<br>
    <input type="radio" name="type_of_org" value="studies_research"  {{(isset($record->type_of_org) && $record->type_of_org == 'studies_research')?'checked':''}}> Studies/Research<br>
</div>

<div class="form-group">
    <label for="address">address</label>
    <input name="address" type="text" class="form-control" id="address" value="{{ $record->address or null }}">
</div>

<div class="form-group">
    <label for="tel">tel</label>
    <input name="tel" type="text" class="form-control" id="tel" value="{{ $record->tel or null }}">
</div>

<div class="form-group">
    <label for="fax">fax</label>
    <input name="fax" type="text" class="form-control" id="fax" value="{{ $record->fax or null }}">
</div>

<div class="form-group">
    <label for="email">email</label>
    <input name="email" type="email" class="form-control" id="email" value="{{ $record->email or null }}">
</div>

<div class="form-group">
    <label>Filed of use of data*</label><br>
    <input type="radio" name="field_of_use_data" value="scientific_research_purposes" {{(isset($record->field_of_use_data) && $record->field_of_use_data == 'scientific_research_purposes')?'checked':''}}> Scientific Research Purposes <br>
    <input type="radio" name="field_of_use_data" value="commerical_use" {{(isset($record->field_of_use_data) && $record->field_of_use_data == 'commerical_use')?'checked':''}}> Commerical Use <br>
    <input type="radio" name="field_of_use_data" value="organization_work_purposes" {{(isset($record->field_of_use_data) && $record->field_of_use_data == 'organization_work_purposes')?'checked':''}}> Organization  Work purposes <br>
</div>

<div class="form-group">
    <label>How would you like to receive PCBS response *</label><br>
    <input type="radio" name="response_type" value="via_fax" {{(isset($record->response_type) && $record->response_type == 'via_fax')?'checked':''}}> Via Fax <br>
    <input type="radio" name="response_type" value="via_postal_address" {{(isset($record->response_type) && $record->response_type == 'via_postal_address')?'checked':''}}> Via postal address <br>
    <input type="radio" name="response_type" value="in_person" {{(isset($record->response_type) && $record->response_type == 'in_person')?'checked':''}}> in person <br>
    <input type="radio" name="response_type" value="via_email" {{(isset($record->response_type) && $record->response_type == 'via_email')?'checked':''}}> Via _email <br>
</div>

<div class="form-group">
    <label>In order to best fulfill your request, please detail the services you like to recieve *</label>
    <textarea name="comments" class="form-control" required>{{ $record->comments or null }} </textarea>
</div>

<div class="form-group">
    <label for="signature">signature</label>
    <input name="signature" type="text" class="form-control" id="signature"  value="{{ $record->signature or null }}">
</div>

<div class="form-group">
    <label for="signature_date">signature_date</label>
    <input type="date" id="signature_date" name="signature_date"
           value="{{ $record->signature_date or '2019-01-01' }}"
           min="2019-01-01">
</div>

<div class="form-group">
    <label for="signature_time">signature_time</label>
    <input type="time" id="signature_time" name="signature_time"
           min="9:00" max="18:00" value="{{ $record->signature_time or '13:30' }}">
</div>

<div class="form-group">
        <label>reply to the message via email *</label>
        <textarea name="reply_message" class="form-control" required> {{ $record->reply_message or null }} </textarea>
</div>


@if(!empty($record->id))
@php
echo '<ul class="alert alert-info list-unstyled">';
  foreach ($record->location_api_result as $key => $value) {
  if ($key != 'location'){
   echo '<li>' .$key . ':' . $value ."</li>";
  }
  }
echo '</ul>';
@endphp
@endif






