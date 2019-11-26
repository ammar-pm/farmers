<div v-if="form.topics.length > 0 ">

        <section>
            
            <div class="container">

                <div class="row text-center features-block c3">
                    <!-- Feature Item -->
                    <div class="col-sm-4" v-for="topic in form.topics" :key="topic.id">

                        <img :src="'/storage/images/'+topic.image+''" width="64">

                        <h4 v-text="topic.title"></h4>
                        <p v-html="topic.summary"></p>
                    </div>
                </div>
            </div><!-- /End Container -->

        </section>   


</div>