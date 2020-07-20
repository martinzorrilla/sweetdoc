  <?php

   
  $appointment_url = home_url().'/consulta/?patient_id=';

  $search_param = $template_args["search_param"];

  //search_param DEPRECTATED. I don't use search param anymore but it can be used
  $latest_patients = sw_get_patients($search_param);
  ?>

  <input type="text" id="myInput" onkeyup="searchBarFunction()" placeholder="Buscar por Nombre o Cedula del paciente..">

  <ul id="myUL">
    <?php foreach ($latest_patients as $patient): ?>
      <li>
        <div data-closable class="callout alert-callout-border secondary list-patients">
          <div class="row">
            <div class="large-6 columns">
              <a href="<?php echo get_permalink( $patient->ID ); ?> " class="name">
                <strong><?php echo $patient->post_title;?></strong>           
                <span><strong> - Cedula: <?php echo (get_field( "cedula", $patient->ID ));?></strong></p>
              </a>
            </div>

            <div class="large-6 columns text-right">
              <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id=new'; ?>" class="crete-app">  Crear Nueva consulta</a>
            </div>
          <?php 
          // $related = sw_get_related_appointments($patient->ID); 
          // foreach ($related as $r){?>
             <!-- <a href="<?php //echo esc_url( $appointment_url ).$patient->ID.'&app_id='.$r; ?>"> - Consulta Anterior id: <?php //echo $r ?> </a> -->
          <?php //}?>

          <!-- <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
          </button> -->
          </div>-
        </div>
      </li>
    <?php endforeach;?>
  </ul>


  <script>
//   function searchBarFunction() {
//     // Declare variables
//     var input, filter, ul, li, a, i;
//     input = document.getElementById('myInput');
//     filter = input.value.toUpperCase();
//     ul = document.getElementById("myUL");
//     li = ul.getElementsByTagName('li');

//     // Loop through all list items, and hide those who don't match the search query
//     for (i = 0; i < li.length; i++) {
//         a = li[i].getElementsByTagName("a")[0];
//         if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
//             li[i].style.display = "";
//         } else {
//             li[i].style.display = "none";
//         }
//     }
// }
  </script>