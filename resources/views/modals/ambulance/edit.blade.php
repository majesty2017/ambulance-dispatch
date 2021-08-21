<!-- Modal -->
<div class="modal fade" id="edit-ambulance-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Ambulance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-ambulance-form" action="{{ route('ambulance.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="e_id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_ambulance_model">Model</label>
                                <input type="text"
                                       class="form-control" name="ambulance_model" id="e_ambulance_model"  placeholder="Ambulance Model">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_manufacture_date">Manufacture Date</label>
                                <input type="text" class="form-control datepicker" name="manufacture_date" id="e_manufacture_date">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_engine_num">Engine Number</label>
                                <input type="text" class="form-control" name="engine_num" id="e_engine_num" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_driver_id">Driver</label>
                                <select class="form-control" name="driver_id" id="e_driver_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e_purchase_date">Purchase Date</label>
                                <input type="text"  class="form-control datepicker" name="purchase_date" id="e_purchase_date">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>