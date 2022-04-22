@component('mail::message')
Hi,{{$data['name']}} you have successfully applied for this job.
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
