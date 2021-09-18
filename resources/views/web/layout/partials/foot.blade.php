<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
<script src="{{ asset('assets/js/toastr.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>



<script>
    $(document).ready(function() {
        $('.mydata-table').DataTable();
         $('form').validate({errorClass: "error fail-alert",
validClass: "valid success-alert",});
    });


$(document).ready(function() {


});

$(document).on('click','.cancel',function(){
    window.history.go(-1);
})


$('.delete').on('click', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure ?',
                text: "You won't be able to revert this !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).submit();
                }
            })
        });
$('.change').on('click', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure ?',
                text: "You won't be able to revert this !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace($(this).data('link'));
                    console.log($(this).data('link'));
                    // $(this).submit();
                }
            })
        });




</script>


@if ('admin.site.dash' == Route::currentRouteName() )

<script>

$(document).on('click','.cancel',function(){
    window.history.go(-1);
})

//     let scanner = new Instascan.Scanner({
//         video: document.getElementById('preview'),
//         mirror: false
//     });

//     $(document).on('click','.camera-source',function(){
//         CameraID = parseInt($(this).data('id'));
//         Instascan.Camera.getCameras().then(function(cameras) {
//         if (cameras.length > 0) {
//             console.log('After',cameras);

//             console.log('After',CameraID);
//             scanner.start(cameras[CameraID]);
//         } else {
//             alert('No cameras found');
//         }
//     }).catch(function(e) {
//         console.error(e);
//     });
//      });
//     Instascan.Camera.getCameras().then(function(cameras) {
//         if (cameras.length > 0) {
//             console.log('OnIntial Stage ',cameras);
//              scanner.start(cameras[0]);
//             cameras.map((camera,index)=> {
//                 $('#camera').append(`<button  data-id="${ index }"  class="camera-source btn btn-info btn-sm m-3">${camera.name}</button>`)
//             })
//         } else {
//             alert('No cameras found');
//         }



//     }).catch(function(e) {
//         console.error(e);
//     });

//     scanner.addListener('scan', function(c) {

//         $.ajax({
//             type: "POST"
//             , url: "/api/qrcode"
//             , data: {
//                 id: c
//             }
//             , beforeSend: function() {
//                 // search_button.attr("disabled", true);
//             }
//             , success: function(response) {
//                 console.log(response);
//                 if (response == '') {
//                     alert('Invalid Qr Code | Please try with vaild ID Card');
//                 } else {
//                     window.location = "/admin/manage/screening/" + response.id;
//                 }
//             }
//             , error: function(xhr, status, error) {
//                 console.error(error);
//             }
//         , });

//         // document.getElementById('text').value=c;
//     });


// // ------------- Jquery Form validation --------------



</script>

@endif
@include('web.layout.partials.alert');
