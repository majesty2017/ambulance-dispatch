<!-- Modal -->
<div class="modal fade" id="view-driver-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Driver Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    @csrf

                    <div class="row mt-25">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="first_name">First name</label>
                                <div id="v_first_name"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="other_name">Other name</label>
                                <div id="v_other_name"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="last_name">Last name</label>
                                <div id="v_last_name"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="dob">Date of Birth</label>
                                <div id="v_dob"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="gender">Gender</label>
                                <div id="v_gender"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="address">Address</label>
                                <div id="v_address"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="phone">Phone numer</label>
                                <div id="v_phone"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="qualification">Qualification</label>
                                <div id="v_qualification"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="v_route">Route</label>
                                <div id="v_route"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder" for="email">Email</label>
                                <div id="v_email"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>