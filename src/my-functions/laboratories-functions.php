<?php  

/*
********************************************************************************
*
      CreateLaboratories
*
********************************************************************************
*/

function sw_create_laboratories_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;    


    $hemograma_completo = isset($_POST['hemograma_completo']) && $_POST['hemograma_completo'] != '' ? $_POST['hemograma_completo'] : NULL;
    $tipificacion = isset($_POST['tipificacion']) && $_POST['tipificacion'] != '' ? $_POST['tipificacion'] : NULL;
    $crasis_sanguinea = isset($_POST['crasis_sanguinea']) && $_POST['crasis_sanguinea'] != '' ? $_POST['crasis_sanguinea'] : NULL;
    $test_de_coombs_indirecto = isset($_POST['test_de_coombs_indirecto']) && $_POST['test_de_coombs_indirecto'] != '' ? $_POST['test_de_coombs_indirecto'] : NULL;
    $vdrl = isset($_POST['vdrl']) && $_POST['vdrl'] != '' ? $_POST['vdrl'] : NULL;
    $if_p_toxoplasmosis = isset($_POST['if_p_toxoplasmosis']) && $_POST['if_p_toxoplasmosis'] != '' ? $_POST['if_p_toxoplasmosis'] : NULL;
    $storch = isset($_POST['storch']) && $_POST['storch'] != '' ? $_POST['storch'] : NULL;
    $hbs_ag = isset($_POST['hbs_ag']) && $_POST['hbs_ag'] != '' ? $_POST['hbs_ag'] : NULL;
    $test_de_elisa_hiv = isset($_POST['test_de_elisa_hiv']) && $_POST['test_de_elisa_hiv'] != '' ? $_POST['test_de_elisa_hiv'] : NULL;
    $chagas_igg_igm = isset($_POST['chagas_igg_igm']) && $_POST['chagas_igg_igm'] != '' ? $_POST['chagas_igg_igm'] : NULL;
    $igmfta = isset($_POST['igmfta']) && $_POST['igmfta'] != '' ? $_POST['igmfta'] : NULL;
    $abs= isset($_POST['abs']) && $_POST['abs'] != '' ? $_POST['abs'] : NULL;
    $ft4_tsh= isset($_POST['ft4_tsh']) && $_POST['ft4_tsh'] != '' ? $_POST['ft4_tsh'] : NULL;
    $progesterona= isset($_POST['progesterona']) && $_POST['progesterona'] != '' ? $_POST['progesterona'] : NULL;
    $estradiol= isset($_POST['estradiol']) && $_POST['estradiol'] != '' ? $_POST['estradiol'] : NULL;
    $fsh_lab= isset($_POST['fsh_lab']) && $_POST['fsh_lab'] != '' ? $_POST['fsh_lab'] : NULL;
    $lh_lab= isset($_POST['lh_lab']) && $_POST['lh_lab'] != '' ? $_POST['lh_lab'] : NULL;
    $bhch_cualitativo= isset($_POST['bhch_cualitativo']) && $_POST['bhch_cualitativo'] != '' ? $_POST['bhch_cualitativo'] : NULL;
    $bhcg_cuantitativo= isset($_POST['bhcg_cuantitativo']) && $_POST['bhcg_cuantitativo'] != '' ? $_POST['bhcg_cuantitativo'] : NULL;
    $prolactina= isset($_POST['prolactina']) && $_POST['prolactina'] != '' ? $_POST['prolactina'] : NULL;
    $testosterona_libre= isset($_POST['testosterona_libre']) && $_POST['testosterona_libre'] != '' ? $_POST['testosterona_libre'] : NULL;
    $androstenediona= isset($_POST['androstenediona']) && $_POST['androstenediona'] != '' ? $_POST['androstenediona'] : NULL;
    $dhea_lab= isset($_POST['dhea_lab']) && $_POST['dhea_lab'] != '' ? $_POST['dhea_lab'] : NULL;
    $amh_lab= isset($_POST['amh_lab']) && $_POST['amh_lab'] != '' ? $_POST['amh_lab'] : NULL;
    $simple_lab= isset($_POST['simple_lab']) && $_POST['simple_lab'] != '' ? $_POST['simple_lab'] : NULL;
    $cultivo_y_antibiograma= isset($_POST['cultivo_y_antibiograma']) && $_POST['cultivo_y_antibiograma'] != '' ? $_POST['cultivo_y_antibiograma'] : NULL;
    $proteina_24hs= isset($_POST['proteina_24hs']) && $_POST['proteina_24hs'] != '' ? $_POST['proteina_24hs'] : NULL;
    $vermes_y_protozoarios= isset($_POST['vermes_y_protozoarios']) && $_POST['vermes_y_protozoarios'] != '' ? $_POST['vermes_y_protozoarios'] : NULL;
    $cya_heces= isset($_POST['cya_heces']) && $_POST['cya_heces'] != '' ? $_POST['cya_heces'] : NULL;
    $sangre_oculta= isset($_POST['sangre_oculta']) && $_POST['sangre_oculta'] != '' ? $_POST['sangre_oculta'] : NULL;
    $sangre_oculta= isset($_POST['sangre_oculta']) && $_POST['sangre_oculta'] != '' ? $_POST['sangre_oculta'] : NULL;
    $glicemia_en_ayunas= isset($_POST['glicemia_en_ayunas']) && $_POST['glicemia_en_ayunas'] != '' ? $_POST['glicemia_en_ayunas'] : NULL;
    $ttgo= isset($_POST['ttgo']) && $_POST['ttgo'] != '' ? $_POST['ttgo'] : NULL;
    $urea= isset($_POST['urea']) && $_POST['urea'] != '' ? $_POST['urea'] : NULL;
    $creatinina= isset($_POST['creatinina']) && $_POST['creatinina'] != '' ? $_POST['creatinina'] : NULL;
    $ac_urico= isset($_POST['ac_urico']) && $_POST['ac_urico'] != '' ? $_POST['ac_urico'] : NULL;
    $colesterol_vhl= isset($_POST['colesterol_vhl']) && $_POST['colesterol_vhl'] != '' ? $_POST['colesterol_vhl'] : NULL;
    $trigliceridos= isset($_POST['trigliceridos']) && $_POST['trigliceridos'] != '' ? $_POST['trigliceridos'] : NULL;
    $lipidos_totales= isset($_POST['lipidos_totales']) && $_POST['lipidos_totales'] != '' ? $_POST['lipidos_totales'] : NULL;
    $hepatograma= isset($_POST['hepatograma']) && $_POST['hepatograma'] != '' ? $_POST['hepatograma'] : NULL;
    $proteinas_tyfca_125= isset($_POST['proteinas_tyfca_125']) && $_POST['proteinas_tyfca_125'] != '' ? $_POST['proteinas_tyfca_125'] : NULL;
    $ca_125= isset($_POST['ca_125']) && $_POST['ca_125'] != '' ? $_POST['ca_125'] : NULL;
    $cea_lab= isset($_POST['cea_lab']) && $_POST['cea_lab'] != '' ? $_POST['cea_lab'] : NULL;
    $ca_15_3= isset($_POST['ca_15_3']) && $_POST['ca_15_3'] != '' ? $_POST['ca_15_3'] : NULL;
    $pyrilinksd= isset($_POST['pyrilinksd']) && $_POST['pyrilinksd'] != '' ? $_POST['pyrilinksd'] : NULL;
    $alfa_fetos_proteinas= isset($_POST['alfa_fetos_proteinas']) && $_POST['alfa_fetos_proteinas'] != '' ? $_POST['alfa_fetos_proteinas'] : NULL;
    $fta_abs= isset($_POST['fta_abs']) && $_POST['fta_abs'] != '' ? $_POST['fta_abs'] : NULL;
    $pcr_lab= isset($_POST['pcr_lab']) && $_POST['pcr_lab'] != '' ? $_POST['pcr_lab'] : NULL;
    $factor_reumatoideo= isset($_POST['factor_reumatoideo']) && $_POST['factor_reumatoideo'] != '' ? $_POST['factor_reumatoideo'] : NULL;
    $lupus_anticoagulante= isset($_POST['lupus_anticoagulante']) && $_POST['lupus_anticoagulante'] != '' ? $_POST['lupus_anticoagulante'] : NULL;
    $ac_antinucleares= isset($_POST['ac_antinucleares']) && $_POST['ac_antinucleares'] != '' ? $_POST['ac_antinucleares'] : NULL;
    $monotest= isset($_POST['monotest']) && $_POST['monotest'] != '' ? $_POST['monotest'] : NULL;
    $ac_anti_dna= isset($_POST['ac_anti_dna']) && $_POST['ac_anti_dna'] != '' ? $_POST['ac_anti_dna'] : NULL;
    $ac_antifosfolípidos= isset($_POST['ac_antifosfolípidos']) && $_POST['ac_antifosfolípidos'] != '' ? $_POST['ac_antifosfolípidos'] : NULL;
    $vitamina_d25oh= isset($_POST['vitamina_d25oh']) && $_POST['vitamina_d25oh'] != '' ? $_POST['vitamina_d25oh'] : NULL;
    $espermograma_biquimico= isset($_POST['espermograma_biquimico']) && $_POST['espermograma_biquimico'] != '' ? $_POST['espermograma_biquimico'] : NULL;
    $simple_espermograma= isset($_POST['simple_espermograma']) && $_POST['simple_espermograma'] != '' ? $_POST['simple_espermograma'] : NULL;
    $cya_espermograma= isset($_POST['cya_espermograma']) && $_POST['cya_espermograma'] != '' ? $_POST['cya_espermograma'] : NULL;
    $vaginal_cultivo= isset($_POST['vaginal_cultivo']) && $_POST['vaginal_cultivo'] != '' ? $_POST['vaginal_cultivo'] : NULL;
    $endocervical_cultivo= isset($_POST['endocervical_cultivo']) && $_POST['endocervical_cultivo'] != '' ? $_POST['endocervical_cultivo'] : NULL;
    $cultivo_de_chla= isset($_POST['cultivo_de_chla']) && $_POST['cultivo_de_chla'] != '' ? $_POST['cultivo_de_chla'] : NULL;
    $otros_laboratorios= isset($_POST['otros_laboratorios']) && $_POST['otros_laboratorios'] != '' ? $_POST['otros_laboratorios'] : NULL;
    $diagnostico_laboratorios = isset($_POST['diagnostico_laboratorios']) && $_POST['diagnostico_laboratorios'] != '' ? $_POST['diagnostico_laboratorios'] : NULL;

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    //error_log(json_encode($_POST), 0);

    $params = array(
        "patient_id" => $patient_id,
        "app_id" => $app_id,


        "hemograma_completo" => $hemograma_completo,
        "tipificacion" => $tipificacion,
        "crasis_sanguinea" => $crasis_sanguinea,
        "test_de_coombs_indirecto" => $test_de_coombs_indirecto,
        "vdrl" => $vdrl,
        "if_p_toxoplasmosis" => $if_p_toxoplasmosis,
        "storch" => $storch,
        "hbs_ag" => $hbs_ag,
        "test_de_elisa_hiv" => $test_de_elisa_hiv,
        "chagas_igg_igm" => $chagas_igg_igm,
        "igmfta" => $igmfta,
        "abs" => $abs,
        "ft4_tsh" => $ft4_tsh,
        "progesterona" => $progesterona,
        "estradiol" => $estradiol,
        "fsh_lab" => $fsh_lab,
        "lh_lab" => $lh_lab,
        "bhch_cualitativo" => $bhch_cualitativo,
        "bhcg_cuantitativo" => $bhcg_cuantitativo,
        "prolactina" => $prolactina,
        "testosterona_libre" => $testosterona_libre,
        "androstenediona" => $androstenediona,
        "dhea_lab" => $dhea_lab,
        "amh_lab" => $amh_lab,
        "simple_lab" => $simple_lab,
        "cultivo_y_antibiograma" => $cultivo_y_antibiograma,
        "proteina_24hs" => $proteina_24hs,
        "vermes_y_protozoarios" => $vermes_y_protozoarios,
        "cya_heces" => $cya_heces,
        "sangre_oculta" => $sangre_oculta,
        "sangre_oculta" => $sangre_oculta,
        "glicemia_en_ayunas" => $glicemia_en_ayunas,
        "ttgo" => $ttgo,
        "urea" => $urea,
        "creatinina" => $creatinina,
        "ac_urico" => $ac_urico,
        "colesterol_vhl" => $colesterol_vhl,
        "trigliceridos" => $trigliceridos,
        "lipidos_totales" => $lipidos_totales,
        "hepatograma" => $hepatograma,
        "proteinas_tyfca_125" => $proteinas_tyfca_125,
        "ca_125" => $ca_125,
        "cea_lab" => $cea_lab,
        "ca_15_3" => $ca_15_3,
        "pyrilinksd" => $pyrilinksd,
        "alfa_fetos_proteinas" => $alfa_fetos_proteinas,
        "fta_abs" => $fta_abs,
        "pcr_lab" => $pcr_lab,
        "factor_reumatoideo" => $factor_reumatoideo,
        "lupus_anticoagulante" => $lupus_anticoagulante,
        "ac_antinucleares" => $ac_antinucleares,
        "monotest" => $monotest,
        "ac_anti_dna" => $ac_anti_dna,
        "ac_antifosfolípidos" => $ac_antifosfolípidos,
        "vitamina_d25oh" => $vitamina_d25oh,
        "espermograma_biquimico" => $espermograma_biquimico,
        "simple_espermograma" => $simple_espermograma,
        "cya_espermograma" => $cya_espermograma,
        "vaginal_cultivo" => $vaginal_cultivo,
        "endocervical_cultivo" => $endocervical_cultivo,
        "cultivo_de_chla" => $cultivo_de_chla,
        "otros_laboratorios" => $otros_laboratorios,
        "diagnostico_laboratorios" => $diagnostico_laboratorios

    );

    //if($patient_id === 'new'){
      $result = sw_create_laboratories($params);
    //}
    // else{
    //   $result = sw_update_patient($params);
    // }

    wp_die(json_encode($result));
}

add_action( 'wp_ajax_sw_create_laboratories_ajax', 'sw_create_laboratories_ajax');

//crea un paciente nuevo y tbm crea el post del tipo static-data-ago que le corresponde al paciente nuevo
function sw_create_laboratories($params){

      $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
      $patient_id = $params['patient_id'];
      $app_id = $params['app_id'];





      
      $hemograma_completo = $params['hemograma_completo'];
      $tipificacion = $params['tipificacion'];
      $crasis_sanguinea = $params['crasis_sanguinea'] ;
      $test_de_coombs_indirecto = $params['test_de_coombs_indirecto'];
      $vdrl = $params['vdrl'];
      $if_p_toxoplasmosis = $params['if_p_toxoplasmosis'];
      $storch = $params['storch'];
      $hbs_ag = $params['hbs_ag'];
      $test_de_elisa_hiv = $params['test_de_elisa_hiv'];
      $chagas_igg_igm = $params['chagas_igg_igm'];
      $igmfta = $params['igmfta'];
      $abs= $params['abs'];
      $ft4_tsh= $params['ft4_tsh'];
      $progesterona= $params['progesterona'];
      $estradiol= $params['estradiol'];
      $fsh_lab= $params['fsh_lab'];
      $lh_lab= $params['lh_lab'];
      $bhch_cualitativo= $params['bhch_cualitativo'];
      $bhcg_cuantitativo= $params['bhcg_cuantitativo'];
      $prolactina= $params['prolactina'];
      $testosterona_libre= $params['testosterona_libre'];
      $androstenediona= $params['androstenediona'];  
      $dhea_lab= $params['dhea_lab'];
      $amh_lab= $params['amh_lab'];
      $simple_lab= $params['simple_lab'];
      $cultivo_y_antibiograma= $params['cultivo_y_antibiograma'];
      $proteina_24hs= $params['proteina_24hs'];
      $vermes_y_protozoarios= $params['vermes_y_protozoarios'];
      $cya_heces= $params['cya_heces'];
      $sangre_oculta= $params['sangre_oculta'];
      $sangre_oculta= $params['sangre_oculta'];
      $glicemia_en_ayunas= $params['glicemia_en_ayunas'];
      $ttgo= $params['ttgo'];
      $urea= $params['urea'];
      $creatinina= $params['creatinina'];
      $ac_urico= $params['ac_urico'];
      $colesterol_vhl= $params['colesterol_vhl'];
      $trigliceridos= $params['trigliceridos'];
      $lipidos_totales= $params['lipidos_totales'];
      $hepatograma= $params['hepatograma'];
      $proteinas_tyfca_125= $params['proteinas_tyfca_125'];
      $ca_125= $params['ca_125'];
      $cea_lab= $params['cea_lab'];
      $ca_15_3= $params['ca_15_3'];
      $pyrilinksd= $params['pyrilinksd'];
      $alfa_fetos_proteinas= $params['alfa_fetos_proteinas'];
      $fta_abs= $params['fta_abs'];
      $pcr_lab= $params['pcr_lab'];
      $factor_reumatoideo= $params['factor_reumatoideo'];
      $lupus_anticoagulante= $params['lupus_anticoagulante'];
      $ac_antinucleares= $params['ac_antinucleares'];
      $monotest= $params['monotest'];
      $ac_anti_dna= $params['ac_anti_dna'];
      $ac_antifosfolípidos= $params['ac_antifosfolípidos'];
      $vitamina_d25oh= $params['vitamina_d25oh'];
      $espermograma_biquimico= $params['espermograma_biquimico'];
      $simple_espermograma= $params['simple_espermograma'];
      $cya_espermograma= $params['cya_espermograma'];
      $vaginal_cultivo= $params['vaginal_cultivo'];
      $endocervical_cultivo= $params['endocervical_cultivo'];
      $cultivo_de_chla= $params['cultivo_de_chla'];
      $otros_laboratorios= $params['otros_laboratorios'];
      $diagnostico_laboratorios= $params['diagnostico_laboratorios'];

      



      $patient_fields = get_post_custom($patient_id);
      $name = $patient_fields['nombre'][0];
      $lastname = $patient_fields['apellido'][0];
      //$cedula = $patient_fields['cedula'][0];
      $fullname = $name.'-'.$lastname;
      // $post_author = $params['post_author'];
      //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
      //devuelve el id del doctor que le corresponde 
      $patient_owner = sw_get_patient_owner();

      $my_post = array(
        'ID'   => 0,
        'post_title'    => wp_strip_all_tags( $fullname."- app_id: ".$app_id),
        'post_status'   => 'publish',
        //'post_author'   => get_current_user_id(),
        'post_author'   => $patient_owner,
        'post_type' => 'sw_laboratory',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      $post_id = wp_insert_post( $my_post );
      if ($post_id == 0) {
      //  wp_die( "Error creating a new Patient" );
      }
      $acf_fields = array(
            "hemograma_completo" => $hemograma_completo,
            "tipificacion" => $tipificacion,
            "crasis_sanguinea" => $crasis_sanguinea,
            "test_de_coombs_indirecto" => $test_de_coombs_indirecto,
            "vdrl" => $vdrl,
            "if_p_toxoplasmosis" => $if_p_toxoplasmosis,
            "storch" => $storch,
            "hbs_ag" => $hbs_ag,
            "test_de_elisa_hiv" => $test_de_elisa_hiv,
            "chagas_igg_igm" => $chagas_igg_igm,
            "igmfta" => $igmfta,
            "abs" => $abs,
            "ft4_tsh" => $ft4_tsh,
            "progesterona" => $progesterona,
            "estradiol" => $estradiol,
            "fsh_lab" => $fsh_lab,
            "lh_lab" => $lh_lab,
            "bhch_cualitativo" => $bhch_cualitativo,
            "bhcg_cuantitativo" => $bhcg_cuantitativo,
            "prolactina" => $prolactina,
            "testosterona_libre" => $testosterona_libre,
            "androstenediona" => $androstenediona,
            "dhea_lab" => $dhea_lab,
            "amh_lab" => $amh_lab,
            "simple_lab" => $simple_lab,
            "cultivo_y_antibiograma" => $cultivo_y_antibiograma,
            "proteina_24hs" => $proteina_24hs,
            "vermes_y_protozoarios" => $vermes_y_protozoarios,
            "cya_heces" => $cya_heces,
            "sangre_oculta" => $sangre_oculta,
            "sangre_oculta" => $sangre_oculta,
            "glicemia_en_ayunas" => $glicemia_en_ayunas,
            "ttgo" => $ttgo,
            "urea" => $urea,
            "creatinina" => $creatinina,
            "ac_urico" => $ac_urico,
            "colesterol_vhl" => $colesterol_vhl,
            "trigliceridos" => $trigliceridos,
            "lipidos_totales" => $lipidos_totales,
            "hepatograma" => $hepatograma,
            "proteinas_tyfca_125" => $proteinas_tyfca_125,
            "ca_125" => $ca_125,
            "cea_lab" => $cea_lab,
            "ca_15_3" => $ca_15_3,
            "pyrilinksd" => $pyrilinksd,
            "alfa_fetos_proteinas" => $alfa_fetos_proteinas,
            "fta_abs" => $fta_abs,
            "pcr_lab" => $pcr_lab,
            "factor_reumatoideo" => $factor_reumatoideo,
            "lupus_anticoagulante" => $lupus_anticoagulante,
            "ac_antinucleares" => $ac_antinucleares,
            "monotest" => $monotest,
            "ac_anti_dna" => $ac_anti_dna,
            "ac_antifosfolípidos" => $ac_antifosfolípidos,
            "vitamina_d25oh" => $vitamina_d25oh,
            "espermograma_biquimico" => $espermograma_biquimico,
            "simple_espermograma" => $simple_espermograma,
            "cya_espermograma" => $cya_espermograma,
            "vaginal_cultivo" => $vaginal_cultivo,
            "endocervical_cultivo" => $endocervical_cultivo,
            "cultivo_de_chla" => $cultivo_de_chla,
            "otros_laboratorios" => $otros_laboratorios,
            "diagnostico_laboratorios" => $diagnostico_laboratorios
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $post_id );
            }
        }

        add_post_meta( $post_id, 'related_laboratory', $app_id );
        add_post_meta( $post_id, 'laboratory_related_patient', $patient_id );

      $result['success'] = TRUE;
      $result['msg'] = 'Nuevo laboratorio creado - código: '.$post_id;
      return $result;
}

//POR EL MOMENTO NO USO YA QUE ESTOY CREANDO UN NUEVO POST POR CADA UPDATE DE INDICACION, DE MANERA A TENER UN HISTORIAL DE CAMBIOS. ESTA FUNCION ES UNA COPIA SIN MODIFICAR DE UPDATE_PATIENT
function sw_update_laboratories($params){

  $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
  $static_values = [];

    $patient_id = $params['patient_id'];
    $patient_name = $params['patient_name'];
    $patient_last_name = $params['patient_last_name'];
    $patient_ci = $params['patient_ci'];
    $email = $params['email'];
    $fecha_de_nacimiento = $params['fecha_de_nacimiento'];
    $departamento = $params['departamento'];
    $ciudad = $params['ciudad'];
    $direccion = $params['direccion'];
    $metodo_anticonceptivo = $params['metodo_anticonceptivo'];
    $telefono = $params['telefono'];
    $celular = $params['celular'];
    $establecimiento = $params['establecimiento'];
    $region_sanitaria = $params['region_sanitaria'];
    $epitelio_escamoso = $params['epitelio_escamoso'];

    $post_author = $params['post_author'];
    //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
    //devuelve el id del doctor que le corresponde 
    $patient_owner = sw_get_patient_owner();

    $my_post = array(
      'ID'   => $patient_id,
      'post_title'    => wp_strip_all_tags( $patient_name.' '. $patient_last_name ),
      'post_status'   => 'publish',
      //'post_author'   => get_current_user_id(),
      'post_author'   => $patient_owner,
      'post_type' => 'sw_patient'
      //'meta_input' => ["related_patient", $patient_post ]
      //'post_category' => array( 8,39 )
    );

    // Insert the post into the database // returns post id on succes. 0 on fail
    $post_id = wp_insert_post( $my_post );
    if ($post_id == 0) {
    //  wp_die( "Error creating a new Patient" );
    }

    $acf_fields = array(
          "nombre" => $patient_name,
          "apellido" => $patient_last_name,
          "cedula" => $patient_ci,
          "email_paciente" => $email,
          "fecha_de_nacimiento" => $fecha_de_nacimiento,
          "departamento" => $departamento,
          "ciudad" => $ciudad,
          "direccion" => $direccion,
          "metodo_anticonceptivo" => $metodo_anticonceptivo,
          "telefono" => $telefono,
          "celular" => $celular,
          "establecimiento" => $establecimiento,
          "region_sanitaria" => $region_sanitaria,
          "epitelio_escamoso" => $epitelio_escamoso
      );

      foreach ($acf_fields as $field => $value) {
          if($value != NULL){
              update_field( $field, $value, $patient_id );
          }
      }


    // returns an array containing the ID of the static data post related to this patient id.
    $the_query = sw_get_patient_static_data_ago($patient_id);
    $patient_ago_id =  $the_query[0];      

    //create the patient static data post type
    //send param array with name , lastname and $post_id wich is the receently created patient
     $static_values = ['patient_name'=>$patient_name,
                       'static_data_id'=>$patient_ago_id, 
                       'patient_last_name'=>$patient_last_name, 
                       'patient_id'=>$patient_id
                      ];

     $static_data = sw_create_static_data($static_values);

    $result['success'] = TRUE;
    $result['msg'] = 'Datos del paciente actualizados';
    return $result;
}

?>