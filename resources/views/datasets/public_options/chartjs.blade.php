<div class="row">
	<div class="col-md-12">

		<div class="form-row">
			<div class="form-group col">
				<agg-tree-select
						v-model="form.options.faggvalue"
						:options="form.faggload.options"
						:sort-value-by="form.faggload.sortValueBy"
						:clear-on-select="form.faggload.clearOnSelect"
						:multiple="true"
						placeholder="{{ __('common.base_selector') }}"
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
	</div>
</div>
