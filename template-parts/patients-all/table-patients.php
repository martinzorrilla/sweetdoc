<?php

  
$appointment_url = home_url().'/consulta/?patient_id=';

$search_param = $template_args["search_param"];

//search_param DEPRECTATED. I don't use search param anymore but it can be used
$latest_patients = sw_get_patients($search_param);
?>

<input type="text" id="searchInput" onkeyup="searchBarFunction()" placeholder="Buscar por Nombre o Cedula del paciente..">


<table class="sw-table-patients my-table-stack">
  <thead>
    <tr>
      <!-- <th>Código Paciente</th> -->
      <th>Nombre</th>
      <th>Cédula</th>
      <th>Edad</th>
      <th>Consultas</th>
      <th>Nueva consulta</th>
      <th>Consultas del día</th>

    </tr>
  </thead>
  <tbody id="table-Search">

    <!-- <tr> 1ra fila -->
      <!-- <td> 1124 </td> consulta -->
      <!-- <td>23-04-2019</td> Fecha -->
      <!-- <td>908</td>Colpo -->
      <!-- <td>Crear</td>Indiacion -->
      <!-- <td>Ver</td>Estudio -->
    <!-- </tr>Fin de 1ra fila -->

    <?php
     
    foreach ($latest_patients as $patient){
    ?>
        
        <tr> <!--cada tr es una fila en la tabla -->
            <!-- Codigo paciente -->
            <!-- <td>
                <a href="#"> < ? php// echo $patient->ID;?></a>      
            </td> -->

            <!-- Nombre -->
            <td>
                <a href="<?php echo get_permalink( $patient->ID ); ?>"> <?php echo $patient->post_title;?></a>      
                <p style="display:none;"><?php echo $patient->post_title." ".(get_field( "cedula", $patient->ID ));?></p>
            </td>

            <!-- Cedula -->
            <td>
                <a href="#"><?php echo (get_field( "cedula", $patient->ID ));?></a>      
            </td>

            <!-- Edad -->
            <td>
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
            <td>
                <a href="<?php echo get_permalink( $patient->ID )."#consultas_paciente"; ?>">Ver</a>
            </td>

            <!-- Nueva consulta -->
            <td>
                <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id=new'; ?>" class="crete-app">Crear</a>      
            </td>

            <!-- Consultas del dia -->
            <td>
                <a href="#"> Agregar </a>      
            </td>
        </tr>
    <?php
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