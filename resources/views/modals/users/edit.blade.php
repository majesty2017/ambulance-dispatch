<!-- Modal -->
<div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-user-form" action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_first_name">First name</label>
                                <input type="text"
                                       class="form-control" name="first_name" id="edit_first_name"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_other_name">Other name</label>
                                <input type="text"
                                       class="form-control" name="other_name" id="edit_other_name"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_last_name">Last name</label>
                                <input type="text"
                                       class="form-control" name="last_name" id="edit_last_name"  placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_dob">Date of Birth</label>
                                <input type="text"
                                       class="form-control dt-date" name="dob" id="edit_dob"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_gender">Gender</label>
                                <select class="form-control" name="gender" id="edit_gender">
                                    <option value="">Select option</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_address">Address</label>
                                <textarea class="form-control" name="address" id="edit_address" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_phone">Phone numer</label>
                                <input type="text"
                                       class="form-control" name="phone" id="edit_phone"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_qualification">Qualification</label>
                                <input type="text"
                                       class="form-control" name="qualification" id="edit_qualification"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_rank">Rank</label>
                                <input type="text"
                                       class="form-control" name="rank" id="edit_rank"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_profile">Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="profile" onchange="load_image('edit_profile', 'eee_load_profile_picture')" id="edit_profile" />
                                    <label class="custom-file-label" for="profile">Choose file</label>
                                </div>
                            </div>
                            <div id="eee_load_profile_picture" class="mb-1"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="text"
                                       class="form-control" name="email" id="edit_email"  placeholder="john.doe@gmail.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eepassword">Password</label>
                                <input type="password" class="form-control" name="password" id="eepassword" placeholder="...................">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eepassword_confirmation">Re-Type Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="eepassword_confirmation" placeholder="...................">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>