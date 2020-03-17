<?php //acf_form_head(); ?>
<?php get_header();/* Template Name: Appointment*/?>
<?php
  
  //check permissions for the user
  //this page should be visible only for a doctor role. else redirect to home page
  $the_role = sw_get_current_user_role(); // antes usaba esta funcion pero puedo hacer lo mismo con 'current_user_can()'
   if(!current_user_can('doctor') && !current_user_can('administrator')){
     echo "El usuario no es doctor o admin. no puede ver esta pagina";
      //wp_redirect( esc_url( wp_login_url() ), 307);
      //wp_redirect('http://example.com/'); exit;
   }
  
  //The patient id is send from patients-all through the url so we grab here with $_GET
  $patient_id = $_GET['patient_id'];
  $app_id =  $_GET['app_id'];
  $app_creation_date = get_the_date( 'd-M-Y', $app_id );

  //this is to get the id of the static_data post for this patient
  //returns an array 
  $static_data_array = sw_get_static_data_id($patient_id);
  $static_data_post_id = $static_data_array[0];


  //ACF get field IS NOT WORKING for the app posst type when it's just been created so we use geet_post_custom instead to retrieve the data.
  $stored_fields = get_post_custom($app_id);

  if ($app_id === 'new') {
    //echo "  nueva consulta";
    $appointment_id = $app_id;
    $colpo_post_id = 'new';
  }//if new patient = true
  else{
    //echo "no es una nueva consulta";
    $appointment_id = $app_id;
    //get the colposcopia post id for this app
    $colpo_patient_array = sw_get_colpo_id($appointment_id);
    $colpo_post_id = $colpo_patient_array[0];
    //echo "Colpo Post Id = ";
    //var_dump($colpo_post_id);
  }
?>

  <div class="callout secondary" style="display: <?php if ($app_id === 'new') echo 'none' ?> " >
    <h3 style="text-align: center; margin-left: 50px;">Fecha de la Consulta: <strong> <?php echo $app_creation_date ?> </strong></h3>
  </div>
  
  <!-- <div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
  </div> -->
  <!-- <div class="appform tabcontent">
    <?php //hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id]); ?>
  </div> -->

  <div class="appform">
    <form id="create-appointment-form" name="create-appointment-form" method="post"  class="text-center" enctype="multipart/form-data">
          
            <?php hm_get_template_part('template-parts/appointment/static-data', ['static_data_post_id' => $static_data_post_id, 'patient_id' => $patient_id]); ?>

          <fieldset>
            <?php //hm_get_template_part('template-parts/appointment/common-data', ['appointment_id' => $appointment_id]); ?>
            <?php hm_get_template_part('template-parts/appointment/motivo-consulta', ['appointment_id' => $appointment_id]); ?>
          </fieldset>
          
            <?php hm_get_template_part('template-parts/appointment/colposcopia', ['colpo_post_id' => $colpo_post_id]); ?>

    </form>
  </div>

  <div class="button-div" style="margin-bottom:70px">
    <button id="create-appointment" class="save-button-expanded" type="submit" value="Next">Guardar</button>
    <p class="errorWrapper"></p>
  </div>


<?php get_footer(); ?>

<script >
  var CreateProfileModule = function(){

    //global vars
    var $ = jQuery;
    var OrgTypeDropdown;
    var rolesDropdown;
    
    var createAppBtn;
    var createAppointmentForm;
    
    var createProfileClose;

    //added
    var myInputFile;
    var myFile;

    function init(){
      $(document).ready(function () {
        //dom queries 
        OrgTypeDropdown = $('.org-type-dropdown select');
        rolesDropdown = $('.role-type-dropdown select');
        createAppBtn = $("#create-appointment");
        createAppointmentForm = $("#create-appointment-form");
        createProfileClose = $("#create-profile-close");

        //console.log("createProfileForm", createAppointmentForm);

        var fileInput = document.querySelector('input[type="file"]');
        var preview = document.querySelector('.preview');

        fileInput.style.opacity = 0;
        //fileInput.addEventListener('change', updateImageDisplay(preview, fileInput));
        fileInput.addEventListener('change', updateImageDisplay);


        //to toggle slide of the private data section in appointment page
        $(".static-data-click-to-show").click(function(){
            $(".static-data-slide").slideToggle( "slow" );
        });


        createAppBtn.on("click", function (e) {
          //get_checkbox_values();
          createAppBtn.fadeOut( "slow" );
          saveProfileData(e);
        })


      });
    }//function init


  // POR QUE USO populateFormData() Y FORMDATA:
  // lo ideal y mas sencillo seria tomar los datos del formulario simplemente con serialize(); y no usar populateFormData
  // como lo hacemos en create-patient-js.
  // El PROBLEMA es que de esa forma no se pueden enviar inputs del tipo FILE, los cuales necesitamos para poder agregar imagenes a las colposcopias, por eso nos vemos obligados a usar formData y añadir los demas inputs con el metodo populateFormData()   
  function populateFormData() {
    //var inputs = createAppointmentForm.serializeArray();
    var inputs = createAppointmentForm.find("input, select, textarea");
    var serializedInputs = createAppointmentForm.serializeArray();
    //no recuerdo por que no logre hacer funcionar con serialize(); por eso uso serializeArray(); 
    //var serializedInputs = createAppointmentForm.serialize();
    var formData = new FormData();


    //console.log("serializedInputs", serializedInputs);

    
    //Procedimiento para agregar los archivos de imagenes de las colposcopias al formdata
    $.each(inputs.filter('[type="file"]'), function (i, element) {
      var input = $(element)[0].files;
      $.each(input, function (j, file) {
        //console.log("file", file);
        formData.append(file.name, file);
      });
    });
    
    
    $.each(serializedInputs, function (i, element) {
      formData.append(element.name, element.value);
    });


    // EL PROBLEMA: 
    // searializArray() funciona correctamente cuando algun valor de los campos del checkbox es seleccionado i.e: al seleccionar el field "inyectable" del checkbox metodoanticopnceptivo genera el array "metodo_anticonceptivo":["preservativos",""] con lo cual se puede guardar los cambios con acf.
    // PERO cuando se desmarca todos los checkboxes fields, serializeArray() simplemente omite enviar ese campo, en vez de generar un array con el nombre de ese campo y valores vacios, es decir, algo asi: "metodo_anticonceptivo":["",""]
    // que es lo que se necesita para que acf pueda guardar los cambios.
    // Solucion: 
    // Este procedimiento se encarga de generar dicho array por cada input del tipo checkbox y lo agrega al formData
    $('#create-appointment-form input[type="checkbox"]:not(:checked)').each(function(i, e) {
        formData.append(e.name, "");
    });

    formData.append("app_id", "<?php echo $appointment_id ?>");
    formData.append("patient_id", "<?php echo $patient_id ?>");
    formData.append("static_data_post_id", "<?php echo $static_data_post_id ?>");
    formData.append("colpo_post_id", "<?php echo $colpo_post_id ?>");

    formData.append("action", "sw_create_appointment_ajax");

    return formData;
  }

  function saveProfileData(e) {
    e.preventDefault();

    //alert("Se guardaran los datos");
    var $ = jQuery;
    var formData = populateFormData();

    //console.log("formData = ", formData);
    //Display the key/value pairs
    for (var pair of formData.entries())
    {
       console.log(pair[0]+ ', '+ pair[1]); 
    }

    // SI USABAMODS serialize() en vez de serializeArray(), de esta forma debiamos apendar los campos extras
    //var myData = createAppointmentForm.serialize();
    // var myData = createAppointmentForm.serialize() + 
    // '&patient_id=' + '<?php //echo $patient_id?>' + 
    // '&app_id=' + '<?php //echo $appointment_id ?>' + 
    // '&static_data_post_id=' + '<?php //echo $static_data_post_id ?>' + 
    // '&colpo_post_id=' + '<?php //echo $colpo_post_id ?>' + 
    // '&action=' + 'sw_create_appointment_ajax';

    $.ajax({

      type: "POST",
      enctype: 'multipart/form-data',
      url: window.homeUrl + "/wp-admin/admin-ajax.php",
      data: formData,
      //dataType: "json",
      processData: false,
      contentType: false,
      success: function(data){
        var result = JSON.parse(data);
        //console.log("result", result);
        //handle error
        if(result.error.length >0){
        //if(result.error){
          //alert(result.error.msg);
          alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_appointment_ajax ');
          //let errorMsg = result.error.msg;
          //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
        }
        if(result.success){
          alert(result['msg']);
          //$('#interests').foundation('open');
          var oldUrl = window.location.href; 
          var replaceId = "app_id="+result['app_id'];
          var newUrl = oldUrl.replace("app_id=new", replaceId);
          window.location.replace(newUrl);
          //window.location.reload();
        }
      }
    });
  }

  /*--------------------------------------*/
  function updateImageDisplay(preview, fileInput) {

    fileInput = document.querySelector('input[type="file"]');
    preview = document.querySelector('.preview');
    //cuando hay un cambio en input, remover todos los childs de preview
    while(preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    console.log("fileInput", fileInput.files);
    var curFiles = fileInput.files;
    //si no se agregan o no hay ningun file, apendar a preview un parrafo con texto
    if(curFiles.length === 0) {
      var para = document.createElement('p');
      para.textContent = 'No hay archivos seleccionados';
      preview.appendChild(para);
    } else {
      var list = document.createElement('ol');
      preview.appendChild(list);
      for(var i = 0; i < curFiles.length; i++) {
        //var liContainer = document.createElement('div');
        //liContainer.classList.add("row");
        var listItem = document.createElement('li');
        //liContainer.appendChild(listItem);
        
        //$( listItem ).wrap( "<div class='row'></div>" );
        
        var para = document.createElement('p');
        //para.classList.add("small-12");
        //si el tipo es validoy el tamnho no exede los 6MB
        if(validFileType(curFiles[i]) && curFiles[i].size < 6291456) {
          //add a class to change to succes/valid color
          //$(listItem).css('background', '#2c3840');
          
           para.textContent = 'Nombre del archivo:  ' + curFiles[i].name;
          //var paraText = 'Archivo:  ' + curFiles[i].name + '<br> Tamaño: ' + returnFileSize(curFiles[i].size) + '.';
          //$(para ).html(paraText);

          var image = document.createElement('img');
          
          image.src = window.URL.createObjectURL(curFiles[i]);

          var liContainer = document.createElement('div');
          liContainer.classList.add("row");
          //var listItem = document.createElement('li');
          listItem.appendChild(liContainer);

          liContainer.appendChild(image);
          $( image ).wrap( "<div class='large-6 medium-6 small-12 columns colpo-files-list'></div>" );
          liContainer.appendChild(para);
          $( para ).wrap( "<div class='large-6 medium-6 small-12 columns'></div>" );

        } else {
          //agregar estilo para hacerlo de color rojo
          //$( listItem ).addClass( "listItem-error-color" );
          $(listItem).css('background', '#cc4b37');
          para.textContent = 'Nombre del archivo: ' + curFiles[i].name + '  -   Tipo de archivo incorrecto. Actualice las seleccion.';
          listItem.appendChild(para);
        }

        list.appendChild(listItem);
      }
    }
  }

  var fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
  ]

  function validFileType(file) {
    for(var i = 0; i < fileTypes.length; i++) {
      if(file.type === fileTypes[i]) {
        return true;
      }
    }

    return false;
  }

  function hello_world(){
    alert("hello_world");
  }

  function get_checkbox_values(){
    
    var checked_values = [];
      $("input[type=checkbox]").each(function(){
        if (this.checked) {
          checked_values.push($(this).val());
        }
      });// each
      console.log(checked_values);
      //alert("check your console");
      return checked_values;  
  }

  function returnFileSize(number) {
    if(number < 1024) {
      return number + 'bytes';
    } else if(number >= 1024 && number < 1048576) {
      return (number/1024).toFixed(1) + 'KB';
    } else if(number >= 1048576) {
      return (number/1048576).toFixed(1) + 'MB';
    }
  }
/*--------------------------------------*/

  return{
    init:init
  }

  }();

  CreateProfileModule.init();
</script>