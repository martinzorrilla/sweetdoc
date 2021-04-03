var MyRadioButtons = function(){

    //global vars
    var $ = jQuery;    
    // var createAppBtn;


    function init(){
      $(document).ready(function () {
        //dom queries 

        // este codigo permite deseleccionar una opcion ya chequeada en un radio button. pero tambien aplica a todos los labels x lo cual tengo que solucionar
        $("label").click(function(e){
          $check = $(this).prev();
          if ($check.is(':radio') ||  $check.is(':checkbox') ) {  
              e.preventDefault();
              if($check.prop('checked'))
              $check.prop( "checked", false );
              else 
              $check.prop( "checked", true );            
            }
        });

      });
    }//function init


  return{
    init:init
  }

  }();

MyRadioButtons.init();