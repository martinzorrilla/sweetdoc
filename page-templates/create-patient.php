<?php get_header();/* Template Name: Create Patient*/?>
<?php 
  $patient_id = $_GET['patient_id'];
  //si el parametro patient_id == new, el formulario debe ser editable por defecto, si no debe no ser editable
  $is_editable = $patient_id == "new" ? "true" : "false"; 
?>

  <div data-closable class="callout alert-callout-border secondary text-center">
    <h3>Agregar Paciente</h3>
  </div>

  <?php hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id, 'is_editable' => $is_editable ]); ?>

  <div class="row">  
    <div class="floated-label-wrapper large-6 columns text-center" style="padding-top: 1rem;">
      <button id="create-patient" class="submit_button save-button-expanded" type="submit" value="create-patient">
      <i class="fas fa-save 2x"></i>  <span class="app-dashboard-sidebar-text"> Guardar </span>
      </button>
      <p class="errorWrapper">
      </p>
    </div>
    <div class="floated-label-wrapper large-6 columns text-center" style="padding-top: 1rem;">
      <button id="toggle-input" class="toggle-input submit_button save-button-expanded" type="submit" value="toggle-input">
      <i class="fas fa-edit 2x"></i>  <span class="app-dashboard-sidebar-text"> Editar </span>
      </button>
      <p class="errorWrapper">
      </p>
    </div>
  </div>

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
        editPatientBtn = $("#toggle-input");
        createPatientForm = $("#create-patient-form");

        createPatientBtn.on("click", function (e) {
          createPatientBtn.fadeOut( "slow" );
          saveProfileData(e);
        })

        editPatientBtn.on("click", function (e) {
          // createPatientBtn.fadeOut( "slow" );
          toggleDisableInput(e);
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

    // function to enable and disable the edit on the create patient form. we get all the inputs in the form, all of them should 
    // have the class "disableable-input" so we can target only those inputs. then we can toggle the "disabled" property.
    function toggleDisableInput(e){
      e.preventDefault();
            
      var allInputs = createPatientForm.find(":input" );
      //alert("Found:  " + allInputs.length);
      allInputs.each(function(el) {
        //console.log($(this));
        if ($(this).hasClass( "disableable-input" )) {
          if ( $( this ).is( ":disabled" ) ){
            $(this).prop("disabled", false);        
          }else{
            $(this).prop("disabled", true);
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