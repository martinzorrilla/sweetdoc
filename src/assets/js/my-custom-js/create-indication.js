var CreateIndicationModule = function(){

    //global vars
    var $ = jQuery;
    
    var createIndicationBtn;
    var editPatientBtn;
    
    var createIndicationForm;
    

    function init(){
      $(document).ready(function () {
        //dom queries 
        
        //createProfileClose = $("#create-profile-close");
        
        createIndicationBtn = $("#create-indication");
        editPatientBtn = $("#toggle-input");
        
        createIndicationForm = $("#create-indication-form");

        createIndicationBtn.on("click", function (e) {
          createIndicationBtn.fadeOut( "slow" );
            // metemos el div con el spinner hasta que se retonrne del ajaz request
          $("#overlay").fadeIn(300);
          //  alert("se creara una nueva indicacion");
          saveProfileData(e);
        })
      });
    }

    function saveProfileData(e) {
      e.preventDefault();
      //alert("Se guardaran los datos");
      var $ = jQuery;
      //var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      var myData = createIndicationForm.serialize();
      
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

          if(data.error.length >0){
            if(data.error){
              //alert(data.error.msg);
              alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_appointment_ajax ');
              //let errorMsg = result.error.msg;
              //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
            }
          }
          if(data.success){
            // alert(data['msg']);
            // window.location.reload();
            setTimeout(function(){
              $("#overlay").fadeOut(300);
            },500);
             window.history.back();
            //window.location.replace('/sweetdoc/pacientes/');
            //window.location.replace('/sweetdoc/sw_patient/');



          }
        },
        error: function() {
            alert('error handling the indication creation');
        }
      });// $.ajax
    }

  return{
    init:init
  }

  }();
  CreateIndicationModule.init();