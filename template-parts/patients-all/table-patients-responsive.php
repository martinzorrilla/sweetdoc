
<?php

  
$appointment_url = home_url().'/consulta/?patient_id=';

$search_param = $template_args["search_param"];

//search_param DEPRECTATED. I don't use search param anymore but it can be used
$latest_patients = sw_get_patients($search_param);
?>

<input type="text" id="searchInput" onkeyup="searchBarFunction()" placeholder="Buscar por Nombre o Cedula del paciente..">



<table class="responsive-table">
  <!-- <caption>Todas las pacientes</caption> -->
  <thead>
    <tr>
      <th scope="col" class="col-numero">Nro</th>
      <th scope="col">Nombre</th>
      <!-- <th scope="col" style="width:18em;">Nombre</th> -->
      <th scope="col">Cédula</th>
      <th scope="col" class="col-edad">Edad</th>
      <th scope="col">Consultas</th>
      <th scope="col">Nueva consulta</th>
      <th scope="col">Consultas del día</th>
    </tr>
  </thead>
  <tbody id="table-Search">


    <?php
    $contador_pacientes = 1;
    foreach ($latest_patients as $patient){
    ?>

    <tr>

      <!-- Numero -->
      <td data-label="Nro">    
        <a href="#">    
          <?php echo $contador_pacientes ?>
        </a>
      </td>

      <!-- Nombre -->
      <td scope="row" data-label="Nombre">
        <a href="<?php echo get_permalink( $patient->ID ); ?>"> <?php echo $patient->post_title;?></a> 
        <!-- esto es para que se pueda hacer la busqueda por cedula, ya que debe estar con el nombre para poder hacerlo      -->
        <p style="display:none;"><?php echo $patient->post_title." ".(get_field( "cedula", $patient->ID ));?></p>
      </td>
      
      <!-- Cedula -->
      <td data-label="Cédula">
      <a href="#"><?php echo (get_field( "cedula", $patient->ID ));?></a>      
      </td>

      <!-- Edad -->
      <td data-label="Edad">
        <?php 
          $fecha_de_nacimiento = get_field( "fecha_de_nacimiento", $patient->ID );
        
          if ($fecha_de_nacimiento == NULL) {
            $show_age = "-";
          }else{
            $patient_age = calcular_edad($fecha_de_nacimiento);

              $show_age = $patient_age->y;
            // $show_age = "tiene";

            // printf(' Edad : %d años', $patient_age->y); 
          }

        // echo get_permalink( $patient->ID ); 
        ?>
        <a href="#"> <?= $show_age ?> </a>
      </td>

      <!-- Consultas -->
      <td data-label="Consultas">
        <a class="btn btn-green botones-estandard btn-table-patients" href="<?php echo get_permalink( $patient->ID )."#consultas_paciente"; ?>">Ver</a>
      </td>


      <!-- Nueva consulta -->
      <td data-label="Nueva consulta">
          <a class="btn btn-green botones-estandard btn-table-patients" href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id=new'; ?>" class="crete-app">Crear</a>      
      </td>

      <!-- Consultas del dia -->
      <td data-label="Consultas del día">
          <a href="#" class="agregar-paciente-consulta btn btn-green botones-estandard btn-table-patients" data-id="<?php echo $patient->ID;?>"> Agregar </a>      
      </td>


    </tr>
    <?php
    $contador_pacientes ++;
    } //foreach 
    ?>



  </tbody>
</table>




<script>
function searchBarFunction() {
  // Declare variables
  var input, filter, ul, tr, p, i;
  input = document.getElementById('searchInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("table-Search");
  tr = ul.getElementsByTagName('tr');

  // Loop through all trst items, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
      p = tr[i].getElementsByTagName("p")[0];
      if (p.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
      } else {
          tr[i].style.display = "none";
      }
  }
}
</script> 