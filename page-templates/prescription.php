<?php //acf_form_head(); ?>
<?php get_header();/* Template Name: Prescription*/?>
<?php
  
  $prescription_pdf_url = home_url().'/test';
  //check permissions for the user
  //this page should be visible only for a doctor role. else redirect to home page
  $the_role = sw_get_current_user_role();
  if($the_role != "doctor"){
    wp_redirect(home_url());
  }
  
  //The patient id is send from patients-all through the url so we grab here with $_GET
  $patient_id = $_GET['patient_id'];
  $app_id =  $_GET['app_id'];

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
  }
?>

  <h1 style="text-align: center; margin-left: 50px;">Prescripción</h1>
  <?php hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id]); ?>

  <div class="appform">
    <form id="create-prescription-form" name="create-prescription-form" method="post" class="text-center">

            <?php hm_get_template_part('template-parts/prescription/prescription-data', ['appointment_id' => $appointment_id]); ?>
          
        </form>
  </div>

  <div class="button-div">
    <a href="<?php echo esc_url( $prescription_pdf_url ); ?>">
      <button id="create-prescription" class="save-button-expanded" type="submit" value="Next">Crear Prescripción</button>
    </a>
    
    <p class="errorWrapper"></p>
  </div>


<?php get_footer(); ?>

<script >
  var CreatePrescriptionModule = function(){

    //global vars
    var $ = jQuery;
    var OrgTypeDropdown;
    var rolesDropdown;
    
    var createPrescriptionBtn;
    var createPrescriptionForm;
    
    var createPrescriptionClose;

    //added
    var myInputFile;
    var myFile;

    function init(){
      $(document).ready(function () {
        //dom queries 
        //OrgTypeDropdown = $('.org-type-dropdown select');
        //rolesDropdown = $('.role-type-dropdown select');
        createPrescriptionBtn = $("#create-prescription");
        createPrescriptionForm = $("#create-prescription-form");
        createPrescriptionClose = $("#create-prescription-close");

        //console.log("createProfileForm", createAppointmentForm);

        //added
        //myInputFile = $(".filelabel");
        //myFile = $("#profile_photo");

        //to toggle slide of the private data section in appointment page
        /*$(".static-data-click-to-show").click(function(){
            $(".static-data-slide").slideToggle( "slow" );
        });*/

        //define events
/*        OrgTypeDropdown.on("change", function () {
          onDropdownChange($(this));
        });*/

        createPrescriptionBtn.on("click", function (e) {
          createPrescriptionBtn.fadeOut( "slow" );
          //saveProfileData(e);
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
      var inputs = createPrescriptionForm.find("input, select, textarea");
      var serializedInputs = createPrescriptionForm.serializeArray();
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
      //formData.append("static_data_post_id", "<?php //echo $static_data_post_id ?>");
      //formData.append("colpo_post_id", "<?php //echo $colpo_post_id ?>");

      formData.append("action", "sw_create_prescription_ajax");

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

  CreatePrescriptionModule.init();
</script>