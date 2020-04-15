var CreateIndicationModule = function(){

    //global vars
    var $ = jQuery;
    
    var createStudiesBtn;
    var editPatientBtn;
    
    var createStudiesForm;
    

    function init(){
      $(document).ready(function () {
        //dom queries 
        
        //createProfileClose = $("#create-profile-close");
        
        createStudiesBtn = $("#create-studies");
        editPatientBtn = $("#toggle-input");
        
        createStudiesForm = $("#create-studies-form");

        createStudiesBtn.on("click", function (e) {
          createStudiesBtn.fadeOut( "slow" );
            alert("se creara una solicitud de estudio");
          saveProfileData(e);
        })
      });
    }

    function saveProfileData(e) {
      e.preventDefault();
      //alert("Se guardaran los datos");
      var $ = jQuery;
      //var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      var myData = createStudiesForm.serialize();
      
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
            alert(data['msg']);
//            window.location.reload();
            window.history.back();


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