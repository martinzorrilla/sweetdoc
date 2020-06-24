<?php get_header();/* Template Name: Consultas del dia*/?>


      <title>Consultas del dia</title>
   
      <!-- <p>Click en cargar para traer las consultas del dia:</p> -->
       
      <ul id="consultas-del-dia">
      </ul>

      <div class="row">  
         <div class="floated-label-wrapper large-12 columns text-center" style="padding-top: 1rem;">
            <button id="cargar-consultas" class="submit_button save-button-expanded" type="submit" value="cargar-consultas">
            <i class="fas fa-save 2x"></i>  <span class="app-dashboard-sidebar-text"> Obtener lista de pacientes </span>
            </button>
            <p class="errorWrapper">
            </p>
         </div>
      </div>


<?php get_footer(); ?>

<!-- <script > aca iba el JS que ahora esta en src/assets/js/my-custom-js  </script> -->
