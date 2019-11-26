<div class="full-height" v-if="form.options.type == 'bar'">
	<bar-chart class="full-height" :height="700" :option="form.options" :file="form.file_id" :id="form.id" :title="form.title" :options="form.options"  :data="chartjsdata" :labels="chartjslabel"> </bar-chart>
</div>

<div class="full-height" v-else-if="form.options.type == 'horizontal-bar'">
	<horizontal-bar-chart class="full-height" :height="700" :option="form.options" :file="form.file_id" :id="form.id" :title="form.title" :options="form.options"  :data="chartjsdata" :labels="chartjslabel"> </horizontal-bar-chart >
</div>

<div class="full-height" v-else-if="form.options.type == 'line'">
	<line-chart class="full-height" :height="700" :option="form.options" :file="form.file_id" :id="form.id" :title="form.title" :options="form.options"  :data="chartjsdata" :labels="chartjslabel"> </line-chart>
</div>

<div class="full-height" v-else-if="form.options.type == 'pie'">
	<pie-chart class="full-height" :height="700" :option="form.options" :chartobject="chartobject"	:id="form.id" :title="form.title" :chartdataoption="chartupdatedata" :options="form.options" :chartoptiondata="chartoption" :data="chartjsdata" :labels="chartjslabel"> </pie-chart>
</div>	

<div class="full-height" v-else-if="form.options.type == 'radar'">
	<radar-chart class="full-height" :height="700" :option="form.options" :chartobject="chartobject"	:id="form.id" :title="form.title" :chartdataoption="chartupdatedata" :options="form.options" :chartoptiondata="chartoption" :data="chartjsdata" :labels="chartjslabel"> </radar-chart>
</div>

<div class="full-height" v-else>
	<doughnut-chart class="full-height" :height="700" :option="form.options" :chartobject="chartobject" :id="form.id" :title="form.title" :chartdataoption="chartupdatedata" :options="form.options" :chartoptiondata="chartoption" :data="chartjsdata" :labels="chartjslabel"> </doughnut-chart>
</div>