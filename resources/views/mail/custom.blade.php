@extends('mail.layout')
@section('title', 'Covis App')
@section('main')
 <div style="color:#00544f;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:1.5;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:20px;">
        <div class="txtTinyMce-wrapper"
            style="line-height: 1.5; font-size: 12px; color: #00544f; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px;">
            <p
                style="font-size: 30px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 45px; margin: 0;">
                <span style="font-size: 30px;"><strong><span style=""> </span></strong></span>
            </p>
        </div>
    </div>
    <div
        style="color:#707070;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;line-height:2;padding-top:0px;padding-right:20px;padding-bottom:15px;padding-left:20px;">
        <div class="txtTinyMce-wrapper"
            style="line-height: 2; font-size: 12px; color: #707070; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 24px;">
            <p style="font-size: 14px; line-height: 2; word-break: break-word; text-align: left; mso-line-height-alt: 28px; margin: 0;">
                {{ $data['message'] }}


            </p>
        </div>
    </div>

@endsection


