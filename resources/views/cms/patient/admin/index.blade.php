@extends('cms.parent')

@section('page-name', 'Patients')
@section('main-page', __('cms.settings'))
@section('sub-page', 'Patients')
@section('page-name-small', __('cms.index'))

@section('styles')

@endsection

@section('content')
    <!--begin::Advance Table Widget 5-->
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Patients </span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
            </h3>


            <div class="card-toolbar">
                <a href="#" class="btn btn-light-primary font-weight-bold" data-toggle="modal" data-target="#add_new">
                    <i class="ki ki-plus "></i> Add New
                </a>
            </div>



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
                                    <label class="font-size-h6 font-weight-bolder text-dark">Name</label>
                                    <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                        type="text" name="name" id="name" autocomplete="off"
                                        placeholder="Name" />
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->


                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group col-12">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                    <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                        type="text" name="email" id="email" autocomplete="off"
                                        placeholder="Email" />
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->


                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group col-12">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Mobile</label>
                                    <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                        type="text" name="mobile" id="mobile" autocomplete="off"
                                        placeholder="mobile" />
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->



                                <div class="separator separator-dashed my-10"></div>

                                <div class="row">

                                    <div class="form-group col-6">
                                        <label class="col-12 col-form-label">Avater:</label>
                                        <div class="col-9">
                                            <div class="image-input image-input-empty image-input-outline" id="avater_1"
                                                style="background-image: url({{ asset('assets/media/users/blank.png') }})">
                                                <div class="image-input-wrapper"></div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="image" id="avater"
                                                        accept=".png, .jpg, .jpeg">
                                                    <input type="hidden" name="image">
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title=""
                                                    data-original-title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="remove" data-toggle="tooltip" title=""
                                                    data-original-title="Remove avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

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


        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center"
                    id="kt_advance_table_widget_2">
                    <thead>
                        <tr class="text-left text-uppercase">
                            <th style="min-width: 150px">
                                User Name
                            </th>
                            <th style="min-width: 150px">User Mobile</th>
                            <th style="min-width: 150px">User Email</th>
                            <th style="min-width: 130px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $d->name }}</a>
                                </td>
                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $d->mobile }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $d->email }}</span>
                                </td>

                                <td>
                                    <a href="{{ route('patients.user-data', $d->id) }}"
                                        class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <span
                                                class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Download.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <rect fill="#000000" opacity="0.3"
                                                            transform="translate(12.000000, 8.000000) rotate(-180.000000) translate(-12.000000, -8.000000) "
                                                            x="11" y="1" width="2" height="14" rx="1" />
                                                        <path
                                                            d="M7.70710678,15.7071068 C7.31658249,16.0976311 6.68341751,16.0976311 6.29289322,15.7071068 C5.90236893,15.3165825 5.90236893,14.6834175 6.29289322,14.2928932 L11.2928932,9.29289322 C11.6689749,8.91681153 12.2736364,8.90091039 12.6689647,9.25670585 L17.6689647,13.7567059 C18.0794748,14.1261649 18.1127532,14.7584547 17.7432941,15.1689647 C17.3738351,15.5794748 16.7415453,15.6127532 16.3310353,15.2432941 L12.0362375,11.3779761 L7.70710678,15.7071068 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(12.000004, 12.499999) rotate(-180.000000) translate(-12.000004, -12.499999) " />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                        </span>
                                    </a>


                                    <!-- Modal-->
                                    <div class="modal fade" id="update_doctor_{{ $d->id }}" data-backdrop="static"
                                        tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">


                                                        <!--begin::Form group-->
                                                        <div class="form-group col-12">
                                                            <label
                                                                class="font-size-h6 font-weight-bolder text-dark">Name</label>
                                                            <input
                                                                class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                                                type="text" name="name_{{ $d->id }}"
                                                                value="{{ $d->name }}" id="name_{{ $d->id }}"
                                                                autocomplete="off" placeholder="Name" />
                                                        </div>
                                                        <!--end::Form group-->
                                                        <!--begin::Form group-->


                                                        <!--begin::Title-->
                                                        <!--begin::Form group-->
                                                        <div class="form-group col-12">
                                                            <label
                                                                class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                                            <input
                                                                class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                                                type="text" name="email_{{ $d->id }}"
                                                                value="{{ $d->email }}"
                                                                id="email_{{ $d->id }}" autocomplete="off"
                                                                placeholder="Email" />
                                                        </div>
                                                        <!--end::Form group-->
                                                        <!--begin::Form group-->


                                                        <!--begin::Title-->
                                                        <!--begin::Form group-->
                                                        <div class="form-group col-12">
                                                            <label
                                                                class="font-size-h6 font-weight-bolder text-dark">Mobile</label>
                                                            <input
                                                                class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                                                type="text" name="mobile_{{ $d->id }}"
                                                                value="{{ $d->mobile }}"
                                                                id="mobile_{{ $d->id }}" autocomplete="off"
                                                                placeholder="mobile" />
                                                        </div>
                                                        <!--end::Form group-->
                                                        <!--begin::Form group-->


                                                        <div class="separator separator-dashed my-10"></div>

                                                        <div class="row">

                                                            <div class="form-group col-6">
                                                                <label class="col-12 col-form-label">Avater:</label>
                                                                <div class="col-9">
                                                                    <div class="image-input image-input-empty image-input-outline"
                                                                        id="avater_1_{{ $d->id }}"
                                                                        style="background-image: url({{ \Storage::url($d->avater) }})">
                                                                        <div class="image-input-wrapper"></div>

                                                                        <label
                                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                            data-action="change" data-toggle="tooltip"
                                                                            title=""
                                                                            data-original-title="Change avatar">
                                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                                            <input type="file" name="image"
                                                                                id="avater_{{ $d->id }}"
                                                                                accept=".png, .jpg, .jpeg">
                                                                            <input type="hidden" name="image">
                                                                        </label>

                                                                        <span
                                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                            data-action="cancel" data-toggle="tooltip"
                                                                            title=""
                                                                            data-original-title="Cancel avatar">
                                                                            <i
                                                                                class="ki ki-bold-close icon-xs text-muted"></i>
                                                                        </span>

                                                                        <span
                                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                            data-action="remove" data-toggle="tooltip"
                                                                            title=""
                                                                            data-original-title="Remove avatar">
                                                                            <i
                                                                                class="ki ki-bold-close icon-xs text-muted"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary font-weight-bold"
                                                        data-dismiss="modal"
                                                        onclick="update({{ $d->id }})">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3"
                                        data-toggle="modal" data-target="#update_doctor_{{ $d->id }}">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                    <path
                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm"
                                        onclick="deleteUser({{ $d->id }},this)">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                    <path
                                                        d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                        fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 5-->
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script>
            var avater = new KTImageInput('avater_1');

        @foreach ($data as $d)

            var avater{{ $d->id }} = new KTImageInput('avater_1_{{ $d->id }}');
        @endforeach

        function save() {
            let formData = new FormData();

            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('avater', document.getElementById('avater').files[0]);

            store("{{ route('patients.admin.store') }}", formData, "{{ route('patients.admin.index') }}");
        }

        function update(id) {
            let formData = new FormData();

            formData.append('name', document.getElementById('name_' + id).value);
            formData.append('email', document.getElementById('email_' + id).value);
            formData.append('mobile', document.getElementById('mobile_' + id).value);
            formData.append('avater', document.getElementById('avater_' + id).files ? document.getElementById('avater_' +
                id).files[0] : '');


            store("/cms/admin/patients/" + id, formData, "{{ route('patients.admin.index') }}");
        }

        function deleteUser(id, el) {

            confirmDestroy("/cms/admin/patients/", id, el);
        }
    </script>
@endsection
