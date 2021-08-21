<!-- Modal -->
<div class="modal fade" id="edit-driver-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-driver-form" action="{{ route('driver.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="eid">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text"
                                       class="form-control" name="first_name" id="efirst_name"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="other_name">Other name</label>
                                <input type="text"
                                       class="form-control" name="other_name" id="eother_name"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text"
                                       class="form-control" name="last_name" id="elast_name"  placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="text"
                                       class="form-control dt-date" name="dob" id="edob"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ed_gender">Gender</label>
                                <select class="form-control select2" name="gender" id="ed_gender">
                                    <option value="">Select option</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="eaddress" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone numer</label>
                                <input type="text"
                                       class="form-control" name="phone" id="ephone"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <input type="text"
                                       class="form-control" name="qualification" id="equalification"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ed_route_id">Route</label>
                                <select  class="form-control select2" name="route_id" id="ed_route_id">
                                    <option value="">Select option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text"
                                       class="form-control" name="email" id="eemail"  placeholder="john.doe@gmail.com">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>