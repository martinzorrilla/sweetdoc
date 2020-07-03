<?php get_header();/* Template Name: Consultas del dia*/?>

      <div class="callout secondary wrap" style="margin-top: 3em; margin-bottom: 3em;">
         <h2 class="font-bold">Lista de pacientes del día</h2>
      </div>

      <!-- <div data-closable class="callout alert-callout-border secondary text-center">
         <h3>Lista de pacientes del día</h3>
      </div> -->
   
      <!-- <p>Click en cargar para traer las consultas del dia:</p> -->
       
      <ul id="consultas-del-dia" style="list-style-type:none; margin-left: 0px;">
      <!-- <ul style="list-style-type:none;"> -->
      </ul>

      <div class="row" style="padding-top: 2rem;">  
         <div class="small-12 medium-12 large-6 columns text-center" style="padding-bottom:1em;">
               <a id="cargar-consultas" href="#" class="btn btn-green botones-estandard">Actualizar lista de pacientes</a>
         </div>
         <div class="small-12 medium-12 large-6 columns text-center">
            <a id="vaciar-consultas" href="#" class="btn btn-red botones-estandard" >Borrar lista de pacientes</a>
         </div>
      </div>







<?php get_footer(); ?>


<!-- ATENCION! 
POR QUE AGRAGUE ESTE SCRIPT? todo el JS para manejar los eventos de esta pagina se encuentran ne "create-consultas-del-dia.js"
y de hecho, este codigo es una copia de una seccion de lo que hay ahi. la cuestion es que para poder hacer que al cargar esta pagina, obtenga la lista de pacientes de forma automatica, tenia que llamar a la funcion saveProfileData("cargar_consultas", "", ""); al iniciar el modulo, y por esto esta funcion era llamada en cualquier otra pagina al terminar de cargarse. lo que hacia que aveces genere un error del request y saltaba una alerta al navegar en cualquier otra pagina del sitio. 

Al hacerlo aca me aseguro que la primera llamada automatica se haga solamente al terminar de cargar ESTA pagina. -->

<script>
$(document).ready(function(){
   
   $("#overlay").fadeIn(300);
   saveProfileData("cargar_consultas", "", "");         


   function saveProfileData(seleccion, patient_id, eliminar_paciente) {
      
      var $ = jQuery;
      var myData = 'foo=bar'+ '&action=' + 'sw_cargar_consultas_ajax' + '&seleccion=' + seleccion + '&patient_id=' + patient_id + '&eliminar_paciente=' + eliminar_paciente;
      
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
            
            var accionInicial = data.accion_inicial;
            if (accionInicial != "eliminar_paciente") {
               $('#consultas-del-dia').empty();
            }            
            
            $.each( data.msg, function( key, value ) {
            $('#consultas-del-dia').append(value);
            });

            setTimeout(function(){
               $("#overlay").fadeOut(300);
            },500);


            }
         },
         error: function() {
            alert('No se pudo cargar las consultas del dia. JX');
            console.log('No se pudo cargar las consultas del dia');
         }
      });// $.ajax
      }

});

</script>