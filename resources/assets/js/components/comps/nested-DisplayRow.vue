<template :form_id="form_id">
  <div class="-nested-dsp-row-comp">
    <button class="btn btn-xs btn-link -nested-dsp-row-close-btn"
      @click="nested.$toggle(false)">
      <i class="fa fa-times fa-lg"></i>
    </button>
    <dl class="dl-horizontal">
      <template v-for="(val, key) in row">
        <dt>{{ key }}</dt>
        <dd>
          <!-- v-model="message" v-init:message="val" -->
          <input type="text" v-if="key != 'uid'" :id="key" :value="val" v-on:change="callback($event)"> <br>
          <input type="text" v-if="key == 'uid'" :id="key" :value="val" disabled> <br>
        </dd>
      </template>
    </dl>
    <!--button class="btn btn-default" title="Save changes"
            @click="callback($event)">
      Save
    </button-->
  </div>
</template>
<script>
export default {
  props: ['data','row', 'nested'],
    data: () => ({
        finds: [],
        form_id:'',
        mod_row:{}
    }),
    mounted() {
        var url = window.location.href;
        var reurl = url.substring(url.indexOf("files"));
        var matches = reurl.match(/\/(.*?)\//);
        var form_now = matches[1];
        this.form_id = form_now; // I'm text inside the component.
        this.mod_row = this.row;
    },
    methods: {
        callback: function (event) {
            var ch_key = event.target.id;
            var ch_val = event.target.value;
            this.mod_row[ch_key] = ch_val;
            this.$root.$emit('ChangedRow', this.row);
        }
    }
}
</script>
<style>
.-nested-dsp-row-comp {
  position: relative;
  padding: 10px;
}
.-nested-dsp-row-close-btn {
  position: absolute;
  top: 5px;
  right: 5px;
}
</style>
