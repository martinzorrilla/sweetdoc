
var GloblasModule = function(){

    //global vars
    var $ = jQuery;
 
    var createPatientForm;
    var editPatientBtn;
    var tabSinglePatient;
    var tabEcoVenosa;
    var tabEcoArterial;
    var tabAppointment;
    var defaultTab;
    
    function init(){
      $(document).ready(function () {
        //dom queries 
        createPatientForm = $("#create-patient-form");
        // editPatientBtn = $("#toggle-input");
        editPatientBtn = $("#toggle-input-patient");
        tabSinglePatient = $(".tab-single-patient");
        tabEcoVenosa = $(".tab-eco-venosa");
        tabEcoArterial = $(".tab-eco-arterial");
        tabAppointment = $(".tab-appointment");
        defaultTab = $("#defaultOpen");

          tabSinglePatient.on("click", function (e) {
            var tabName = $(this).data('id');
            openCity(e, tabName);
          })

          tabAppointment.on("click", function (e) {
            var tabName = $(this).data('id');
              openCity(e, tabName);
            })

            tabEcoVenosa.on("click", function (e) {
              var tabName = $(this).data('id');
              openCity(e, tabName);
            })

            tabEcoArterial.on("click", function (e) {
              var tabName = $(this).data('id');
              openCity(e, tabName);
            })

        // Get the element with id="defaultOpen" and click on it
        if(defaultTab.length){
          defaultTab.trigger('click');
        }
        // document.getElementById("defaultOpen").click();

        editPatientBtn.on("click", function (e) {
            // createPatientBtn.fadeOut( "slow" );
            toggleDisableInput(e);
        })

        //to toggle slide of the private-data / AGO section in appointment page
        $(".static-data-click-to-show").click(function(){
          $(".static-data-slide").slideToggle( "slow" );
      });



      }); //document ready
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


    // comentarios

    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    



  return{
    init:init
  }

  }();
  GloblasModule.init();