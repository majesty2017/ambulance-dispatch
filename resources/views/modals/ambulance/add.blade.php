<!-- Modal -->
<div class="modal fade" id="add-ambulance-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Ambulance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-ambulance-form" action="{{ route('ambulance.create') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ambulance_model">Model</label>
                                <input type="text" class="form-control" name="ambulance_model" id="ambulance_model" placeholder="Ambulance Model">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="manufacture_date">Manufacture Date</label>
                                <input type="text" class="form-control datepicker" name="manufacture_date" id="manufacture_date">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="engine_num">Engine Number</label>
                                <input type="text" class="form-control" name="engine_num" id="engine_num" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="driver_id">Driver</label>
                                <select class="form-control select2" name="driver_id" id="driver_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="purchase_date">Purchase Date</label>
                                <input type="text"  class="form-control datepicker" name="purchase_date" id="purchase_date">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>