<?php
    $static_data_post_id = $template_args["static_data_post_id"];
    $patient_id = $template_args["patient_id"];
    //$static_data_array = sw_get_static_data_id($patient_id); 
    $static_data_post = get_post_custom($static_data_post_id);
    //var_dump($static_data_post);
    
    //load all the data we need from the static_data
    $cesareas = $static_data_post['cesareas'][0];
    $menarca = $static_data_post['menarca'][0];
    $irs = $static_data_post['irs'][0];
    $radiobox_vacuna_hpv = get_field('vacuna_hpv', $static_data_post_id); 
    $edad_vph = $static_data_post['edad_vph'][0];    
    //------------------

    $ritmo_menstrual = $static_data_post['ritmo_menstrual'][0];
    $fum = $static_data_post['fum'][0];
    $numero_embarazos = $static_data_post['numero_embarazos'][0];
    $abortos = $static_data_post['abortos'][0];
    //$metodo_anticonceptivo = $patient_fields['metodo_anticonceptivo'][0];
    // return value es un array conteniendo strings con los values en el bkend de acf i,e: "inyectables"
    $checkbox_metodo_anti = get_field('metodo_anticonceptivo', $patient_id); // esto no usamos para guardar, si no para 
    // mostrar los campos que estan ya guardados en un paciente creado


    //var_dump($static_data_post_id);
    //var_dump($radiobox_vacuna_hpv);
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

          <!-- cesareas -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="cesareas">Cesareas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="cesareas" name="cesareas" value="<?php echo $cesareas ?>" placeholder="Cesareas" required>
          </div>

          <!-- menarca -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="menarca">Menarca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="menarca" name="menarca" value="<?php echo $menarca ?>" placeholder="Menarca" required>
          </div>

          <!-- IRS -->
          <div class="floated-label-wrapper large-12 columns">
            <label for="irs">IRS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="irs" name="irs" value="<?php echo $irs ?>" placeholder="IRS" required>
          </div>

          <!-- vacuna VPH radio -->
          <div class="floated-label-wrapper large-6 columns checkbox-radio text-left">
              <span>Vacuna HPV</span>
              <div class="grid-content">
                <input type="radio" id="ninguna" name="vacuna_hpv" value="ninguna" <?php if ($radiobox_vacuna_hpv == "ninguna") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>
                >
                <label for="ninguna">Ninguna</label>

                <input type="radio" id="una_dosis" name="vacuna_hpv" value="una_dosis" <?php if ($radiobox_vacuna_hpv == "una_dosis") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="una_dosis">1 dosis</label>
              

              
                <input type="radio" id="dos_dosis" name="vacuna_hpv" value="dos_dosis" <?php if ($radiobox_vacuna_hpv == "dos_dosis") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="dos_dosis">2 dosis</label>
              

              
                <input type="radio" id="tres_dosis" name="vacuna_hpv" value="tres_dosis" <?php if ($radiobox_vacuna_hpv == "tres_dosis") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="tres_dosis">3 dosis</label>
              </div>
          </div>

          <!-- edad VPH -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="edad_vph">Edad en la que se aplico la vacuna VPH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="edad_vph" name="edad_vph" value="<?php echo $edad_vph ?>" placeholder="Ingrese la edad en la que se aplico la vacuna VPH" required>
          </div>

          <!-- ritmo menstrual -->
          <div class="floated-label-wrapper large-6 columns">
            <label for="ritmo_menstrual">Ritmo Menstrual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="ritmo_menstrual" name="ritmo_menstrual" value="<?php echo $ritmo_menstrual ?>" placeholder="Ingrese el ritmo menstrual..." required>
          </div>

          <!-- metodo anticonceptivo -->
          <div class="floated-label-wrapper large-12 columns checkbox-radio text-left">
              <span>Metodo anticonceptivo actual</span>
                <fieldset>
                <div class="grid-content">
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
              </fieldset>

            </div>

        </div>
      </div>
    </div>
  </div>
</div>