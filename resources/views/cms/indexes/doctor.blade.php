<div class="card card-custom gutter-b p-5">

    <div class="row">
        <div class="col-xl-3">
            <!--begin::Stats Widget 13-->
            <a class="card card-custom bg-light-primary bg-hover-state-light-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    </span>
                    <div class="text-primary font-weight-bolder font-size-h6 mb-2 mt-5">
                        Patients:
                        {{$users}}
                    </div>

                </div>
                <!--end::Body-->
            </a>
            <!--end::Stats Widget 13-->
        </div>
        <div class="col-xl-3">
            <!--begin::Stats Widget 13-->
            <a class="card card-custom bg-light-primary bg-hover-state-light-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Timer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z" fill="#000000" opacity="0.3"/>
                            <path d="M13,5.06189375 C12.6724058,5.02104333 12.3386603,5 12,5 C11.6613397,5 11.3275942,5.02104333 11,5.06189375 L11,4 L10,4 C9.44771525,4 9,3.55228475 9,3 C9,2.44771525 9.44771525,2 10,2 L14,2 C14.5522847,2 15,2.44771525 15,3 C15,3.55228475 14.5522847,4 14,4 L13,4 L13,5.06189375 Z" fill="#000000"/>
                            <path d="M16.7099142,6.53272645 L17.5355339,5.70710678 C17.9260582,5.31658249 18.5592232,5.31658249 18.9497475,5.70710678 C19.3402718,6.09763107 19.3402718,6.73079605 18.9497475,7.12132034 L18.1671361,7.90393167 C17.7407802,7.38854954 17.251061,6.92750259 16.7099142,6.53272645 Z" fill="#000000"/>
                            <path d="M11.9630156,7.5 L12.0369844,7.5 C12.2982526,7.5 12.5154733,7.70115317 12.5355117,7.96165175 L12.9585886,13.4616518 C12.9797677,13.7369807 12.7737386,13.9773481 12.4984096,13.9985272 C12.4856504,13.9995087 12.4728582,14 12.4600614,14 L11.5399386,14 C11.2637963,14 11.0399386,13.7761424 11.0399386,13.5 C11.0399386,13.4872031 11.0404299,13.4744109 11.0414114,13.4616518 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    <div class="text-inverse-light-primary font-weight-bolder font-size-h6 mb-2 mt-5">
                        Appointments :
                        {{$appointments->count()}}
                    </div>

                </div>
                <!--end::Body-->
            </a>
            <!--end::Stats Widget 13-->
        </div>


    </div>



    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-0 pb-3">
        <div class="tab-content">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                    <thead>
                        <tr class="text-left text-uppercase">
                            <th style="min-width: 250px" class="pl-7">
                                <span class="text-dark-75">User Name</span>
                            </th>
                            <th style="min-width: 150px">User Mobile</th>
                            <th style="min-width: 150px">User Email</th>
                            <th style="min-width: 130px">Reason Appointment</th>
                            <th style="min-width: 130px">file</th>
                            <th style="min-width: 130px">Reject Reason</th>
                            <th style="min-width: 130px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $data)
                            <tr>
                                <td class="pl-0">
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $data->user?->name }}</a>
                                </td>
                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $data->user?->mobile }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $data->user?->email }}</span>
                                </td>

                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $data->reason_appoitment }}</span>
                                </td>

                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $data->reject_reason }}</span>
                                </td>

                                <td>
                                    <a href="{{ \Storage::url($data->file) }}" target="_blank">
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">File</span>
                                    </a>
                                </td>

                                <td>
                                    <span
                                        class="label label-lg 
                                    @if ($data->status == 'accept') label-light-success 
                                    @elseif($data->status == 'pending')
                                    label-light-wait 
                                    @elseif($data->status == 'close')
                                    label-light-success 
                                    @else 
                                    label-light-danger @endif 
                                    label-inline">
                                        {{ $data->status }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Body-->

</div>
<!--end::Row-->
