<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date_time' => $this->date . ' ' . $this->time,
            'start_date' => $this->status == 'pending' ? Carbon::now()->format('Y-m-d') : $this->date,
            'end_date' => $this->status == 'pending' ? Carbon::now()->addDays(1)->format('Y-m-d') : Carbon::parse($this->date)->addDays(2),
            'time' => $this->time,
            'status' => $this->status,
            'file' => Storage::url($this->file),
            'is_note' => !is_null($this->note),
            'note' => $this->note,
            'reason_appoitment' => $this->reason_appoitment,
            'reject_reason' => $this->reject_reason,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'className' => $this->classNameStatus(),
            'title' => $this->titleApp(),
            'doctor' => [
                'name' => $this->doctor?->name,
                'mobile' => $this->doctor?->mobile
            ],
        ];
    }


    private function titleApp()
    {
        if ($this->status == 'accept') {
            return 'Accept Appointment';
        }

        if ($this->status == 'pending') {
            return 'Waiting Appointment';
        }

        return 'Reject Appointment';
    }

    private function classNameStatus()
    {
        if ($this->status == 'accept') {
            return 'fc-event-success';
        }

        if ($this->status == 'pending') {
            return 'fc-event-warning';
        }

        return 'fc-event-danger';
    }
}
