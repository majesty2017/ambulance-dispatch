<!-- Modal -->
<div class="modal fade" id="view-routes-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Route Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    @csrf

                    <div class="row mt-25">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <label class="font-weight-bolder">Route name</label>
                                <div id="v_hospital"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>