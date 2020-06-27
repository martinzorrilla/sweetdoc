<?php get_header();/* Template Name: Consultas del dia*/?>


      <div data-closable class="callout alert-callout-border secondary text-center">
         <h3>Listado de pacientes del día</h3>
      </div>
   
      <!-- <p>Click en cargar para traer las consultas del dia:</p> -->
       
      <ul id="consultas-del-dia" style="list-style-type:none; margin-left: 0px;">
      <!-- <ul style="list-style-type:none;"> -->
      </ul>

      <div class="row">  
            <div class="floated-label-wrapper large-6 columns text-center" style="padding-top: 1rem;">
               <button id="cargar-consultas" class="submit_button save-button-expanded" type="submit" value="cargar-consultas">
               <span class="app-dashboard-sidebar-text"> Actualizar lista de pacientes </span>
               </button>
               <p class="errorWrapper">
               </p>
            </div>

            <div class="floated-label-wrapper large-6 columns text-center" style="padding-top: 1rem;">
               <button id="vaciar-consultas" class="submit_button save-button-expanded" type="submit" value="vaciar-consultas">
               <i class="fas fa-save 2x"></i>  <span class="app-dashboard-sidebar-text"> Borrar lista de pacientes </span>
               </button>
               <p class="errorWrapper">
               </p>
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