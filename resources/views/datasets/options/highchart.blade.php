<h2 class="text-uppercase">{{ __('common.highcharts_options') }}</h2>

<div class="form-row">

	<div class="form-group col" v-if="form.options.type == 'line' || form.options.type == 'column'">
		<select  class="form-control required" id="xaxis" name="xaxis" v-model="form.options.X" required>
			<option v-for="toption in form.fdimload"
					:value="toption"
					:selected="form.options.X== toption ? 'selected' : ''">@{{ toption }}</option>
		</select>
		<label for="yaxis">{{ __('common.y_axis') }} <sup>*</sup></label>
	</div>

	<div class="form-group col" v-else>
		<select  class="form-control required" id="xaxis" name="xaxis" v-model="form.options.X" required>
			<option v-for="toption in form.fdimload"
					:value="toption"
					:selected="form.options.X== toption ? 'selected' : ''">@{{ toption }}</option>
		</select>
		<label for="yaxis">{{ __('common.x_axis') }} <sup>*</sup></label>
	</div>

	<div class="form-group col">
		<input type="text" class="form-control" name="hc_heigh" id="hc_heigh" v-model="form.options.height">
		<label>{{ __('common.height') }}</label>
	</div>

	<!--div class="form-group col">
		<input type="text" class="form-control" v-model="form.options.highchart_title">
		<label>{{ __('common.sub_title') }}</label>
	</div-->

</div>

<div class="form-row">
	<div class="form-group col">
		<agg-tree-select
				style="{{ (App::getLocale() == 'ar') ? 'text-align:right' :  'text-align:left' }}"
				v-model="form.options.faggvalue"
				:options="form.faggload.options"
				:sort-value-by="form.faggload.sortValueBy"
				:clear-on-select="form.faggload.clearOnSelect"
				:multiple="true"
				placeholder="{{ __('common.select_option') }}"
		></agg-tree-select>
		<label> {{ __('common.aggregation_selector') }} </label>
	</div>

	<div class="form-group col">
		<multiselect
				v-model="form.options.years_field"
				:options="form.years_field"
				:multiple="true"
				placeholder="{{ __('common.select_option') }}">
		</multiselect>
		<label> {{ __('common.years') }} </label>
	</div>

	<!--div class="form-group col">
		<input type="text" class="form-control" v-model="form.options.zoomtype">
		<label>{{ __('common.zoom_type') }} (<span class="text-small">{{ __('common.xy_zoom') }}</span>)</label>
	</div-->
</div>
<!--div class="form-group">
	<label for="sel1">Y axis:<sup>*</sup></label>
	<select  class="form-control" id="yaxis" name="yaxis" v-model="form.options.Y" required>
		<option v-for="toption in form.fdimload"
				:value="toption"
				:selected="form.options.Y == toption ? 'selected' : ''">@{{ toption }}</option>
	</select>
</div>
<div class="form-group">
	<label for="sel1">Z axis:<sup>*</sup></label>
	<select  class="form-control" id="zaxis" name="zaxis" v-model="form.options.Z"  required>
		<option v-for="toption in form.fdimload"
				:value="toption"
				:selected="form.options.Z == toption ? 'selected' : ''">@{{ toption }}</option>
	</select>
</div-->

<!--div class="form-group">
	<label> Base Selector </label>
	<agg-tree-select
			v-model="form.options.fbasevalue"
			:options="form.fbaseload.options"
			:multiple="true"
	></agg-tree-select>
</div-->
