<?php get_header();/* Template Name: llamar pacientes*/
$audio_path = "http://appointments.asunciontasty.com/announcement-sound.mp3";
?>


    <!-- <div data-closable class="callout alert-callout-border secondary text-center blink-bg"> -->
    <div data-closable class="callout alert-callout-border secondary text-center">
        <h3>Siguiente Paciente</h3>
    </div>
          
    <ul id="llamar-pacientes" style="list-style-type:none; margin-left: 0px;">
    </ul>

    <!-- <button id="audioButton" type="button">Play Audio</button> -->
    <audio id="myAudio">
        <source src="<?= $audio_path ?>" type="audio/mpeg">
        <!-- <source src="http://appointments.asunciontasty.com/announcement-sound.mp3" type="audio/mpeg" /> -->
        <!-- <source src="http://dl.dropbox.com/u/1538714/article_resources/song.ogg" type="audio/ogg" /> -->
    </audio>





<?php get_footer(); ?>


<!-- ATENCION! 
POR QUE AGRAGUE ESTE SCRIPT? todo el JS para manejar los eventos de esta pagina se encuentran ne "create-consultas-del-dia.js"
y de hecho, este codigo es una copia de una seccion de lo que hay ahi. la cuestion es que para poder hacer que al cargar esta pagina, obtenga la lista de pacientes de forma automatica, tenia que llamar a la funcion saveProfileData("cargar_consultas", "", ""); al iniciar el modulo, y por esto esta funcion era llamada en cualquier otra pagina al terminar de cargarse. lo que hacia que aveces genere un error del request y saltaba una alerta al navegar en cualquier otra pagina del sitio. 

Al hacerlo aca me aseguro que la primera llamada automatica se haga solamente al terminar de cargar ESTA pagina. -->

<script>
$(document).ready(function(){
   
    var closeSidebar = $("#close-sidebar");
    closeSidebar.trigger('click')
    
    // responsiveVoice.speak("Clara Franco", "Spanish Latin American Female");
    
    $("#overlay").fadeIn(300);
    loadNextPatient("cargar_consultas", "", "");         



    var audioButton = $("#audioButton");
    var audio = $("#myAudio");
    // audio.volume = 0.1;
    
    // audioButton.on("click", function (e) {
    //       e.preventDefault();  
    //       playAudio();
    //     })
        
    function playAudio() { 
        // alert("playing sound");
        // audio.volume = 0.2;
        audio.trigger('play')
    } 

   function loadNextPatient(seleccion, patient_id, eliminar_paciente) {
      
      var $ = jQuery;
      var myData = 'foo=bar'+ '&action=' + 'sw_llamar_pacientes_ajax' + '&seleccion=' + seleccion + '&patient_id=' + patient_id + '&eliminar_paciente=' + eliminar_paciente;
      
      $.ajax({
         type: "POST",
         url:window.homeUrl + "/wp-admin/admin-ajax.php",
         data: myData,
         dataType: "json",
         success: function(data) {

            if(data.error.length >0){
               if(data.error){
                  alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> cargar consultas ');
               }
            }
            if(data.success){
            
            // var accionInicial = data.accion_inicial;
            // if (accionInicial != "eliminar_paciente") {
            //    $('#consultas-del-dia').empty();
            // }            
            

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
                if(responsiveVoice.voiceSupport()) {
                    var htmlString = $(".nombre-paciente").html();
                    // Used to add optional pitch (range 0 to 2), rate (range 0 to 1.5), volume (range 0 to 1) and callbacks.
                    responsiveVoice.speak("Siguiente Paciente", "Spanish Female", {rate: 0.8, pitch: 0.5});
                    responsiveVoice.speak(htmlString, "Spanish Female", {rate: 0.6, pitch: 0.5});
                    // responsiveVoice.speak("Ana Desiree Friedmann Ramirez", "Spanish Female", {rate: 0.6, pitch: 0.5});

                    // responsiveVoice.speak("Siguiente Paciente", "Spanish Latin American Female");
                    // responsiveVoice.speak("Marisa Vera Melgarejo", "Spanish Latin American Female");
                    // var voicelist = responsiveVoice.getVoices();
                    // console.log(voicelist);
                }
            },4000);


            setTimeout(function(){
                $( ".paciente-llamado" ).removeClass( "blink-bg" );
            },15000);

            } //data.success
         },
         error: function() {
            alert('No se pudo cargar las consultas del dia. JX');
            console.log('No se pudo cargar las consultas del dia');
         }
      });// $.ajax
      }

});

</script>