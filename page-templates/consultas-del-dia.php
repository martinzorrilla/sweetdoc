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

<!-- <script > aca iba el JS que ahora esta en src/assets/js/my-custom-js  </script> -->
