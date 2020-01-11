<?php //acf_form_head(); ?>
<?php get_header();/* Template Name: Appointment*/?>
<?php
  
  //check permissions for the user
  //this page should be visible only for a doctor role. else redirect to home page
  $the_role = sw_get_current_user_role();
/*   if($the_role != "doctor"){
    wp_redirect(home_url());
  } */
  
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

  <div class="callout secondary">
    <h3 style="text-align: center; margin-left: 50px;">Fecha de la Consulta: <strong> <?php echo $app_creation_date ?> </strong></h3>
  </div>
  
  <div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
  </div>
  <div class="appform tabcontent">
    <?php hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id]); ?>
  </div>

  <div class="appform">
    <form id="create-appointment-form" name="create-appointment-form" method="post" class="text-center">
          

          <div class="tab">
            <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
          </div>
          <div class="appform tabcontent">
            <?php hm_get_template_part('template-parts/appointment/static-data', ['static_data_post_id' => $static_data_post_id]); ?>
          </div>

          <fieldset>
            <?php //hm_get_template_part('template-parts/appointment/common-data', ['appointment_id' => $appointment_id]); ?>
            <?php hm_get_template_part('template-parts/appointment/motivo-consulta', ['appointment_id' => $appointment_id]); ?>
          </fieldset>

          <div class="tab">
            <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
          </div>
          <div class="appform tabcontent">
            <?php hm_get_template_part('template-parts/appointment/colposcopia', ['colpo_post_id' => $colpo_post_id]); ?>
          </div>
        </form>
  </div>

  <div class="button-div">
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

        //define events
        /* OrgTypeDropdown.on("change", function () {
          onDropdownChange($(this));
        });*/

        createAppBtn.on("click", function (e) {
          //get_checkbox_values();
          createAppBtn.fadeOut( "slow" );
          saveProfileData(e);
        })

        /* createProfileClose.on("click" ,function (e) {
          oncreateAppBtnClose();
        }) */

      });
    }//function init

    //-------------- FUNCTIONS

    /* function oncreateAppBtnClose() {
      $('#interests').foundation('open');
    }

    function onDropdownChange(OrgDrop) {
      var rolesDropdownContainer = $(".create-div .roles-dropdown-container");
      var spinnerIcon = $(".create-div .roles-dropdown-container .roles-dropdown-spinner-icon");
      var selected = OrgDrop.find(":selected").text();
      var params = { action: "get_roles_options", selected: selected };

      spinnerIcon.attr("loading", true);
      rolesDropdownContainer.attr("dropdown-disabled", true);

      $.get(window.homeUrl + "/wp-admin/admin-ajax.php", params, function(data){
        var results = JSON.parse(data);

        $(rolesDropdown).html("");
        $(rolesDropdown).append("<option value='*' selected='selected'>Select Your Role</option>");

        for (var i = 0; i < results.length; i++) {
          $(rolesDropdown).append("<option value='"+results[i].term_id+"'>"+results[i].name+"</option>");
        }

        spinnerIcon.attr("loading", false);
        if(selected !== "Select Organization Type"){
          rolesDropdownContainer.attr("dropdown-disabled", false);
        }

        $(rolesDropdown).trigger("liszt:updated");
      });
    }*/

    function populateFormData() {
      //var inputs = createAppointmentForm.serializeArray();
      var inputs = createAppointmentForm.find("input, select, textarea");
      var serializedInputs = createAppointmentForm.serializeArray();
      var formData = new FormData();


      console.log("serializedInputs", serializedInputs);

      
      //-- code section to get the file
      $.each(inputs.filter('[type="file"]'), function (i, element) {
        var input = $(element)[0].files;
        $.each(input, function (j, file) {
          //console.log("file", file);
          formData.append(file.name, file);
        });
      });
      //--
      
      $.each(serializedInputs, function (i, element) {
        formData.append(element.name, element.value);
      });

      //append the checkbox values to the form
      var checkbox_values = [];
      checkbox_values = get_checkbox_values();
      alert( typeof checkbox_values);
      formData.append("checkbox_values", checkbox_values);
      

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
      // Display the key/value pairs
      for (var pair of formData.entries())
      {
       console.log(pair[0]+ ', '+ pair[1]); 
      }

      $.ajax({
        url: window.homeUrl + "/wp-admin/admin-ajax.php",
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data){
          var result = JSON.parse(data);
          console.log("result", result);
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