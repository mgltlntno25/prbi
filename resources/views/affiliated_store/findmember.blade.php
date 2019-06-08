

<img src="{{ url("/img/userdp/". $users->profile_image) }}"> <br>
{{$users->first_name}} <br>
{{$users->last_name}} <br>

@if($users->isPremium == 0)
NOT A PREMIUM MEMBER <br>
@else
PREMIUM MEMBER
@endif