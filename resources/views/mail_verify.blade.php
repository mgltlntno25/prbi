
<p>Thank you for Registering in Pinoy Road Bikers Inc. </p>
<p>To Access your account, you must verify your email first. To verify email please click the button to verify. </p>

<br>



<form action="{{url('/user/emailVerify)}}" method="post">
    {{ csrf_field() }}

        <input type="hidden" class="form-control" name="email" placeholder="Reference Number" value="{{$data['email']}}">
    
    <p align="center"><button type="submit" class="btn btn-success mb-2"><i class="fa fa-bank"></i> Verify Email</button>
    </p>
</form>








<br>

THANK YOU! 

<br>

