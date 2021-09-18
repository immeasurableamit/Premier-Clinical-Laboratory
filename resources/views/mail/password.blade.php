@extends('mail.layout')


@section('title', 'Welcome to Covis APP '  )


@section('main')
<div style="color:#00544f;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:1.5;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:20px;">
    <div class="txtTinyMce-wrapper" style="line-height: 1.5; font-size: 12px; color: #00544f; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px;">
        <p style="font-size: 30px; line-height: 1.5; word-break: break-word; text-align: center; mso-line-height-alt: 45px; margin: 0;">
            <span style="font-size: 20px;"><strong><span style="">Your Login details have been created and are below :</span></strong></span>
        </p>
    </div>
</div>
<br>
<div style="color:#707070;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:2;padding-top:0px;padding-right:20px;padding-bottom:15px;padding-left:20px;">
    <div class="txtTinyMce-wrapper" style="line-height: 2; font-size: 12px; color: #707070; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 24px;">
        <p style="font-size: 14px; line-height: 2; word-break: break-word; text-align: center; mso-line-height-alt: 28px; margin: 0;">
            <span style="">Welcome to COVIS  Portal. Your  account was created by Covis Admin.</span>
        </p>
    </div>
</div>
<div style="color:#707070;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:2;padding-top:0px;padding-right:20px;padding-bottom:15px;padding-left:20px;">
    <div class="txtTinyMce-wrapper" style="line-height: 2; font-size: 12px; color: #707070; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 24px;">
        <p style="font-size: 14px; line-height: 2; word-break: break-word; text-align: left; mso-line-height-alt: 28px; margin: 0;">
            <span style="">
                Login Details :  <Br></Br>
            </span>
            Email : <strong>{{ $data['email'] }}</strong>
            <br>
            Password : <strong>{{ $data['password'] }}</strong>
        </p>
    </div>
</div>


<div align="left" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:20px;">
    <a href="{{ route('login.view') }}" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #00544f; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width: auto; width: auto; border-top: 1px solid #00544F; border-right: 1px solid #00544F; border-bottom: 1px solid #00544F; border-left: 1px solid #00544F; padding-top: 5px; padding-bottom: 5px; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:30px;padding-right:30px;font-size:16px;display:inline-block;letter-spacing:undefined;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">
                Click here to login
            </span></span></a>

</div>
@endsection
