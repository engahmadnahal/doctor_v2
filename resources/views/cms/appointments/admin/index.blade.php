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
                                Patients
                            </th>
                            <th style="min-width: 150px"> Doctor</th>
                            <th style="min-width: 150px"> Mobile</th>
                            <th style="min-width: 150px"> Email</th>
                            <th style="min-width: 130px">Reason</th>
                            <th style="min-width: 130px">Date</th>
                            <th style="min-width: 130px">Reject Reason</th>
                            <th style="min-width: 130px">file</th>
                            <th style="min-width: 130px">Status</th>
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
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $d->doctor?->name }}</a>
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
