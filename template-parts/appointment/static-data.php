<?php
    //$is_editable = "false";
    $static_data_post_id = $template_args["static_data_post_id"];
    $patient_id = $template_args["patient_id"];
    //$static_data_array = sw_get_static_data_id($patient_id); 
    $static_data_post = get_post_custom($static_data_post_id);
    //var_dump($static_data_post);
    
    //load all the data we need from the static_data
    $menarca = $static_data_post['menarca'][0];
    $radiobox_ritmo_menstrual = get_field('ritmo_menstrual', $static_data_post_id);

    $fum = $static_data_post['fum'][0] !="" && $static_data_post['fum'][0] !=NULL ? $static_data_post['fum'][0] : "";
    $newDate = "";
    //acf retoran la fecha asi:20191128 en vez de 2019-11-28 que es como el input[date] requiere, x eso tranformo el valor
    if ($fum != ""){ $newDate = date("Y-m-d", strtotime($fum));}
    
    $numero_embarazos = $static_data_post['numero_embarazos'][0];
    $parto_normal = $static_data_post['parto_normal'][0];

    $cesareas = $static_data_post['cesareas'][0];
    $abortos = $static_data_post['abortos'][0];
    $irs = $static_data_post['irs'][0];
    

    $radiobox_vacuna_vph = get_field('vacuna_vph', $static_data_post_id); 
    $edad_vph = $static_data_post['edad_vph'][0];    
    //------------------


    //$metodo_anticonceptivo = $patient_fields['metodo_anticonceptivo'][0];
    // return value es un array conteniendo strings con los values en el bkend de acf i,e: "inyectables"
    $checkbox_metodo_anti = get_field('metodo_anticonceptivo', $static_data_post_id); // esto no usamos para guardar, si no para 
    // mostrar los campos que estan ya guardados en un paciente creado
    $marca_anticonceptivo = $static_data_post['marca_anticonceptivo'][0];
    $checkbox_terapia_hormonal = get_field('terapia_hormonal', $static_data_post_id); // esto no usamos para guardar, si no paraa mostrar los campos guardados
    
    $pap_anterior = $static_data_post['pap_anterior'][0];
    
    $fecha_pap = $static_data_post['fecha_pap'][0] !="" && $static_data_post['fecha_pap'][0] !=NULL ? $static_data_post['fecha_pap'][0] : "";
    $new_fecha_pap = "";
    //acf retoran la fecha asi:20191128 en vez de 2019-11-28 que es como el input[date] requiere, x eso tranformo el valor
    if ($fecha_pap != ""){ $new_fecha_pap = date("Y-m-d", strtotime($fecha_pap));}

    $checkbox_fumador = get_field('fumador', $static_data_post_id); // esto no usamos para guardar, si no paraa mostrar los campos guardados
    $cigarrillos_por_dia = $static_data_post['cigarrillos_por_dia'][0];
    $observaciones = $static_data_post['observaciones'][0];

    

    //var_dump($static_data_post_id);
    //var_dump($checkbox_metodo_anti);
 ?>
<!-- <h3>Datos Estaticos del Paciente</h3> -->

<div class="form-tab-style">

  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
  </div>

  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">

    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header static-data-click-to-show">
          <div class="profile-card-author">
            <h5 class="author-title">AGO</h5>          
            <p class="card-profile-stats-more-link"><a href="#"><i class="fa fa-angle-down fa-2x" aria-hidden="true"></i></a></p>
          </div>
        </div>
        
        
        <div class="profile-card-about static-data-slide">
          <h5 class="about-title separator-left"> Ingresar datos AGO <?php //echo $name?></h5>
          <p class="about-content large-12 columns">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem eveniet nulla quae ullam sit iure voluptatum, nesciunt voluptas perferendis, minus natus in quaerat?
          </p>

          <!-- menarca -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="menarca" class="separator-left">Menarca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="menarca" name="menarca" value="<?php echo $menarca ?>" placeholder="Menarca" required>
          </div>

          <!-- ritmo menstrual -->
          <div class="floated-label-wrapper small-12 medium-6 columns checkbox-radio text-left grid-content">
              <label class="separator-left">Ritmo menstrual </label>
              
                <input type="radio" id="regular" name="ritmo_menstrual" value="regular" <?php if ($radiobox_ritmo_menstrual == "regular") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="regular">Regular</label>

                <input type="radio" id="irregular" name="ritmo_menstrual" value="irregular" <?php if ($radiobox_ritmo_menstrual == "irregular") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="irregular">Irregular</label>
              
          </div>

          <!-- FUM -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="fum" class="separator-left">FUM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="date" id="fum" name="fum" value="<?php echo $newDate ?>" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
          </div>

          <!-- Numero de Embarazos -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="numero_embarazos" class="separator-left">Numero de Embarazos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="numero_embarazos" name="numero_embarazos" value="<?php echo $numero_embarazos ?>" placeholder="Ingrese el numero de embarazos.." required>
          </div>

          <!-- Parto normal -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="parto_normal" class="separator-left">Parto normal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="parto_normal" name="parto_normal" value="<?php echo $parto_normal ?>" placeholder="Ingrese el numero de partos normales.." required>
          </div>

          <!-- cesareas -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="cesareas" class="separator-left">Cesareas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="cesareas" name="cesareas" value="<?php echo $cesareas ?>" placeholder="Ingrese el numero de cesareas" required>
          </div>

          <!-- abortos -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="abortos" class="separator-left">Abortos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="abortos" name="abortos" value="<?php echo $abortos ?>" placeholder="Ingrese el numero de abortos..." required>
          </div>

          <!-- IRS -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="irs" class="separator-left">IRS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="irs" name="irs" value="<?php echo $irs ?>" placeholder="IRS" required>
          </div>

          <!-- vacuna VPH radio -->
          <div class="floated-label-wrapper large-6 columns checkbox-radio text-left grid-content">
              <label class="separator-left">Vacuna VPH</label>
              
                <input type="radio" id="ninguna" name="vacuna_vph" value="ninguna" <?php if ($radiobox_vacuna_vph == "ninguna") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>
                >
                <label for="ninguna">Ninguna</label>

                <input type="radio" id="una_dosis" name="vacuna_vph" value="una_dosis" <?php if ($radiobox_vacuna_vph == "una_dosis") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="una_dosis">1 dosis</label>
              

              
                <input type="radio" id="dos_dosis" name="vacuna_vph" value="dos_dosis" <?php if ($radiobox_vacuna_vph == "dos_dosis") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="dos_dosis">2 dosis</label>
              

              
                <input type="radio" id="tres_dosis" name="vacuna_vph" value="tres_dosis" <?php if ($radiobox_vacuna_vph == "tres_dosis") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="tres_dosis">3 dosis</label>
              
          </div>

          <!-- edad VPH -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="edad_vph" class="separator-left">Edad en la que se aplico la vacuna VPH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="edad_vph" name="edad_vph" value="<?php echo $edad_vph ?>" placeholder="Ingrese la edad en la que se aplico la vacuna VPH" required>
          </div>

          <!-- metodo anticonceptivo - checkbox -->
          <div class="floated-label-wrapper large-6 columns checkbox-radio text-left grid-content">
              <label class="separator-left">Metodo anticonceptivo actual</label>
            

                  <input type="checkbox" id="inyectable" name="metodo_anticonceptivo[]" value="inyectable" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                  <?php 
                  if( $checkbox_metodo_anti != NULL || $checkbox_metodo_anti != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                    if(in_array("inyectable", $checkbox_metodo_anti)) echo "checked";
                  }
                  ?> >
                  <label for="inyectable">Inyectable</label>

                  <input type="checkbox" id="preservativos" name="metodo_anticonceptivo[]" value="preservativos" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>
                  <?php 
                  if( $checkbox_metodo_anti != NULL || $checkbox_metodo_anti != ""){ //si esta vacio genera un error, por eso hay que 
                    if(in_array("preservativos", $checkbox_metodo_anti)) echo "checked";
                  }
                  ?> >
                  <label for="preservativos">Preservativos</label>

            
          </div>

          <!-- Marca del anticonceptivo -->
          <div class="floated-label-wrapper large-6 medium-6 columns">
            <label for="marca_anticonceptivo" class="separator-left">Marca del anticonceptivo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="marca_anticonceptivo" name="marca_anticonceptivo" value="<?php echo $marca_anticonceptivo ?>" placeholder="Ingrese la marca del anticonceptivo.." required>
          </div>

          <!-- Terapia de reposicion hormonal - checkbox -->
          <div class="floated-label-wrapper large-12 columns checkbox-radio text-left grid-content">
              <label class="separator-left">Terapia de reposicion hormonal</label>
                
                  <input type="checkbox" id="terapia_si" name="terapia_hormonal[]" value="si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                  <?php 
                  if( $checkbox_terapia_hormonal != NULL || $checkbox_terapia_hormonal != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                    if(in_array("si", $checkbox_terapia_hormonal)) echo "checked";
                  }
                  ?> >
                  <label for="terapia_si">Si</label>
                
          </div>

          <!-- Resultado del pap anterior -->
          <div class="floated-label-wrapper large-6 medium-6 columns">
            <label for="pap_anterior" class="separator-left">Resultado del PAP anterior &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="pap_anterior" name="pap_anterior" value="<?php echo $pap_anterior ?>" placeholder="Ingrese el resultado del PAP anterior.." required>
          </div>

          <!-- Fecha PAP -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="fecha_pap" class="separator-left">Fecha del PAP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="date" id="fecha_pap" name="fecha_pap" value="<?php echo $new_fecha_pap ?>" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
          </div>

          <!-- Fumador - checkbox -->
          <div class="floated-label-wrapper large-6 columns checkbox-radio text-left grid-content">
              <label class="separator-left">Fumador</label>
                
                  <input type="checkbox" id="fumador_si" name="fumador[]" value="si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                  <?php 
                  if( $checkbox_fumador != NULL || $checkbox_fumador != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                    if(in_array("si", $checkbox_fumador)) echo "checked";
                  }
                  ?> >
                  <label for="fumador_si">Si</label>
                
          </div>

          <!-- cigarrillos por dia -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="cigarrillos_por_dia" class="separator-left">Numero de cigarrillos por dia</label>
            <input type="number" id="cigarrillos_por_dia" name="cigarrillos_por_dia" value="<?php echo $cigarrillos_por_dia ?>" placeholder="Ingrese el numero de cigarrillos por dia" required>
          </div>

          <!-- observaciones -->
          <div class="floated-label-wrapper large-12 columns">
            <label for="observaciones" class="separator-left">Observaciones</label>
            <input type="text" id="observaciones" name="observaciones" value="<?php echo $observaciones ?>" placeholder="Ingrese las observaciones de la paciente" required>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>