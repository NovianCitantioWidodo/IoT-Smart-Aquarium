<?php
include 'connect.php';
// session_start();
// echo $_SESSION["username"];
// echo $_SESSION["password"];

// if (!isset($_SESSION["password"])) {
//     header("location:login.php");
// }
function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
        <!-- Favicon -->
        <link href="assets/img/leaf.png" rel="icon" type="image/png" />
        <link href="assets/css/argon-dashboard.css" rel="stylesheet" />
        <title>Monitoring</title>
    </head>
    <body class="">
        <video autoplay muted loop id="bgvideo">
            <source src="assets/img/bg.mp4" type="video/mp4">
        </video>
        <div class="main-content">
            <div class="container fixed-bottom">
                <div class="row">
                    
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <h1 class="mb-0 text-glow text-light">Real-Mi : Smart Aquarium</h1>
                                </div>
                                <div class="card bg-translucent-darker border-0 wow fadeInUp mb-3 col-12">
                                    <div class="card-body py-2">
                                        <div class="row">
                                            <div class="col-9">
                                                <h2 class="text-light mb-0">Mode Kontrol</h2>
                                            </div>
                                            <div class="col-3">
                                                <div class="input-slider pt-2">
                                                    <label class="custom-toggle m-0">
                                                        <input type="checkbox" aria-expanded="false" aria-controls="fnSmart" id="fnSmart" checked="">
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON">
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4 bg-translucent-darker border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 text-center wow fadeInUp">
                                                <h1 class="" id="warn1"><i id="icoPompa" class="text-light fa-tint-slash fa"></i></h1>
                                                <h1 class="display-4 text-light mb-0" id="utama"></h1>
                                                <h4 class=" text-muted mb-0 px-3">pompa</h4>
                                                <div class="input-slider py-2" id="kontrolPompa">
                                                    <label class="custom-toggle m-0">
                                                        <input type="checkbox" aria-expanded="false" aria-controls="fnPompa" id="fnPompa">
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center wow fadeInUp">
                                                <h1 class="" id="warn2"><i id="icoLampu" class="text-light fa text-glow fa-lightbulb"></i></h1>
                                                <h1 class="display-4 text-light mb-0" id="cadangan"></h1>
                                                <h4 class=" text-muted mb-0 px-3">lampu</h4>
                                                <div class="input-slider py-2" id="kontrolLampu">
                                                    <label class="custom-toggle m-0">
                                                        <input type="checkbox" aria-expanded="false" aria-controls="fnLampu" id="fnLampu" checked="">
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center wow fadeInUp">
                                                <h1 class="" id="warnpH"><i id="icoPakan" class="text-light fa-tint-slash fa"></i></h1>
                                                <h1 class="display-4 text-light mb-0" id="ph"></h1>
                                                <h4 class=" text-muted mb-0 px-3">pakan</h4>
                                                <div class="input-slider py-2">
                                                    <label class="custom-toggle m-0" id="kontrolPakan">
                                                        <input type="checkbox" aria-expanded="false" aria-controls="fnPakan" id="fnPakan">
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center bwh wow fadeInUp">
                                                <h1 class="text-light mb-0">
                                                <i class="fa fa-ruler-vertical"></i>
                                                </h1>
                                                <h1 class="display-4 text-light mb-0" id="jarak">3.51</h1>
                                                <h4 class=" text-muted mb-0 px-3">Air</h4>
                                            </div>
                                            <div class="col-4 text-center bwh wow fadeInUp">
                                                <h1 class="text-light mb-0">
                                                <i class="fa fa-thermometer-half"></i>
                                                </h1>
                                                <h1 class="display-4 text-light mb-0" id="suhu">0°C</h1>
                                                <h4 class=" text-muted mb-0 px-3">Suhu</h4>
                                            </div>
                                            <div class="col-4 text-center bwh wow fadeInUp">
                                                <h1 class="text-light mb-0">
                                                <i class="fa fa-sun"></i>
                                                </h1>
                                                <h1 class="display-4 text-light mb-0" id="intensitas">9</h1>
                                                <h4 class=" text-muted mb-0 px-3">Cahaya</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="preloader"></div>
        <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <script src="./assets/js/plugins/jquery/dist/jquery.min.js">
        </script>
        <script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js">
        </script>
        <script>
        $(window).on('load', function() {
        $('.preloader').fadeOut('slow');
        });
        </script>
        <script type="text/javascript">
        function done(){setTimeout(function(){update(),done()},3e3)}var statusPompa,statusLampu,statusPakan,statusAuto;function update(){$.getJSON("fetch.php",function(a){statusAuto=a.otomatis,statusPompa=a.pompa,statusLampu=a.lampu,statusPakan=a.pakan,statusSuhu=a.suhu,statusJarak=a.jarak,statusIntensitas=a.intensitas,$("#jarak").html(a.jarak),$("#suhu").html(a.suhu+"&degC"),$("#intensitas").html(a.intensitas),1==statusPompa?(idPompa.setAttribute("checked",""),$("#icoPompa").removeClass("fa fa-tint-slash"),$("#icoPompa").addClass("fa fa-tint text-glow")):(idPompa.removeAttribute("checked"),$("#icoPompa").removeClass("fa fa-tint text-glow"),$("#icoPompa").addClass("fa fa-tint-slash")),0==statusLampu?(idLampu.setAttribute("checked",""),$("#icoLampu").removeClass("far fa-lightbulb"),$("#icoLampu").addClass("fa fa-lightbulb text-glow")):(idLampu.removeAttribute("checked"),$("#icoLampu").removeClass("fa fa-lightbulb text-glow"),$("#icoLampu").addClass("far fa-lightbulb")),1==statusPakan?(idPakan.setAttribute("checked",""),$("#icoPakan").removeClass("fa fa-tint-slash"),$("#icoPakan").addClass("fa fa-tint text-glow")):(idPakan.removeAttribute("checked"),$("#icoPakan").removeClass("fa fa-tint text-glow"),$("#icoPakan").addClass("fa fa-tint-slash")),1==statusAuto?(idSmart.removeAttribute("checked"),$("#kontrolPompa").hide(),$("#kontrolLampu").hide(),$("#kontrolPakan").hide()):(idSmart.setAttribute("checked",""),$("#kontrolPompa").show(),$("#kontrolLampu").show(),$("#kontrolPakan").show())})}$(document).ready(function(){done()});var idPompa=document.getElementById("fnPompa"),idLampu=document.getElementById("fnLampu"),idPakan=document.getElementById("fnPakan"),idSmart=document.getElementById("fnSmart");$("#fnSmart").click(function(){$("#kontrolPompa").toggle(this.checked),$("#kontrolLampu").toggle(this.checked),$("#kontrolPakan").toggle(this.checked)}),idSmart.addEventListener("change",a=>{idSmart.checked?$.ajax({url:"get.php",type:"POST",data:{auto:0,sP:0,sL:1,sF:0},success:function(a){alert("Mode Manual")},error:function(a){alert("Periksa koneksi internet anda")}}):$.ajax({url:"get.php",type:"POST",data:{auto:1},success:function(a){alert("Mode Otomatis")},error:function(a){alert("Periksa koneksi internet anda")}})}),idPompa.addEventListener("change",a=>{var t=$("#icoPompa");idPompa.checked?$.ajax({url:"get.php",type:"POST",data:{sP:1,sL:statusLampu,sF:statusPakan},success:function(a){t.removeClass("fa fa-tint-slash"),t.addClass("fa fa-tint text-glow"),alert("Pompa nyala")},error:function(a){alert("Periksa koneksi internet anda")}}):$.ajax({url:"get.php",type:"POST",data:{sP:0,sL:statusLampu,sF:statusPakan},success:function(a){t.removeClass("fa fa-tint text-glow"),t.addClass("fa fa-tint-slash"),alert("Pompa mati")},error:function(a){alert("Periksa koneksi internet anda")}})}),idLampu.addEventListener("change",a=>{var t=$("#icoLampu");idLampu.checked?$.ajax({url:"get.php",type:"POST",data:{sL:0,sP:statusPompa,sF:statusPakan},success:function(a){t.removeClass("fa fa-lightbulb"),t.addClass("far fa-lightbulb text-glow"),alert("Lampu nyala")},error:function(a){alert("Periksa koneksi internet anda")}}):$.ajax({url:"get.php",type:"POST",data:{sL:1,sP:statusPompa,sF:statusPakan},success:function(a){t.removeClass("fa fa-lightbulb text-glow"),t.addClass("far fa-lightbulb"),alert("Lampu mati")},error:function(a){alert("Periksa koneksi internet anda")}})}),idPakan.addEventListener("change",a=>{var t=$("#icoPakan");idPakan.checked?$.ajax({url:"get.php",type:"POST",data:{sF:1,sP:statusPompa,sL:statusLampu},success:function(a){t.removeClass("fa fa-tint-slash"),t.addClass("fa fa-tint text-glow"),alert("Pakan dibuka")},error:function(a){alert("Periksa koneksi internet anda")}}):$.ajax({url:"get.php",type:"POST",data:{sF:0,sP:statusPompa,sL:statusLampu},success:function(a){t.removeClass("fa fa-tint text-glow"),t.addClass("fa fa-tint-slash"),alert("Pakan ditutup")},error:function(a){alert("Periksa koneksi internet anda")}})});
        </script>
        <!-- </body></html> -->
    </body>
</html>