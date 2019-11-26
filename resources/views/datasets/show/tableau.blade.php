<div class="full-height" style="overflow-y: hidden;" v-if="form.options.type == 'bubble'">
  <iframe  class="full-height" :src="'/vizbi/bubble/' + form.file_id.id" :file_id="form.file_id.id" width="100%" :height="vheight" border="0" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen ></iframe>
</div>

<div class="full-height" style="overflow-y: hidden;" v-if="form.options.type == 'line'">
  <iframe class="full-height" :src="'/vizbi/line/' + form.file_id.id" :file_id="form.file_id.id" width="100%" :height="vheight" border="0" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen ></iframe>
</div>

<div class="full-height" style="overflow-y: hidden;" v-if="form.options.type == 'bar'">
  <iframe class="full-height" :src="'/vizbi/bar/' + form.file_id.id" :file_id="form.file_id.id" width="100%" :height="vheight" border="0" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen ></iframe>
</div>
