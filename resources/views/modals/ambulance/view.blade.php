<!-- Modal -->
<div class="modal fade" id="view-ambulance-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Ambulance Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    @csrf

                    <div class="row mt-25">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Ambulance Model</label>
                                <div id="v_ambulance_model"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Manufacture Date</label>
                                <div id="v_manufacture_date"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Engine Number</label>
                                <div id="v_engine_num"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Driver</label>
                                <div id="vv_driver_id"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">Purchase Date</label>
                                <div id="v_purchase_date"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>