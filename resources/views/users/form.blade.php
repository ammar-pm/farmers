<div class="form-group">
	<label>{{ __('common.name') }}</label>
	<input type="text" class="form-control" name="name" value="{{ $user->name or null }}">
</div>

<div class="form-group">
	<label>{{ __('common.email') }}</label>
	<input type="text" class="form-control" name="email" value="{{ $user->email or null }}">
</div>


<div class="form-group">
<label>{{ __('common.language') }}</label><br>
{{ Form::select('language', config('pcbs.languages'), isset($user->language) ? $user->language : " ", ['class' => 'form-control']) }}
</div>

<div class="form-group">
<label>{{ __('common.role') }}</label><br>
{{ Form::select('role',array_map(function ($val) { return  __('common.' . strtolower($val) ); }, config('pcbs.roles')) , isset($user->role) ? $user->role  : " ", ['class' => 'form-control']) }}
</div>
