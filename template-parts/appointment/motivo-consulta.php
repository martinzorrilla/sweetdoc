<?php
    $appointment_post_id = $template_args["appointment_id"]; 
    $is_editable = $template_args["is_editable"];
    $stored_fields = get_post_custom($appointment_post_id);

    //$motivo_de_consulta = $stored_fields['motivo_de_consulta'][0];
    $motivo_de_consulta = isset($stored_fields['motivo_de_consulta'][0]) ? $stored_fields['motivo_de_consulta'][0] : NULL;
    //$antecedente_actual = $stored_fields['antecedente_actual'][0];
    $antecedente_actual = isset($stored_fields['antecedente_actual'][0]) ? $stored_fields['antecedente_actual'][0] : NULL;
    //$diagnostico_consulta = $stored_fields['diagnostico_consulta'][0];
    $diagnostico_consulta = isset($stored_fields['diagnostico_consulta'][0]) ? $stored_fields['diagnostico_consulta'][0] : NULL;
    //$codigo_diagnostico = $stored_fields['codigo_diagnostico'][0];
    $codigo_diagnostico = isset($stored_fields['codigo_diagnostico'][0]) ? $stored_fields['codigo_diagnostico'][0] : NULL;
    //$procedimiento = $stored_fields['procedimiento'][0];
    $procedimiento = isset($stored_fields['procedimiento'][0]) ? $stored_fields['procedimiento'][0] : NULL;
    //$codigo_procedimiento = $stored_fields['codigo_procedimiento'][0];
    $codigo_procedimiento = isset($stored_fields['codigo_procedimiento'][0]) ? $stored_fields['codigo_procedimiento'][0] : NULL;
    //$plan_tratamiento = $stored_fields['plan_tratamiento'][0];
    $plan_tratamiento = isset($stored_fields['plan_tratamiento'][0]) ? $stored_fields['plan_tratamiento'][0] : NULL;


 ?>
<!-- <h3>Datos de la Consulta</h3> -->

  <div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
  </div>

  <div class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header">
          <div class="profile-card-author">
            <h5 class="author-title">Consulta</h5>
            <!-- <p class="author-description">Paciente</p> -->
          </div>
        </div>
        <div class="profile-card-about large-12 columns">
          <h5 class="about-title separator-left"> Ingresar datos de la Consulta <?php //echo $name?></h5>

          <div class="floated-label-wrapper large-12 columns">
            <label class="separator-left" for="Motivo de Consulta">Motivo de Consulta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <textarea id="motivo_de_consulta" name="motivo_de_consulta" placeholder="Ingrese aqui el motivo de la consulta.." style="height:5em" required><?php echo $motivo_de_consulta ?></textarea>
          </div>


          <div class="floated-label-wrapper large-12 columns">
            <label class="separator-left" for="antecedente_actual">Antecedentes de la enfermedad actual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <!-- <input type="text" id="antecedente_actual" name="antecedente_actual" value="<?php //echo $antecedente_actual ?>" placeholder="Escribir..." required> -->
            <textarea id="antecedente_actual" name="antecedente_actual" placeholder="Ingrese aqui el antecedente actual.." style="height:5em" required><?php echo $antecedente_actual ?></textarea>
          </div>

          <div class="floated-label-wrapper large-12 columns">
            <label class="separator-left" for="diagnostico_consulta">Diagnóstico</label>
            <textarea id="diagnostico_consulta" name="diagnostico_consulta" placeholder="Ingrese uno o mas diagnósticos de la consulta." style="height:5em" required><?php echo $diagnostico_consulta ?></textarea>
          </div>

          <div class="floated-label-wrapper large-12 columns ">
            <label class="separator-left" for="codigo_diagnostico">Código de diagnóstico</label>
            <input type="text" id="codigo_diagnostico" name="codigo_diagnostico" value="<?php echo $codigo_diagnostico ?>" placeholder="Escribir..." required>
          </div>

          <div class="floated-label-wrapper large-12 columns">
            <label class="separator-left" for="procedimiento">Procedimiento</label>
            <textarea id="procedimiento" name="procedimiento" placeholder="Ingrese uno o mas procedimientos a realizar durante esta consulta.." style="height:5em" required><?php echo $procedimiento ?></textarea>
          </div>

          <div class="floated-label-wrapper large-12 columns ">
            <label class="separator-left" for="codigo_procedimiento">Código de Procedimiento</label>
            <input type="text" id="codigo_procedimiento" name="codigo_procedimiento" value="<?php echo $codigo_procedimiento ?>" placeholder="Escribir..." required>
          </div>

          <div class="floated-label-wrapper large-12 columns">
            <label class="separator-left" for="plan_tratamiento">Plan de tratamiento</label>
            <textarea id="plan_tratamiento" name="plan_tratamiento" placeholder="Escribir el plan de tratamiento..." style="height:8em" required><?php echo $plan_tratamiento ?></textarea>
          </div>

        </div>
      </div>
    </div>
  </div>