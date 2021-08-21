<!-- Modal -->
<div class="modal fade" id="edit-driver_status-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Driver Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-driver_status-form" action="{{ route('driver_status.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="eid">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edriver_id">Driver</label>
                                <select class="form-control select2" name="driver_id" id="edriver_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="estatus">Status</label>
                                <select class="form-control select2" name="status" id="estatus">
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