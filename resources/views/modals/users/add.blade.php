<!-- Modal -->
<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-user-form" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text"
                                       class="form-control" name="first_name" id="first_name"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="other_name">Other name</label>
                                <input type="text"
                                       class="form-control" name="other_name" id="other_name"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text"
                                       class="form-control" name="last_name" id="last_name"  placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="text"
                                       class="form-control dt-date" name="dob" id="dob"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control select2" name="gender" id="gender">
                                    <option value="">Select option</option>
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone numer</label>
                                <input type="text"
                                       class="form-control" name="phone" id="phone"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <input type="text"
                                       class="form-control" name="qualification" id="qualification"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rank">Rank</label>
                                <input type="text"
                                       class="form-control" name="rank" id="rank"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customFile">Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="profile" onchange="load_image('profile', 'load_profile_picture')" id="profile" />
                                    <label class="custom-file-label" for="profile">Choose file</label>
                                </div>
                            </div>
                            <div id="load_profile_picture" class="mb-1"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text"
                                       class="form-control" name="email" id="email"  placeholder="john.doe@gmail.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="...................">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Re-Type Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="...................">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>