<form action="#" @submit.prevent="createRecord()">
<div class="input-group">
    <input type="text" class="form-control" v-model="createForm.name" autofocus required>
    <span class="input-group-btn">
        <button type="submit" class="btn btn-primary" :disabled="createForm.busy">{{ __('common.newlabel') }}</button>
    </span>
</div>
<small v-if="createForm.successful" class="text-muted">{{ __('common.saved') }}.</small>
</form>