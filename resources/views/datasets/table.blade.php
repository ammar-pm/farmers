  <table class="table table-hover" v-if="chartobject">
    <thead>
      <tr>
        <th>{{ __('common.label') }}</th>
        <th v-for="label in chartobject.labels">@{{ label }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="object in chartobject.datasets">
        <td>@{{ object.label }}</td>
        <td v-for="labeldata in object.data">@{{ labeldata }}</td>
      </tr>
    </tbody>
  </table>