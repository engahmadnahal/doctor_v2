<div class="card card-custom gutter-b p-5">

    <!-- Modal-->
    <div class="modal fade" id="add_new" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <!--begin::Form group-->
                        <div class="form-group col-12">
                            <label class="font-size-h6 font-weight-bolder text-dark">Reason: <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                type="text" name="reason" id="reason" autocomplete="off" placeholder="reason" />
                        </div>
                        <!--end::Form group-->

                        <div class="form-group row mt-4 col-12">
                            <label class="col-3 col-form-label">Doctors :<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" id="doctor_id"
                                        title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        @foreach ($doctors as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{ __('cms.please_select') }}
                                    Doctors</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Files</label>
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                type="file" name="file" id="file" autocomplete="off" placeholder="files" accept=".pdf"/>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal"
                        onclick="save()">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                   Appointments
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="#" class="btn btn-light-primary font-weight-bold" data-toggle="modal"
                    data-target="#add_new">
                    <i class="ki ki-plus "></i> Add Event
                </a>
            </div>
        </div>
        <div class="card-body">
            <div id="kt_calendar"></div>
        </div>
    </div>
</div>
