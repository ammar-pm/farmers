<template>
  <div class="data-table">
    <table class="table">
      <thead>
      <tr>
        <th class="table-head">#</th>
        <th v-for="column in columns" :key="column"
            class="table-head">
          {{ column | columnHead }}
        </th>
      </tr>
      </thead>
      <tbody>
      <tr class="" v-if="rows.length === 0">
        <td class="lead text-center" :colspan="columns.length + 1">No data found.</td>
      </tr>
      <tr v-for="(data, key1) in rows" :key="data.id" class="m-datatable__row" v-else>
        <td>{{ serialNumber(key1) }}</td>
        <td v-for="(value, key) in data">{{ value }}</td>
      </tr>
      </tbody>

    </table>
  </div>
</template>

<script type="text/ecmascript-6">
export default {
  props: {
    rows: { type: Array, required: true },
    columns: { type: Array, required: false },
  },
  data() {
    return {
      tableData: []
    }
  },
  created() {
  },
  methods: {
    fetchData(url) {
      axios.get(url)
        .then(data => {
          this.tableData = data.data.data
        })
    },
    /**
     * Get the serial number.
     * @param key
     * */
    serialNumber(key) {
      return key + 1;
    },
  },
  filters: {
    columnHead(value) {
      return value.split('_').join(' ').toUpperCase()
    }
  },
  name: 'CustomDataTable'
}
</script>

<style scoped>