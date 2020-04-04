
var GloblasModule = function(){

    //global vars
    var $ = jQuery;
 
    var createPatientForm;
    var editPatientBtn;

    function init(){
      $(document).ready(function () {
        //dom queries 
        createPatientForm = $("#create-patient-form");
        editPatientBtn = $("#toggle-input");
        
        editPatientBtn.on("click", function (e) {
            // createPatientBtn.fadeOut( "slow" );
            toggleDisableInput(e);
        })



        //to toggle slide of the private-data / AGO section in appointment page
        $(".static-data-click-to-show").click(function(){
          $(".static-data-slide").slideToggle( "slow" );
      });



      });
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
  GloblasModule.init();