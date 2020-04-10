var CreateLaboratoriesModule = function(){

    //global vars
    var $ = jQuery;
    
    var createLaboratoriesBtn;
    //var editPatientBtn;
    
    var createLaboratoriesForm;
    

    function init(){
      $(document).ready(function () {
        //dom queries 
        if(performance.navigation.type == 2){
          console.log("se presiono el boton atras");
          location.reload(true);
       }
        
        // console.log("home: ", window.location.hostname);
        // console.log("path: ", window.location.pathname);
        // var hostnamePAthLocal= "/sweetdoc/";
        // var patientPathLocal = "/pacientes/";
        // console.log("search: ", window.location.search);
        // console.log("hash: ", window.location.hash);

        //createProfileClose = $("#create-profile-close");
        //alert("hola");
        createLaboratoriesBtn = $("#create-laboratory");
        //editPatientBtn = $("#toggle-input");
        
        createLaboratoriesForm = $("#create-laboratories-form");

        createLaboratoriesBtn.on("click", function (e) {
          createLaboratoriesBtn.fadeOut( "slow" );
            alert("se creara una solicitud de laboratorio");
          saveProfileData(e);
        })
      });
    }

    function saveProfileData(e) {
      e.preventDefault();
      //alert("Se guardaran los datos");
      var $ = jQuery;
      //var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      var myData = createLaboratoriesForm.serialize();
      
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
            //window.history.go(-1) //funciona, lleva a la pagina anterior.
            window.location.reload();          
           //window.location.replace("https://www.tutorialrepublic.com");
 
          }
        },
        error: function() {
            alert('error handling the Laboratory creation');
        }
      });// $.ajax
    }

  return{
    init:init
  }

  }();
  CreateLaboratoriesModule.init();