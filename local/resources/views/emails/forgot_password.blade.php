<p>
Dear {{$first_name .' '. $last_name}},
</p>

<p>
You have requested to reset your Vasco RX Patient Portal password.  Please <a href="{{URL::route('reset_password',$token)}}"> click here</a> to visit our website and create your new password. 
</p>

<p>
Thanks & Regards
<br>
Vasco Rx
</p>