@component('mail::message')


@if($data['status']=='1')
Congratulation Letter:
@else
Regret Letter:
@endif
Hello! {{$data['name']}}, {{$data['company_name']}} company
has @if($data['status']=='0')
rejected
@else
accepted
@endif
you for the job with the reason {{$data['description']}}.
@component('mail::button', ['url' => $data['jobUrl']])
View Job
@endcomponent

Thanks,<br>
Jaagir
@endcomponent