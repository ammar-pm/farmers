<div class="full-height" v-if="form.options.type == 'column'">
<high-chart  class="full-height" :file="form.file_id" :option="form.options" :user="user" :app_local="app_local"></high-chart>
</div>

<div class="full-height" v-if="form.options.type == 'line'">
    <high-chart class="full-height" :file="form.file_id" :option="form.options" :user="user" :app_local="app_local"></high-chart>
</div>

<div class="full-height" v-if="form.options.type == 'bar'">
    <high-chart class="full-height" :file="form.file_id" :option="form.options" :user="user" :app_local="app_local"></high-chart>
</div>