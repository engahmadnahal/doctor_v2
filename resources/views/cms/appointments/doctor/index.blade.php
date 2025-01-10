@extends('cms.parent')

@section('page-name', 'Appointments')
@section('main-page', __('cms.settings'))
@section('sub-page', 'Appointments')
@section('page-name-small', __('cms.index'))

@section('styles')

@endsection

@section('content')
    <!--begin::Advance Table Widget 5-->
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Appointments </span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
            </h3>

            {{-- <div class="card-toolbar">
                <a href="{{ route('currencies.create') }}"
                    class="btn btn-info font-weight-bolder font-size-sm mr-2">{{ __('cms.create') }}</a>
            </div> --}}
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
                                Name
                            </th>
                            <th style="min-width: 150px"> Mobile</th>
                            <th style="min-width: 150px"> Email</th>
                            <th style="min-width: 130px">Reason</th>
                            <th style="min-width: 130px">Date</th>
                            <th style="min-width: 130px">Reject Reason</th>
                            <th style="min-width: 130px">file</th>
                            <th style="min-width: 130px">Status</th>
                            <th style="min-width: 130px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $d->user?->name }}</a>
                                </td>
                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $d->user?->mobile }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $d->user?->email }}</span>
                                </td>

                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $d->reason_appoitment }}</span>
                                </td>

                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ \Carbon::parse($d->date)->format('Y-m-d h:i') }}</span>
                                </td>

                                <td>
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $d->reject_reason }}</span>
                                </td>

                                <td>
                                    <a class="btn btn-icon btn-light btn-hover-primary btn-sm"
                                        href="{{ \Storage::url($d->file) }}" target="_blank">

                                        <span
                                            class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Arrow-down.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <rect fill="#000000" opacity="0.3" x="11" y="5" width="2"
                                                        height="14" rx="1" />
                                                    <path
                                                        d="M6.70710678,18.7071068 C6.31658249,19.0976311 5.68341751,19.0976311 5.29289322,18.7071068 C4.90236893,18.3165825 4.90236893,17.6834175 5.29289322,17.2928932 L11.2928932,11.2928932 C11.6714722,10.9143143 12.2810586,10.9010687 12.6757246,11.2628459 L18.6757246,16.7628459 C19.0828436,17.1360383 19.1103465,17.7686056 18.7371541,18.1757246 C18.3639617,18.5828436 17.7313944,18.6103465 17.3242754,18.2371541 L12.0300757,13.3841378 L6.70710678,18.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(12.000003, 14.999999) scale(1, -1) translate(-12.000003, -14.999999) " />
                                                </g>
                                            </svg><!--end::Svg Icon--></span>
                                    </a>
                                </td>

                                <td>
                                    <span
                                        class="label label-lg 
                                    @if ($d->status == 'accept') label-light-success 
                                    @elseif($d->status == 'pending')
                                    label-light-wait 
                                    @elseif($d->status == 'close')
                                    label-light-success 
                                    @else 
                                    label-light-danger @endif 
                                    label-inline">
                                        {{ $d->status }}
                                    </span>
                                </td>

                                <td>

                                    @if ($d->status == 'pending')
                                        <!-- Modal-->
                                        <div class="modal fade" id="accept_{{ $d->id }}" data-backdrop="static"
                                            tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Accept</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!--begin::Form group-->
                                                            <div class="form-group col-6">
                                                                <label
                                                                    class="font-size-h6 font-weight-bolder text-dark">Date</label>
                                                                <input
                                                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                                                    type="date" name="date_{{ $d->id }}"
                                                                    id="date_{{ $d->id }}" autocomplete="off"
                                                                    placeholder="date" />
                                                            </div>
                                                            <!--end::Form group-->

                                                            <!--begin::Form group-->
                                                            <div class="form-group col-6">
                                                                <label
                                                                    class="font-size-h6 font-weight-bolder text-dark">Time</label>
                                                                <input
                                                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
                                                                    type="time" name="time_{{ $d->id }}"
                                                                    id="time_{{ $d->id }}" autocomplete="off"
                                                                    placeholder="time" />
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <div class="row">
                                                            <textarea id="note_{{ $d->id }}" cols="30" rows="10"
                                                                class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-primary font-weight-bold"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary font-weight-bold"
                                                            data-dismiss="modal"
                                                            onclick="accept({{ $d->id }})">Accept</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm"
                                            data-toggle="modal" data-target="#accept_{{ $d->id }}">
                                            <span
                                                class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Check.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path
                                                            d=" M6.26193932,17.6476484 C5.90425297,18.0684559
                                                                5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253
                                                                4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158
                                                                C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068
                                                                L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811
                                                                19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273
                                                                17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) " />
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                        </a>


                                        <!-- Modal-->
                                        <div class="modal fade" id="reject_{{ $d->id }}" data-backdrop="static"
                                            tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea id="reason_{{ $d->id }}" cols="30" rows="10"
                                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-light-primary font-weight-bold"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary font-weight-bold"
                                                            data-dismiss="modal"
                                                            onclick="reject({{ $d->id }})">Reject</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm"
                                            data-toggle="modal" data-target="#reject_{{ $d->id }}">
                                            <span
                                                class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                                            fill="#000000">
                                                            <rect x="0" y="7" width="16" height="2"
                                                                rx="1" />
                                                            <rect opacity="0.3"
                                                                transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                                                x="0" y="7" width="16" height="2"
                                                                rx="1" />
                                                        </g>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                        </a>
                                    @endif

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
        function accept(id) {
            console.log(document.getElementById('note_' + id).value);
            store("{{ route('appointments.accept') }}", {
                'appointment_id': id,
                'note': document.getElementById('note_' + id).value,
                'date': document.getElementById('date_' + id).value,
                'time': document.getElementById('time_' + id).value,
            })
        }


        function reject(id) {
            console.log(document.getElementById('reason_' + id).value);

            store("{{ route('appointments.reject') }}", {
                'appointment_id': id,
                'reason': document.getElementById('reason_' + id).value,
            })
        }
    </script>
@endsection
