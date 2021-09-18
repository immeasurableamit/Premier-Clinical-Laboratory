@extends('mail.layout')
@section('title', 'Email OTP verification')
@section('main')
 <div style="color:#00544f;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:1.5;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:20px;">
        <div class="txtTinyMce-wrapper"
            style="line-height: 1.5; font-size: 12px; color: #00544f; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px;">
            <p
                style="font-size: 30px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 45px; margin: 0;">
                <span style="font-size: 30px;"><strong><span style="">You have a new password! </span></strong></span>
            </p>
        </div>
    </div>
    <div
        style="color:#707070;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:2;padding-top:0px;padding-right:20px;padding-bottom:15px;padding-left:20px;">
        <div class="txtTinyMce-wrapper"
            style="line-height: 2; font-size: 12px; color: #707070; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 24px;">
            <p style="font-size: 14px; line-height: 2; word-break: break-word; text-align: left; mso-line-height-alt: 28px; margin: 0;">

                            OTP to register in covis app is , {{ $data['otp'] }}
                            <br>

            OTP verification is required to register in {{ config('app.name') }} 
<br>
        
<br>
            
            <br>
            If you have any concerns, please contact us at covis@covis.co.za <br>

<br>
           Covis Team
            </p>
        </div>
    </div>


@endsection


