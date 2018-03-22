<?php //acf_form_head(); ?>
<?php get_header();/* Template Name: Appointment*/?>
<?php
  
  //The patient id is send from patients-all through the url so we grab here with $_GET
  $patient_id = $_GET['patient_id'];
  $app_id =  $_GET['app_id'];

  echo "</br> patient_id: (" . $patient_id . "): </br>";

  $post7 = get_post_meta($patient_id);
  //wp_die(var_dump($post7));

  $patient_fields = get_post_custom($patient_id);

  //load all the data we need from the Person Post
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $fullname = $name.' '.$lastname;

  //load all the data we need from the Person Post
 /* $name = get_field('nombre', $patient_id);
  $lastname = get_field('apellido', $patient_id);
  $cedula = get_field('cedula', $patient_id);
  $fullname = $name.' '.$lastname;
*/ 
  //ACF get field IS NOT WORKING for the app posst type when it's just been created so we use geet_post_custom instead to retrieve the data.
  $stored_fields = get_post_custom($app_id);
  echo "</br> get_fields(" . $app_id . "): </br>";
  var_dump($stored_fields);
  echo '</br></br>';


  if ($app_id === 'new') {
    echo "  nueva consulta";
    $appointment_id = $app_id;
  }//if new patient = true

  else{
  echo "no es una nueva consulta";
  $appointment_id = $app_id;
  
  $menarca = $stored_fields['menarca'][0];
  $irs = $stored_fields['irs'][0];
  }
?>

<div class="patient-div">

  <ul class="menu align-center">
    <li><a href="#">Onee</a></li>
    <li><a href="#">Two</a></li>
    <li><a href="#">Three</a></li>
  </ul>

  <h1>Consulta</h1>

  <div class="card profile-card-action-icons">
    <div class="card-section">
      <div class="profile-card-header">
        <div class="profile-card-avatar">
          <img class="avatar-image" src="https://i.imgur.com/3AeQRbR.jpg" alt="Harry Manchanda">
        </div>
        <div class="profile-card-author">
          <h5 class="author-title"><?php echo $fullname." ci:".$cedula ?></h5>
          <p class="author-description">Paciente</p>
        </div>
      </div>
      <div class="profile-card-about">
        <h5 class="about-title separator-left">Acerca de <?php echo $name?></h5>
        <p class="about-content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem eveniet nulla quae ullam sit iure voluptatum, nesciunt voluptas perferendis, minus natus in quaerat?
        </p>

        <br>
        <h5 class="about-title separator-left">Ultimo estudios</h5>
        
        <div class="row about-skills">
          <div class="small-6 columns">
            <ul class="arrow">
              <li>Ecografia</li>
              <li>Colposcopia</li>
              <li>Analisis de Sangre</li>
            </ul>
          </div>
          <div class="small-6 columns">
            <ul class="arrow">
              <li>Maths</li>
              <li>Dancing</li>
              <li>Smiling</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php //hm_get_template_part('parts/components/currently-working-on', ['person_post_id' => $current_post_id[0]]); ?>

  <?php //hm_get_template_part('template-parts/appointment/ago', ['appointment_id' => $appointment_id]); ?>



  <div class="appform">
    <form id="create-appointment-form" name="create-appointment-form" method="post" class="text-center">
          <fieldset>
            <div class="floated-label-wrapper">
              <label for="menarca">Menarca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="menarca" name="menarca" value="<?php echo $menarca ?>" placeholder="Type..." required>
            </div>

            <div class="floated-label-wrapper">
              <label for="irs">IRS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="irs" name="irs" value="<?php echo $irs ?>" placeholder="Type..." required>
            </div>

            <button id="create-appointment" class="submit_button" type="submit" value="Next">Guardar</button>
            <p class="errorWrapper">
            </p>

          </fieldset>
        </form>
  </div>
</div><!-- patient-div -->
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

        //added
        myInputFile = $(".filelabel");
        myFile = $("#profile_photo");

        //define events
/*        OrgTypeDropdown.on("change", function () {
          onDropdownChange($(this));
        });*/

        createAppBtn.on("click", function (e) {
          saveProfileData(e);
        })

/*        createProfileClose.on("click" ,function (e) {
          oncreateAppBtnClose();
        })

        //added
        myInputFile.on("click" ,function (e) {
          onUploadFile();
        })

        myFile.on("change" ,function (e) {
          onFileChange(e);
        })*/


      });
    }

/*    function oncreateAppBtnClose() {
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

      /*$.each(inputs.filter('[type="file"]'), function (i, element) {
        var input = $(element)[0].files;
        $.each(input, function (j, file) {
          //console.log("file", file);
          formData.append(file.name, file);
        });
      });*/

      $.each(serializedInputs, function (i, element) {
        formData.append(element.name, element.value);
      });

      formData.append("app_id", "<?php echo $appointment_id ?>");
      formData.append("patient_id", "<?php echo $patient_id ?>");
      //formData.append("app_id", "55");

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

   /* function onUploadFile() {
      $("#profile_photo").trigger("click");
    }

    function onFileChange(e) {
      //$( "div#success span.user-email" ).html(reset_pass);
      var fileName = '';

      //fileName =  $('#profile_photo').val();
      
      let file = $("#profile_photo")[0].files[0]; 

      //$( "p.filetext" ).html("File changed");
      $( "p.filetext" ).html(file.name);
    }*/

  return{
    init:init
  }

  }();

  CreateProfileModule.init();
</script>