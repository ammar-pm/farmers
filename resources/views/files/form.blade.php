{{ csrf_field() }}

@if(!Request::is('files/*/edit'))
    <div class="form-group custom-upload {{ $errors->has('url') ? 'has-error' :'' }}">
        <input type="file" name="url" ref="file" accept=".csv" required title="{{ __('common.uploadfilerequired') }}">
        <label>{{ __('common.uploadfile') }}<sup>*</sup> <small class="text-muted">CSV</small></label>
        {!! $errors->first('url','<span class="help-block">:message</span>') !!}
    </div>
@else
    <div class="custom-upload {{ $errors->has('url') ? 'has-error' :'' }}">
        <input type="file" name="url" id="file-url" ref="file" accept=".csv" title="{{ __('common.uploadfile') }}">
        <label for="file-url" class="mdi mdi-upload" title="{{ __('common.uploadnewfile') }}"></label>
    </div>
@endif

<div class="form-group">
    <input type="text" class="form-control" name="title" value="{{ $record->title or null }}" required>
    <label>{{ __('common.title') }}<sup>*</sup></label>
</div>

<!--div class="form-group">
    <select class="form-control" id="dformat" name="dformat" required>
        <option value="2" {{ (isset($record->dformat) && $record->dformat == 2) ? 'selected':' ' }}>Long</option>
    </select>
    <label for="sel1">Data format<sup>*</sup></label>
</div-->
<input type="hidden" name="dformat" id="dformat" value="2">


<div class="form-group">
    <select class="form-control" id="language" name="language" @change="setLangModel" required>
        <option value="ar" {{ (isset($record->language) && $record->language == 'ar') ? 'selected':' ' }}>العربية</option>
        <option value="en" {{ (isset($record->language) && $record->language == 'en') ? 'selected':' ' }}>English</option>
    </select>
    <label for="sel1">{{ __('common.language') }}<sup>*</sup></label>
</div>

<!-- <div class="form-group">
    <v-select
        v-model="selectedtopics"
        :options="topics"
        placeholder="{{ __('common.selecttopics') }}"
        label="title"
        track-by="id"
        required="true"
    ></v-select>
    <label>{{ __('common.topic') }}<sup>*</sup></label>
</div> -->

<div class="form-group topics-select" id="topics-select">
    <input type="hidden" id="topics" name="topics" value="[]" required>
    <multiselect
            v-model="selectedtopics"
            :options="topics"
            :multiple="true"
            :close-on-select="true"
            :clear-on-select="true"
            :hide-selected="true"
            :preserve-search="true"
            placeholder="{{ __('common.selecttopics') }}"
            label="title"
            track-by="id"
            required
    >
        <span slot="noResult">{{ __('common.changelangbox') }}</span>

    </multiselect>
    <label>{{ __('common.topics') }}<sup>*</sup></label>
    <span id="no-topics" class="help-block hidden">{{ __('common.notopicselected') }}</span>
</div>

<!--
this hidden field works as a mediator between Vuejs and HTML
added by abdullrahman aka abdo
-->
<div class="form-group">
    <input type="hidden" id="hiddentopics" name="topics" value="[]">
</div>

