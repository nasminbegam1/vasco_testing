<!DOCTYPE html>
<html>
<body>
    <p>Hello {{$fullname}},</p>
    <p>Welcome to the Vasco RX Patient Portal, where you can manage the contact and billing information we have on file for you, as well as let us know of your current medications, allergies,
    and medical conditions, so that we can provide you the best possible service.</p>

    <p><a href="{{URL::route('email_verification',$verification_code)}}">Click on this link</a> to verify your email address and continue the registration process.</p>
    <p>
        Thanks & Regards
        <br>
        Vasco Rx
    </p>
</body>
</html>

