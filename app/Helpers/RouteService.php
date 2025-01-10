<?php

namespace App\Helpers;

class RouteService
{
    public static function routes()
    {
        return [

            // Admin

            "Appointments" => [
                'is_show' => auth('admin')->check(),
                'route_group' => [
                    [
                        'groupTitle' => 'Appointments',
                        'routes' => [
                            [
                                'title' => 'index',
                                'route' => route('appointments.admin.index'),
                                'permission' => '',
                                'active' => request()->routeIs('appointments.admin.index'),

                            ],

                        ],
                    ]
                ],
            ],

            "Users" => [
                'is_show' => auth('admin')->check(),
                'route_group' => [
                    [
                        'groupTitle' => 'Patients',
                        'routes' => [
                            [
                                'title' => 'index',
                                'route' => route('patients.admin.index'),
                                'permission' => '',
                                'active' => request()->routeIs('patients.admin.index'),

                            ],

                        ],
                    ],
                    [
                        'groupTitle' => 'Doctor',
                        'routes' => [
                            [
                                'title' => 'index',
                                'route' => route('doctor.admin.index'),
                                'permission' => '',
                                'active' => request()->routeIs('doctor.admin.index'),

                            ],

                        ],
                    ]
                ],
            ],

            // Doctor

            "Controller" => [
                'is_show' => auth('doctor')->check(),
                'route_group' => [
                    [
                        'groupTitle' => 'Appointments',
                        'permissions' => [],
                        'routes' => [
                            [
                                'title' => 'index',
                                'route' => route('appointments.index'),
                                'permission' => '',
                                'active' => request()->routeIs('appointments.index'),

                            ],

                        ],
                    ]
                ],
            ],

            "HR" => [
                'is_show' => auth('doctor')->check(),
                'route_group' => [
                    [
                        'groupTitle' => 'Patients',
                        'permissions' => [],
                        'routes' => [
                            [
                                'title' => 'index',
                                'route' => route('patients.index'),
                                'permission' => '',
                                'active' => request()->routeIs('patients.index'),

                            ],

                        ],
                    ]
                ],
            ],



        ];
    }
}
