@extends('cms.parent')


@section('page-name', __('cms.dashboard'))
@section('main-page', __('cms.app_name'))
@section('sub-page', __('cms.dashboard'))
@section('content')
    <!--begin::Dashboard-->
    <!--begin::Row-->

    @if (auth('admin')->check())
        @include('cms.indexes.admin')
    @endif

    @if (auth('doctor')->check())
        @include('cms.indexes.doctor')
    @endif


    @if (auth('user')->check())
        @include('cms.indexes.user')
    @endif
    <!--end::Dashboard-->
@endsection

@section('scripts')

    @if (auth('user')->check())
        <script>
            function save() {
                let formData = new FormData();

                formData.append('reason_appoitment', document.getElementById('reason').value);
                formData.append('doctor_id', document.getElementById('doctor_id').value);
                formData.append('file', document.getElementById('file').files[0]);

                store("{{ route('appointments.user.store') }}", formData, '/cms/user/');
            }


            async function getData() {
                let data = await axios.get("{{ route('appointments.user.index') }}")
                    .then((response) => {

                        if (response.data.status) {

                            return response.data.data;
                        }

                        return [];
                    });

                return data;
            }
            var KTCalendarBasic = function() {



                return {
                    //main function to initiate the module
                    init: async function() {


                        let data = await getData();

                        let evs = data.map((e) => {
                            return {
                                title: e.title,
                                start: e.start_date,
                                description: e.reason_appoitment,
                                end: e.end_date,
                                className: e.className
                            };
                        });


                        console.log(evs);


                        var todayDate = moment().startOf('day');
                        var YM = todayDate.format('YYYY-MM');
                        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                        var TODAY = todayDate.format('YYYY-MM-DD');
                        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                        var calendarEl = document.getElementById('kt_calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
                            themeSystem: 'bootstrap',

                            isRTL: KTUtil.isRTL(),

                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },

                            height: 800,
                            contentHeight: 780,
                            aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

                            nowIndicator: true,
                            now: TODAY + 'T09:25:00', // just for demo

                            views: {
                                dayGridMonth: {
                                    buttonText: 'month'
                                },
                                timeGridWeek: {
                                    buttonText: 'week'
                                },
                                timeGridDay: {
                                    buttonText: 'day'
                                }
                            },

                            defaultView: 'dayGridMonth',
                            defaultDate: TODAY,

                            editable: true,
                            eventLimit: true, // allow "more" link when too many events
                            navLinks: true,
                            events: evs,

                            eventRender: function(info) {
                                var element = $(info.el);

                                if (info.event.extendedProps && info.event.extendedProps.description) {
                                    if (element.hasClass('fc-day-grid-event')) {
                                        element.data('content', info.event.extendedProps.description);
                                        element.data('placement', 'top');
                                        KTApp.initPopover(element);
                                    } else if (element.hasClass('fc-time-grid-event')) {
                                        element.find('.fc-title').append(
                                            '<div class="fc-description">' +
                                            info.event.extendedProps.description + '</div>');
                                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                        element.find('.fc-list-item-title').append(
                                            '<div class="fc-description">' + info.event
                                            .extendedProps
                                            .description + '</div>');
                                    }
                                }
                            }
                        });

                        calendar.render();
                    }
                };
            }();

            jQuery(document).ready(function() {
                KTCalendarBasic.init();
            });
        </script>
    @endif

@endsection
