<!DOCTYPE html>
<html>
<body>
    <p>Hello {{$fullname}},</p>
    <p>Welcome to the Vasco RX Patient Portal.</p>

    <p><a href="{{URL::route('email_verification',$verification_code)}}">Click on this link</a> to verify your email address and continue the registration process.</p>
    <p>
        Thanks & Regards
        <br>
        Vasco Rx
    </p>
</body>
</html>

