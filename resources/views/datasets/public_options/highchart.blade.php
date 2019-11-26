<div class="form-row">
	<div class="form-group col">
		<agg-tree-select
				v-model="form.options.faggvalue"
				:options="form.faggload.options"
				:sort-value-by="form.faggload.sortValueBy"
				:clear-on-select="form.faggload.clearOnSelect"
				:multiple="true"
				placeholder="{{ __('common.aggregation_selector') }}"
		></agg-tree-select>
		<!-- <label> {{ __('common.aggregation_selector') }} </label> -->
	</div>

	<div class="form-group col">
		<multiselect
				v-model="form.options.years_field"
				:options="form.years_field"
				:multiple="true"
				placeholder="{{ __('common.years') }}">
		</multiselect>
		<!-- <label> years </label> -->
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
