<h2 class="text-uppercase">{{ __('common.chartjsoptions') }}</h2>

<div class="row">
	<div class="col-md-8">

		<p class="text-muted text-uppercase">{{ __('common.axesoptions') }}</p>

		<div class="form-row">

			<div class="form-group col"  v-if="form.options.type == 'line' || form.options.type == 'bar'" >
				<select  class="form-control required" id="xaxis" name="xaxis" v-model="form.options.X" required>
					<option v-for="toption in form.fdimload"
							:value="toption"
							:selected="form.options.X== toption ? 'selected' : ''">@{{ toption }}</option>
				</select>
				<label for="yaxis">{{ __('common.y_axis') }} <sup>*</sup></label>
			</div>
			<div class="form-group col"  v-else>
				<select  class="form-control required" id="xaxis" name="xaxis" v-model="form.options.X" required>
					<option v-for="toption in form.fdimload"
							:value="toption"
							:selected="form.options.X== toption ? 'selected' : ''">@{{ toption }}</option>
				</select>
				<label for="yaxis">{{ __('common.x_axis') }} <sup>*</sup></label>
			</div>

			<div class="form-group col" v-if="form.options.type == 'line' || form.options.type == 'bar'" >
					<input id="xLabel" type="text" class="form-control" v-model="form.options.xLabel">
					<label for="xLabel">{{ __('common.xlabel') }}</label>
			</div>
			<div class="form-group col" v-else >
				<input id="xLabel" type="text" class="form-control" v-model="form.options.xLabel">
				<label for="xLabel">{{ __('common.ylabel') }}</label>
			</div>

			<div class="form-group col" v-if="form.options.type == 'line' || form.options.type == 'bar'" >
					<input id="yLabel" type="text" class="form-control" v-model="form.options.yLabel">
					<label for="yLabel">{{ __('common.ylabel') }}</label>
			</div>

			<div class="form-group col" v-else >
				<input id="yLabel" type="text" class="form-control" v-model="form.options.yLabel">
				<label for="yLabel">{{ __('common.xlabel') }}</label>
			</div>



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
            placeholder="{{ __('common.select_option') }}">
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
		</div>
	</div>
	<div class="col-md-4">
		<div v-if="form.options.type == 'line'">
			<p class="text-muted text-uppercase">{{ __('common.pointoptions') }}</p>

			<div class="form-row">

				<div class="form-group col">
					<select class="form-control" @change="updatePointStyle" v-model="form.options.pointStyle">
						@foreach(config('pcbs.point_styles_'.App::getlocale()) as $key => $style)
							<option value="{{ $key }}">{{ $style }}</option>
						@endforeach
					</select>
					<label>{{ __('common.pointstyle') }}</label>
				</div>

				<div class="form-group col">
					<input type="number" class="form-control" v-model="form.options.pointRadius" v-on:keyup="updatePointStyle">
					<label>{{ __('common.pointradius') }}</label>
				</div>

			<!-- <div class="form-group col">
  					<input type="number" class="form-control" v-model="form.options.tension" v-on:keyup="updatePointStyle">
  					<label>{{ __('common.tension') }}</label>
  				</div> -->

			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-8">

		<div class="form-row">

			<div class="col">
				<p class="text-muted text-uppercase">{{ __('common.generaloptions') }}</p>

				<div class="checkbox">
					<label><input type="checkbox" v-model="form.options.stacked"> {{ __('common.stacked?') }}</label>
				</div>
			</div>

			<div class="col" v-if="form.options.type == 'line'">

				<div class="checkbox">
					<label><input type="checkbox" v-model="form.options.spanGaps" @change="updatePointStyle"> {{ __('common.spangaps?') }}</label>
				</div>

				<div class="checkbox">
					<label><input type="checkbox" v-model="form.options.fill" @change="updatePointStyle"> {{ __('common.fillarea?') }}</label>
				</div>

			</div>

			<div class="col">
				<p class="text-muted text-uppercase">{{ __('common.legendoptions') }}</p>

				<div class="checkbox">
					<label><input type="checkbox" v-model="form.options.legend"> {{ __('common.displaylegend') }}</label>
				</div>
			</div>

			<div class="form-group col">
				<select class="form-control" v-model="form.options.legendPosition">
					@foreach(config('pcbs.legend_positions_'.App::getlocale()) as $key => $position)
						<option value="{{ $key }}">{{ $position }}</option>
					@endforeach
				</select>
				<label>{{ __('common.legendposition') }}</label>
			</div>

		</div>

	</div>
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




<!--div class="form-group">
    <label>X Columns</label>
    <select class="form-control" v-model="form.options.XColumn" multiple>
        <option v-for="data in chartjsdata">@{{ data.label }}</option>
    </select>
</div-->


<!--
		  	<div class="form-group">
		  		<label>Y</label>
		  		<select class="form-control" v-model="form.options.yColumn">
		  			<option v-for="data in chartjsdata">@{{ data.label }}</option>
		  		</select>
		  	</div> 
-->

