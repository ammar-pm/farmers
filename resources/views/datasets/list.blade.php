<div class="row">
  <div id="table" class="col-xs-12 table-responsive">

    <!-- <datatable :columns="[{label: 'ID', field: 'id'},{label: 'Title', field: 'title'},{label: 'Created at', field: 'created_at'},{label: 'Created by', field: 'user'}]" :data="records"> -->

    <!-- <morad-datatable :columns="[{label: 'ID', field: 'id'},{label: 'Title', field: 'title'},{label: 'Created at', field: 'created_at'}]" :data="records">
      
      <template scope="{ row }">
        <tr @click.prevent="getRecord(row.id)">
          <td>@{{ row.id }}</td>
          <td>@{{ row.title }}</td>
          <td>@{{ row.created_at.date | moment("ddd, MMMM Do YYYY") }}</td>
        </tr>
      </template>

    </morad-datatable> -->

  </div>
</div>
