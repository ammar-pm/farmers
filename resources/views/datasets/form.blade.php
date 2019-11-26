<b-tabs v-model="tabIndex">
  <!-- <b-tab title="{{ __('common.info') }}" @click="showTabs()">
    <h2>  __('common.info') }} </h2>
    <div>

    </div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()"> __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()"> __('common.next') }}</button>
    </div>
  </b-tab> -->

  <b-tab title="{{ __('common.general') }}" active title-item-class="disabledTab"> <!-- @click="showTabs()" -->
  	<h2> {{ __('common.general') }} </h2>
  	<div class="form-row info-form">
  		
  		<div class="form-group col-md-6">
	    	<input id="dataset-title" type="text" class="form-control required" v-model="form.title" required>
	    	<label>{{ __('common.title') }} *</label>
			</div>

			<div class="form-group col-md-6">
		 		<input type="text" class="form-control" v-model="form.description">
		 		<label>{{ __('common.description') }}</label>
			</div>

			<div class="form-group col-md-6">
        <!-- <multiselect 
          v-model="value" 
          deselect-label="Can't remove this value" 
          track-by="name" 
          label="name" 
          placeholder="Select one" 
          :options="options" 
          :searchable="false" 
          :allow-empty="false">
        </multiselect> -->
        <multiselect
          v-model="form.topicid"
          :options="topics"
          :multiple="false"
          :close-on-select="true"
          :clear-on-select="true"
          :hide-selected="true"
          placeholder="{{ __('common.filterfilesbytopics') }}"
          label="title"
          @input="getFileTopicId"
          track-by="id" class="form-control">
        </multiselect>
        <!-- <v-select
            v-model="form.topicid"
            :options="topics"
            placeholder="{{ __('common.selecttopics') }}"
            label="title"
            @input="getFileTopicId"
            track-by="id" class="">
        </v-select> -->
        <label>{{ __('common.topics') }}</label>
			</div>

			<div class="form-group col-md-6" id="file-select">
        <!-- <v-select
            v-model="form.file_id"
            :options="files"
            placeholder="{{ __('common.selectfile') }}"
            label="name"
            @input="getFileId"
            track-by="id" class="">
        </v-select> -->
        <multiselect
                v-model="form.file_id"
                :options="files"
                :multiple="false"
                :close-on-select="true"
                :clear-on-select="true"
                :hide-selected="false"
                :preserve-search="true"
                @input="getFileId"
                placeholder="{{ __('common.selectfile') }}"
                label="name"
                track-by="id" class="form-control">
        </multiselect>
		    <label>{{ __('common.file') }}</label>
		  </div>

      <div class="form-group col-md-6">
      <!-- <v-select
            v-model="form.file_id"
            :options="files"
            placeholder="{{ __('common.selectfile') }}"
            label="name"
            @input="getFileId"
            track-by="id" class="">
        </v-select> -->
        <multiselect
                v-model="form.related_id"
                :options="related_datasets"
                :multiple="false"
                :custom-label="titleWithLang"
                placeholder="{{ __('common.select_option') }}"
                track-by="id"  class="form-control">
        </multiselect>
        <label>{{ __('common.related_id') }}</label>
      </div>

      <div clss="col-md-12">
        <p class="text-muted"><small>
          {{ __('common.updatedat') }}: @{{ updated }} &nbsp;
          {{ __('common.created') }}: @{{ created }} &nbsp;
          <span v-if="created_by">{{ __('common.by') }}: @{{ created_by }}</span>
        </small></p>
      </div>
      <!-- <br/>

      <div>
        
      </div> -->

  	</div>

    <div class="text-right tabs-nav">
      <a @click.prevent="deleteRecord(form.id)" class="btn btn-xs btn-danger">
        <i class="mdi mdi-delete"></i>
      </a>

      <a :href="'/datasets/file/download/'+showfileid+''" class="btn btn-default" v-if="showfileid" target="_blank">
        <i class="mdi mdi-download"></i>
        <!-- {{ __('common.fileid') }}: @{{ showfileid }} -->
      </a>
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
    
  </b-tab>

  <!-- <b-tab title="{{ __('common.library') }}" @click="showTabs()">
    <h2>{{ __('common.library') }}</h2>

    @ include('datasets.libraries')

    <div v-if="form.library == 'chartjs'">
      @ include('datasets.types.chartjs')
    </div>

    <div v-else-if="form.library == 'highchart'">
      @ include('datasets.types.highchart')
    </div>

    <div v-else-if="form.library == 'plotly'">
      @ include('datasets.types.plotly')
    </div>

    <div v-else-if="form.library == 'tableau'">
      @ include('datasets.types.tableau')
    </div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab> -->

  <b-tab title="{{ __('common.library') }}" title-item-class="disabledTab"> <!-- @click="showTabs()" -->

    <!-- <h2>{{ __('common.library') }}</h2> -->

    @include('datasets.libraries')

    <div v-if="form.library == 'chartjs'" class="library-type">
      @include('datasets.types.chartjs')
    </div>

    <div v-else-if="form.library == 'highchart'" class="library-type">
      @include('datasets.types.highchart')
    </div>

    <div v-else-if="form.library == 'plotly'" class="library-type">
      @include('datasets.types.plotly')
    </div>

    <div v-else-if="form.library == 'tableau'" class="library-type">
      @include('datasets.types.tableau')
    </div>

    <div class="mt-3 mb-5 pb-5">
      @include('datasets.options')
    </div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="prevTab()">{{ __('common.previous') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab>

  <b-tab title="{{ __('common.language') }}" title-item-class="disabledTab">
  	<h2> {{ __('common.display') }} </h2>
    <div class="form-group checkbox">
      <!-- <label class="radio-inline" for="any">
        <input type="radio" id="any" value="any" v-model="form.language"> {{ __('common.any') }}
      </label> -->
			<label class="radio-inline" for="en">
				<input type="radio" id="en" value="en" v-model="form.language"> English
			</label>
      <label class="radio-inline" for="ar">
        <input type="radio" id="ar" value="ar" v-model="form.language"> العربية
      </label>
    </div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="prevTab()">{{ __('common.previous') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab>

  <!--
  <b-tab title="{{ __('common.periods') }}" @click="showTabs()">
  	<h2> {{ __('common.periods') }} </h2>
    <div class="form-group">
      <multiselect
          v-model="form.periods"
          :options="periods"
          :multiple="true"
          :close-on-select="true"
          :clear-on-select="false"
          :hide-selected="true"
          :preserve-search="true"
          placeholder="{{ __('common.selectperiods') }}"
          label="title"
          track-by="title"
          >
      </multiselect>
		</div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab>
  -->

  <b-tab title="{{ __('common.tags') }}" title-item-class="disabledTab">
  	<h2>{{ __('common.tags') }}</h2>
    <div class="form-group">
      <multiselect 
        v-model="form.tags" 
        tag-placeholder="Add this as new tag" 
        placeholder="{{ __('common.addatag')}}" 
        label="name" 
        track-by="code" 
        :options="taglist" 
        :multiple="true" 
        :taggable="true" 
        @tag="addTag"
      ></multiselect>
			<!-- <v-select 
				v-model="form.tags" 
				tag-placeholder="Add this as new tag" 
				placeholder="{{ __('common.addatag')}}" 
				label="name" 
				track-by="code"
				:options="taglist"
				:multiple="true"
        :taggable="true"
        :pushTags="true"
				@tag="addTag"
        class=""
			></v-select> -->
		</div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="prevTab()">{{ __('common.previous') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab>

  <b-tab title="{{ __('common.topics') }}" title-item-class="disabledTab">
  	<h2>{{ __('common.topics') }}</h2>
    <div class="form-group" id="topics-select">
			<!-- <v-select
		        v-model="form.topics"
		        :options="topics"
		        :multiple="true"
		        placeholder="{{ __('common.selecttopics') }}"
		        label="title"
		        track-by="id"
            class=""
            >
	    </v-select> -->
      <multiselect
            v-model="form.topics"
            :options="topics"
            :multiple="true"
            :close-on-select="true"
            :clear-on-select="true"
            :hide-selected="true"
            :preserve-search="true"
            placeholder="{{ __('common.selecttopics') }}"
            label="title"
            track-by="id">
      </multiselect>
		</div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="prevTab()">{{ __('common.previous') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab>
<!--
  <b-tab title="{{ __('common.governorates') }}" @click="showTabs()">
  	<h2>{{ __('common.governorates') }}</h2>
  	<div class="form-group">
      <multiselect
            v-model="form.governorates"
            :options="governorates"
            :multiple="true"
            :close-on-select="true"
            :clear-on-select="false"
            :hide-selected="true"
            :preserve-search="true"
            placeholder="{{ __('common.selectgovernorates') }}"
            label="title"
            track-by="id">
      </multiselect>
		</div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab>
  -->
<!--
  <b-tab title="{{ __('common.indicators') }}" @click="showTabs()">
  	<h2>{{ __('common.indicators') }}</h2>
    <div class="form-group">
      <multiselect
          v-model="form.indicators"
          :options="indicators"
          :multiple="true"
          :close-on-select="true"
          :clear-on-select="false"
          :hide-selected="true"
          :preserve-search="true"
          placeholder="{{ __('common.selectindicators') }}"
          label="title"
          track-by="id">
      </multiselect>
		</div>

    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <button class="btn btn-primary" v-on:click="nextTab()">{{ __('common.next') }}</button>
    </div>
  </b-tab>
  -->

  <b-tab title="{{ __('common.visibility') }}" title-item-class="disabledTab">
    <h2> {{ __('common.visibility') }} </h2>
    <div class="form-row">
      <div class="col-md-3">
        <div class="form-group checkbox">
          <label><input type="checkbox" v-model="form.public"> {{ __('common.public') }}</label>
          <p> {{ __('common.visibility_public_description') }} </p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group checkbox">
          <label><input type="checkbox" v-model="form.featured"> {{ __('common.featured') }}</label>
          <p> {{ __('common.visibility_featured_description') }} </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-row preview-image custom-upload">
          <div class="col-md-6">
            <div id="img-out">
              <img v-if="form.preview" :src="form.preview">
              <img v-if="preview_url" :src="preview_url">
            </div>
          </div>
          <div class="col-md-6">
            <label> {{ __('common.preview_image') }} </label>
            <!-- <input type="file" v-model="form.preview"> -->
            <input type="file" name="file" id="file" ref="file" v-on:change="handleFileUpload()">
            <p v-if="form.library !== 'plotly' && form.library !== 'tableau' " class="mt-4"> {{ __('common.or') }} </p>
            <button v-if="form.library !== 'plotly' && form.library !== 'tableau' "   class="btn btn-dark" @click="printt()">{{ __('common.capture') }}</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="text-right tabs-nav">
      <button class="btn btn-dark" v-on:click="allRecords()">{{ __('common.backtodatasets') }}</button>
      <a :href="'/library#/dataset/'+form.id+''" class="btn btn-default" target="_blank">{{ __('common.preview_dataset') }}</a>
      <button class="btn btn-primary" v-on:click="prevTab()">{{ __('common.previous') }}</button>
      <button type="submit" class="btn btn-primary text-uppercase" @click.prevent="saveRecord" :disabled="form.busy">{{ __('common.save') }}</button>
      <alert v-if="form.successful" message="{{ __('common.saved') }}"></alert>
    </div>
  </b-tab>

</b-tabs>
