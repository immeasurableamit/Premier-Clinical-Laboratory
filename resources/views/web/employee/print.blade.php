@extends('web.layout.print')
@section('Title','Print  ')

<style>
    .container-fluid.icard {
        padding: 50px;
        height: 100vh;
        width: 100%;
        /* display: flex; */
        background-color: #e6ebe0;
        flex-direction: row;
        flex-flow: wrap;
    }

    .font {
        height: 375px;
        width: 250px;
        position: relative;
        border-radius: 10px;
    }

    .top {
        height: 20%;
        width: 100%;
        background-color: #8338ec;
        position: relative;
        z-index: 5;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .bottom {
        height: 80%;
        width: 100%;
        background-color: white;
        position: relative;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .top img {
        height: 100px;
        width: 100px;
        background-color: #e6ebe0;
        border-radius: 10px;
        position: absolute;
        top: 30px;
        left: 75px;
    }

    .bottom p {
        position: relative;
        top: 60px;
        text-align: center;
        text-transform: capitalize;
        font-weight: bold;
        font-size: 20px;
        text-emphasis: spacing;
    }

    .bottom .desi {
        font-size: 12px;
        color: grey;
        font-weight: normal;
    }

    .bottom .no {
        font-size: 15px;
        font-weight: normal;
    }

    .barcode img {
        height: 65px;
        width: 65px;
        text-align: center;
        margin: 5px;
    }

    .barcode {
        text-align: center;
        position: relative;
        top: 70px;
    }

    .back {
        height: 375px;
        width: 250px;
        border-radius: 10px;
        background-color: #8338ec;
    }

    .qr img {
        height: 80px;
        width: 100%;
        margin: 20px;
        background-color: white;
    }

    .Details {
        color: white;
        text-align: center;
        padding: 10px;
        font-size: 25px;
    }

    .details-info {
        color: white;
        text-align: left;
        padding: 5px;
        line-height: 20px;
        font-size: 16px;
        text-align: center;
        margin-top: 20px;
        line-height: 22px;
    }

    .logo {
        height: 40px;
        width: 150px;
        padding: 40px;
    }

    .logo img {
        height: 100%;
        width: 100%;
        color: white;
    }

    .padding {
        padding-right: 20px;
    }

    @media screen and (max-width:400px) {
        .container {
            height: 130vh;
        }
        .container .front {
            margin-top: 50px;
        }
    }

    @media screen and (max-width:600px) {
        .container {
            height: 130vh;
        }
        .container .front {
            margin-top: 50px;
        }
    }
</style>

@section('main')


<div class="container-fluid icard">
    <div class="padding emp-card text-center">
        <div class="font">
            <div class="top">
                <img src="{{ $item->image }}">
            </div>
            <div class="bottom">
                <p>{{ $item->name }}</p>
                <p class="desi">{{ $item->email }}</p>
                <div  style="width:75px; height:100px; margin:auto;" id="qrcode" class="barcode">

                </div>
                <br>
                <p class="no"> {{ $item->phone }}</p>
                <p class="no">ID : {{ $item->EmployeeID() }}</p>
            </div>
            {{-- <button class="btn btn-info mt-4"> Attach package</button> --}}
        </div>

    </div>

</div>

<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 100,
	height : 100
});

function makeCode () {
	qrcode.makeCode('{{ base64_encode($item->id) }}');
}

makeCode();

</script>

@endsection



