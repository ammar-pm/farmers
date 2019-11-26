<!-- Session Expired Modal -->
<div class="modal fade" id="modal-session-expired" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    {{ __('common.sessionexpired') }}
                </h4>
            </div>

            <div class="modal-body">
                {{ __('common.sessionexpiredloginagain') }}
            </div>

            <!-- Modal Actions -->
            <div class="modal-footer">
                <a href="/login">
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-btn fa-sign-in"></i>{{ __('common.gotologin') }}
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
