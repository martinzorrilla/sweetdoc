<?php get_header();/* Template Name: llamar pacientes*/
$audio_path = "http://appointments.asunciontasty.com/announcement-sound.mp3";
?>

    <!-- <button id="audioButton" type="button">Play Audio</button> -->
    <audio id="myAudio">
        <source src="<?= $audio_path ?>" type="audio/mpeg">
        <!-- <source src="http://appointments.asunciontasty.com/announcement-sound.mp3" type="audio/mpeg" /> -->
    </audio>

    <div class="large-spacer"></div>

    <div class="wrap"> 
        <h1 class="under font-bold">Doctora: Andrea Zorrilla</h1>
    </div>

    <div class="wrap" style="margin-top: 3em; margin-bottom: 3em;">
        <h2>Siguiente Paciente</h2>
    </div>

          
    <ul id="llamar-pacientes" style="list-style-type:none; margin-left: 0px;">
    </ul>

    <!-- <div class="wrap">
        <a href="#" class="btn btn-green">Pasar a Consultorio</a>
        <a href="#" class="btn btn-blue">Pasar a Consultorio</a>
        <a href="#" class="btn btn-yellow">Pasar a Consultorio</a>
        <a href="#" class="btn btn-red">Pasar a Consultorio</a>
    </div> -->

<?php get_footer(); ?>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=TSz0m51D"></script>



<!-- ATENCION! 
POR QUE AGRAGUE ESTE SCRIPT? todo el JS para manejar los eventos de esta pagina se encuentran ne "create-consultas-del-dia.js"
y de hecho, este codigo es una copia de una seccion de lo que hay ahi. la cuestion es que para poder hacer que al cargar esta pagina, obtenga la lista de pacientes de forma automatica, tenia que llamar a la funcion saveProfileData("cargar_consultas", "", ""); al iniciar el modulo, y por esto esta funcion era llamada en cualquier otra pagina al terminar de cargarse. lo que hacia que aveces genere un error del request y saltaba una alerta al navegar en cualquier otra pagina del sitio. 

Al hacerlo aca me aseguro que la primera llamada automatica se haga solamente al terminar de cargar ESTA pagina. -->
<script>
$(document).ready(function(){
   
    var patientTimestamp = 0;
    var firstTimeExecution = true;

    var closeSidebar = $("#close-sidebar");
    closeSidebar.trigger('click')
        
    var audioButton = $("#audioButton");
    var audio = $("#myAudio");
    audio[0].volume = 0.3;
    
    $("#overlay").fadeIn(300);
    loadNextPatient("get_patient", "", "");         

    // en este caso no importa el id ya que lo que voy a hacer es simplemente vaciar el archivo next-patient.txt
    $(document).on('click','.eliminar-paciente-llamado',function(){
        //   var data_id = $(this).data('id'); 
          // alert("Llamar al paciente: "+ data_id);
          $("#overlay").fadeIn(300);
          loadNextPatient("empty-file", "", "");         
        });
    
    

    // setInterval cada 10 segundos llama a la funcion que llama a loadNextPatient
    // no se puede llamar directamente a loadNextPatient xq falla por eso hice asi 
    setInterval(autoCallNextPatient,10000);
    function autoCallNextPatient(){
        if (firstTimeExecution == false) {
            loadNextPatient("get_patient", "", "")
        }
    }

    function playAudio() { 
        // audio.volume = 0.2;
        audio.trigger('play')
    } 

   function loadNextPatient(seleccion, patient_id, eliminar_paciente) {
      
      var $ = jQuery;
      var myData = 'foo=bar'+ '&action=' + 'sw_llamar_pacientes_ajax' + '&seleccion=' + seleccion + '&patient_id=' + patient_id + '&eliminar_paciente=' + eliminar_paciente;
      
      //var patientTimestamp = $('#eliminar-paciente-llamado').data('id'); 
      //alert("timestamp del frontend = " + patientTimestamp);

      $.ajax({
         type: "POST",
         url:window.homeUrl + "/wp-admin/admin-ajax.php",
         data: myData,
         dataType: "json",
         success: function(data) {

            if(data.error.length >0){
               if(data.error){
                //   alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> cargar consultas ');
                console.log("Error del request loadNextPatient. Revisar si el archivo nextPatient.txt esta vacio");
                firstTimeExecution = false;
                setTimeout(function(){
                $("#overlay").fadeOut(300);
                },500);
                }
            }
            else if(data.success && data.accion_inicial!= patientTimestamp ){
                // alert("hizo el ajax request y fue success");

                patientTimestamp = data.accion_inicial
                
                $('#llamar-pacientes').empty();

                $.each( data.msg, function( key, value ) {
                $('#llamar-pacientes').append(value);
                });

                setTimeout(function(){
                $("#overlay").fadeOut(300);
                },500);

                // llamo a la funcion para reproducir el sonido de anuncio para llamar al paciente. hay que habilitar en el navegador para que suene
                setTimeout(function(){
                    playAudio();
                },500);

                setTimeout(function(){
                    // if(responsiveVoice.voiceSupport()) {
                        var htmlString = $(".nombre-paciente").html();
                        // Used to add optional pitch (range 0 to 2), rate (range 0 to 1.5), volume (range 0 to 1) and callbacks.
                        // responsiveVoice.speak("Siguiente Paciente", "Spanish Female", {rate: 0.8, pitch: 0.5});
                        // responsiveVoice.speak(htmlString, "Spanish Female", {rate: 0.6, pitch: 0.5});

                        responsiveVoice.speak("Siguiente,Paciente", "Spanish Female");
                        responsiveVoice.speak(htmlString, "Spanish Female", {rate: 0.7, pitch: 1});
                    // }
                },4000);


                setTimeout(function(){
                    $( ".paciente-llamado" ).removeClass( "blink-bg" );
                },13000);

                firstTimeExecution = false;
            } //data.success
         },
         error: function() {
            // alert('No se pudo cargar las llamdas de paciente. JX');
            console.log('No se pudo cargar las consultas del dia');
         }
      });// $.ajax
      }

});

</script>