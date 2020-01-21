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
      //var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      var myData = createPatientForm.serialize();
      
      $.ajax({
        type: "POST",
        url:window.homeUrl + "/wp-admin/admin-ajax.php",
        data: myData,
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