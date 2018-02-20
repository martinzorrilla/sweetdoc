<?php //acf_form_head(); ?>
<?php get_header();/* Template Name: Appointment*/?>
<?php
  
  $patient_id = $_GET['patient_id'];
  //The patient id is send from patients-all through the url so we grab here with $_GET
  //$patient_post = get_post($_GET['patient_id']);
  //var_dump($patient_post);

  $local_timestamp = get_the_time('U');


  //load all the data we need
  $name = get_field('nombre', $patient_id);
  $lastname = get_field('apellido', $patient_id);
  $cedula = get_field('cedula', $patient_id);
  $fullname = $name.' '.$lastname;
  echo $fullname;

  //wp_reset_postdata(); //always reset the post data!
  //echo(" id del paciente:");
  //echo $patient_post; // output 2489
  echo(" old app_id:");
  echo $_GET['app_id']; // output 2489

  $menarca = get_field('menarca', $_GET['app_id']);
  echo "menarCA:  ";
  var_dump($menarca);


  $app_id = $_GET['app_id'];
  if ($app_id === 'new') {
    echo "  nueva consulta";
    $my_post = array(
      'post_title'    => wp_strip_all_tags( $fullname.$local_timestamp ),
      //'post_content'  => $_POST['post_content'],
      'post_status'   => 'publish',
      'post_author'   => get_current_user_id(),
      'post_type' => 'sw_consulta',
      //'meta_input' => ["related_patient", $patient_post ]
      //'post_category' => array( 8,39 )
    );

    // Insert the post into the database // returns post id on succes. 0 on fail
    $app_post = wp_insert_post( $my_post );
    if ($app_post == 0) {
      wp_die( "Error creating a new appointment" );
    }

    add_post_meta( $app_post, 'related_patient', $patient_id );
  
    $appointment_id = $app_post;

    echo "## newly created app_id: ";
    echo $appointment_id;
  }//if new patient = true

  else{
  echo "no es una nueva consulta";
  $appointment_id = $app_id;
  //$appointment_id = get_post($_GET['app_id']);
  
  $appointment_post_id = get_post($app_id);
  //$aux = get_post($app_id);
  //$appointment_id = 85;
  //  var_dump($aux);
  $menarca = get_field('menarca', $app_id);
  $irs = get_field('irs', $app_id);

  echo "menarcaa: ".$menarca;
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

<?php 
/*acf_form(array(
          'post_id' => $appointment_post_id,
          'post_title'  => false,
          'submit_value'  => 'Update the post!'
        )); 
*/
?>

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
      //formData.append("app_id", "55");

      formData.append("action", "sw_create_appointment");

      return formData;
    }

    function saveProfileData(e) {
      e.preventDefault();

      alert("askfjnsdkjnasdnl");
      var $ = jQuery;
      var formData = populateFormData();

      //console.log("window.homeUrl = ", window);

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
            alert(result.error.msg);
            alert('errorrrrr');

            //let errorMsg = result.error.msg;
            //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
          }
          if(result.success){
            alert("Creacion de Consulta exitosa");
            //$('#interests').foundation('open');
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