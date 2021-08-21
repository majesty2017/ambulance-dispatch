<!-- Modal -->
<div class="modal fade" id="edit-e-request-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Emergency Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-e-request-form" action="{{ route('request.update') }}" method="post">
                    @csrf

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text"
                                       class="form-control" name="name" id="edit_name"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_phone">Phone</label>
                                <input type="text"
                                       class="form-control" name="phone" id="edit_phone"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_request_method">Request method</label>
                                <input type="text"
                                       class="form-control" name="request_method" id="edit_request_method"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_location">Location</label>
                                <input type="text"
                                       class="form-control" name="location" id="edit_location"  placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="edit_message">Message</label>
                            <div class="form-label-group mb-0">
                                <textarea
                                        data-length="1000"
                                        class="form-control char-textarea"
                                        id="edit_message"
                                        rows="3"
                                        name="message"
                                        placeholder="Message"
                                ></textarea>
                                <label for="textarea-counter">Message</label>
                            </div>
                            <small class="textarea-counter-value float-right"><span class="char-count">0</span> / 1000 </small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>