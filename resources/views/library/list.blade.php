<ais-results>
 <template scope="{ result }">

    <p :class="form.id == result.id ? 'active' : ''" @click.prevent="getRecord(result.id)"> @{{ result.title }} </p>
   
  </template>
</ais-results>
