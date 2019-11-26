<div v-if="form.indicators.length > 0">

<div class="text-center p-y row"> 
        
        <div v-for="indicator in form.indicators" :key="indicator.id" class="col-md-4">
                
                <img :src="'/storage/icons/'+indicator.icon+''" width="32">

                <h4 class="m-t" v-text="indicator.value"></h4>
                <p v-text="indicator.title"></p>
        </div>

</div><!--Carousel -->

</div><!--VIf-->