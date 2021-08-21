<!-- Modal -->
<div class="modal fade" id="edit-dispatch_status-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Dispatch Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-dispatch_status-form" action="{{ route('dispatch_status.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="diseid">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dedriver_id">Driver</label>
                                <select class="form-control select2" name="driver_id" id="disedriver_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="diserequest_id">Request</label>
                                <select class="form-control select2" name="request_id" id="diserequest_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="destatus">Status</label>
                                <select class="form-control select2" name="status" id="disestatus">
                                    <option value="">Select option</option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>