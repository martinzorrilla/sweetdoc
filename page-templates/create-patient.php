<?php get_header();/* Template Name: Create Patient*/?>


<div data-closable class="callout alert-callout-border secondary text-center">
  <h3>Agregar Paciente</h3>
</div>
<?php $patient_id = ""; hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id]); ?>


<?php get_footer(); ?>

<script >
  var CreatePatientModule = function(){

    //global vars
    var $ = jQuery;
    
    var createPatientBtn;
    var createPatientForm;

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

    function saveProfileData(e) {
      e.preventDefault();
      //alert("Se guardaran los datos");
      var $ = jQuery;

      $.ajax({
        type: "POST",
        url:window.homeUrl + "/wp-admin/admin-ajax.php",
        data: createPatientForm.serialize(),
        dataType: "json",
        success: function(data) {
          //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
          // do what ever you want with the server response
          //var result = $.parseJSON(data); esto es viejo, de la parte que hacia mal creo

          // console.log("data response", data);
          // alert(data['msg']);
          // window.location.reload();

          if(data.error.length >0){
            if(data.error){
              //alert(data.error.msg);
              alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_appointment_ajax ');
              //let errorMsg = result.error.msg;
              //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
            }
          }
          if(data.success){
            alert(data['msg']);
            //$('#interests').foundation('open');
            //var oldUrl = window.location.href; 
            //var replaceId = "app_id="+result['app_id'];
            //var newUrl = oldUrl.replace("app_id=new", replaceId);
            //window.location.replace(newUrl);
            window.location.reload();
          }
        },
        error: function() {
            alert('error handling here');
        }
      });// $.ajax
    }

  return{
    init:init
  }

  }();
  CreatePatientModule.init();
</script>