<!-- <div class="row"> 

	<div class="col-md-9">-->
     <ul class="list-unstyled list-inline">
       <li @click="getRecord(form.id)"> @{{form.title}} </li>
     </ul>
	   <p v-html="form.description"></p>

     <p v-if="form.tags.length > 0">
        <span v-for="tag in form.tags" :key="tag.id" class="label label-primary text-uppercase m-r-sm">
          <a v-text="tag.name" :href="'/library?q='+tag.name+''" style="color:#fff"></a>
       </span>
     </p>

	<!-- </div> -->

	<!-- <div class="col-md-3">
		@ include('library.types')
	</div> -->

<!-- </div> -->