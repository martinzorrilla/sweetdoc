<?php get_header();/* Template Name: Create Patient*/?>

<div data-closable="" class="callout alert-callout-border secondary text-center">
  <h3>Agregar Paciente</h3>
</div>


<?php $patient_id = ""; hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id]); ?>

<?php get_footer(); ?>

<script >
  var CreatePatientModule = function(){

    //global vars
    var $ = jQuery;

    
    var createPatientBtn;

/*    var createAppointmentForm;
    var createProfileClose;
    //added
    var myInputFile;
    var myFile;*/

    function init(){
      $(document).ready(function () {
        //dom queries 
        //OrgTypeDropdown = $('.org-type-dropdown select');
        //rolesDropdown = $('.role-type-dropdown select');
        //createProfileClose = $("#create-profile-close");
        
        createPatientBtn = $("#create-patient");
        createPatientForm = $("#create-patient-form");

        createPatientBtn.on("click", function (e) {
          createPatientBtn.fadeOut( "slow" );
          saveProfileData(e);
        })

      });
    }



    function populateFormData() {
      //var inputs = createAppointmentForm.serializeArray();
      var inputs = createPatientForm.find("input, select, textarea, date, email, checkbox");
      var serializedInputs = createPatientForm.serializeArray();
      var formData = new FormData();


      //console.log("serializedInputs", serializedInputs);


      $.each(serializedInputs, function (i, element) {
        formData.append(element.name, element.value);
        console.log("name: "+ element.name + " - value: " + element.value);
      });

      //formData.append("app_id", "<?php //echo $appointment_id ?>");
      //formData.append("patient_id", "<?php //echo $patient_id ?>");
      //formData.append("app_id", "55");

      formData.append("action", "sw_create_patient_ajax");

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
            //var oldUrl = window.location.href; 
            //var replaceId = "app_id="+result['app_id'];
            //var newUrl = oldUrl.replace("app_id=new", replaceId);
            //window.location.replace(newUrl);
            window.location.reload();
          }
        }
      });
    }


  return{
    init:init
  }

  }();

  CreatePatientModule.init();
</script>