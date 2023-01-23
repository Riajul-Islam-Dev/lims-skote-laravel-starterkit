<div class="container">
    <div class="modal fade" id="showUserModal" tabindex="-1" aria-labelledby="showUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body pb-0">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-lg-12 mb-4 mb-lg-0">
                            <div class="card mb-3" style="border-radius: .5rem;">
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white bg-body"
                                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                        <img src="" alt="Avatar" class="img-fluid my-5 user_avatar"
                                            style="width: 80px;" />
                                        <h5 class="text-dark user_name"></h5>
                                        <p class="text-dark user_role_name"></p>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-4">
                                            <h6>Information</h6>
                                            <hr class="mt-0 mb-4">
                                            <div class="row pt-1">
                                                <div class="col-6 mb-3">
                                                    <h6>ID</h6>
                                                    <p class="text-muted user_id"></p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <h6>Email</h6>
                                                    <p class="text-muted user_email"></p>
                                                </div>
                                            </div>
                                            <div class="row pt-1">
                                                <div class="col-6 mb-3">
                                                    <h6>Date of Birth</h6>
                                                    <p class="user_dob"></p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <h6>Status</h6>
                                                    <p class="user_status"></p>
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-sm btn-danger btn-label float-end mb-2"
                                                data-bs-dismiss="modal"><i class="bx bx-window-close label-icon"></i>
                                                Close</button>
                                            <form action="{{ route('viewPDF') }}" method="POST" target="_blank">
                                                @csrf
                                                <div>
                                                    <input type="hidden" name="user_id" class="user_pdf">
                                                    <button
                                                        class="btn btn-sm btn-info waves-effect btn-label waves-light float-end mb-2 me-2"><i
                                                            class="bx bx-printer label-icon"></i> View PDF</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
