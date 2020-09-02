var CreateEcoVenosaModule = function(){

    //global vars
    var $ = jQuery;
    
    var createEcoVenosaBtn;
    var createEcoVenosaForm;
    var loadImagesEco;
    var loadImagesEco_der;
    
    //added 
    // var myInputFile;
    // var myFile;

    function init(){
      $(document).ready(function () {

        createEcoVenosaBtn = $("#create-eco-venosa");
        createEcoVenosaForm = $("#create-eco-venosa-form");
        loadImagesEco = $("#imagen_eco_venosa");
        loadImagesEco_der = $("#imagen_eco_venosa_der");


        var fileInput = document.querySelector('input[type="file"]');
        // var preview = document.querySelector('.preview');
        
        // if (fileInput != null) {
        //   fileInput.style.opacity = 0;
        //   //fileInput.addEventListener('change', updateImageDisplay(preview, fileInput));
        //   fileInput.addEventListener('change', updateImageDisplay);
        // }

        if (fileInput != null) {
          fileInput.style.opacity = 0;
        }

        loadImagesEco.on("click", function (e) {
          alert("IZQUIERDO");
          // fileInput.style.opacity = 0;
          fileInput.addEventListener('change', updateImageDisplay);
        })


        loadImagesEco_der.on("click", function (e) {
          alert("DERECHOOOOO");
          // fileInput.style.opacity = 0;
          fileInput.addEventListener('change', updateImageDisplayDer);
        })

        createEcoVenosaBtn.on("click", function (e) {
          //get_checkbox_values();
        //   alert("eco venosssa hmmmm ");
          createEcoVenosaBtn.fadeOut( "slow" );
            // metemos el div con el spinner hasta que se retonrne del ajaz request
          $("#overlay").fadeIn(300);
          saveProfileData(e);
        })


      });
    }//function init


  // POR QUE USO populateFormData() Y FORMDATA:
  // lo ideal y mas sencillo seria tomar los datos del formulario simplemente con serialize(); y no usar populateFormData
  // como lo hacemos en create-patient-js.
  // El PROBLEMA es que de esa forma no se pueden enviar inputs del tipo FILE, los cuales necesitamos para poder agregar imagenes a las colposcopias, por eso nos vemos obligados a usar formData y añadir los demas inputs con el metodo populateFormData()   
  function populateFormData() {
    //var inputs = createAppointmentForm.serializeArray();
    var inputs = createEcoVenosaForm.find("input, select, textarea");
    var serializedInputs = createEcoVenosaForm.serializeArray();
    //no recuerdo por que no logre hacer funcionar con serialize(); por eso uso serializeArray(); 
    //var serializedInputs = createAppointmentForm.serialize();
    var formData = new FormData();


    //console.log("serializedInputs", serializedInputs);

    
    //Procedimiento para agregar los archivos de imagenes de las colposcopias al formdata
    $.each(inputs.filter('[type="file"]'), function (i, element) {
      var input = $(element)[0].files;
      $.each(input, function (j, file) {
        // console.log("file", file);
        formData.append(file.name, file);
      });
    });
    
    
    $.each(serializedInputs, function (i, element) {
      formData.append(element.name, element.value);
    });


    // EL PROBLEMA: 
    // searializArray() funciona correctamente cuando algun valor de los campos del checkbox es seleccionado i.e: al seleccionar el field "inyectable" del checkbox metodoanticopnceptivo genera el array "metodo_anticonceptivo":["preservativos",""] con lo cual se puede guardar los cambios con acf.
    // PERO cuando se desmarca todos los checkboxes fields, serializeArray() simplemente omite enviar ese campo, en vez de generar un array con el nombre de ese campo y valores vacios, es decir, algo asi: "metodo_anticonceptivo":["",""]
    // que es lo que se necesita para que acf pueda guardar los cambios.
    // Solucion: 
    // Este procedimiento se encarga de generar dicho array por cada input del tipo checkbox y lo agrega al formData
    $('#create-eco-venosa-form input[type="checkbox"]:not(:checked)').each(function(i, e) {
        formData.append(e.name, "");
    });

    // formData.append("app_id", "<?php echo $appointment_id ?>");
    // formData.append("patient_id", "<?php echo $patient_id ?>");
    // formData.append("static_data_post_id", "<?php echo $static_data_post_id ?>");
    // formData.append("colpo_post_id", "<?php echo $colpo_post_id ?>");
    // formData.append("action", "sw_create_appointment_ajax");

    return formData;
  }

  function saveProfileData(e) {
    e.preventDefault();

    //alert("Se guardaran los datos");
    var $ = jQuery;
    var formData = populateFormData();

    //console.log("formData = ", formData);
    //Display the key/value pairs
    // for (var pair of formData.entries())
    // {
    //    console.log(pair[0]+ ', '+ pair[1]); 
    // }

    // SI USABAMODS serialize() en vez de serializeArray(), de esta forma debiamos apendar los campos extras
    //var myData = createAppointmentForm.serialize();
    // var myData = createAppointmentForm.serialize() + 
    // '&patient_id=' + '<?php //echo $patient_id?>' + 
    // '&app_id=' + '<?php //echo $appointment_id ?>' + 
    // '&static_data_post_id=' + '<?php //echo $static_data_post_id ?>' + 
    // '&colpo_post_id=' + '<?php //echo $colpo_post_id ?>' + 
    // '&action=' + 'sw_create_appointment_ajax';

    $.ajax({

      type: "POST",
      enctype: 'multipart/form-data',
      url: window.homeUrl + "/wp-admin/admin-ajax.php",
      data: formData,
      //dataType: "json",
      processData: false,
      contentType: false,
      success: function(data){
        var result = JSON.parse(data);
        //console.log("result", result);
        //handle error
        if(result.error.length >0){
        //if(result.error){
          //alert(result.error.msg);
          alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_appointment_ajax ');
          //let errorMsg = result.error.msg;
          //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
        }
        if(result.success){
          //  alert(result['msg']);
          
        //   var oldUrl = window.location.href; 
        //   var replaceId = "app_id="+result['app_id'];
        //   var newUrl = oldUrl.replace("app_id=new", replaceId);
        //   window.location.replace(newUrl);
          
          // window.location.reload();
          setTimeout(function(){
            $("#overlay").fadeOut(300);
          },500);
          window.history.back();

        }
      }
    });
  }

  /*--------------------------------------*/
  function updateImageDisplay(preview, fileInput) {
    alert("eco venosa IZQUIERDO  ");
    fileInput = document.querySelector('input[type="file"]');
    preview = document.querySelector('.preview');
    //cuando hay un cambio en input, remover todos los childs de preview
    while(preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    // console.log("fileInput", fileInput.files);
    var curFiles = fileInput.files;
    //si no se agregan o no hay ningun file, apendar a preview un parrafo con texto
    if(curFiles.length === 0) {
      var para = document.createElement('p');
      para.textContent = 'No hay archivos seleccionados';
      preview.appendChild(para);
    } else {
      var list = document.createElement('ol');
      preview.appendChild(list);
      for(var i = 0; i < curFiles.length; i++) {
        //var liContainer = document.createElement('div');
        //liContainer.classList.add("row");
        var listItem = document.createElement('li');
        //liContainer.appendChild(listItem);
        
        //$( listItem ).wrap( "<div class='row'></div>" );
        
        para = document.createElement('p');
        //para.classList.add("small-12");
        //si el tipo es validoy el tamnho no exede los 6MB
        if(validFileType(curFiles[i]) && curFiles[i].size < 6291456) {
          //add a class to change to succes/valid color
          //$(listItem).css('background', '#2c3840');
          
           para.textContent = 'Nombre del archivo:  ' + curFiles[i].name;
          //var paraText = 'Archivo:  ' + curFiles[i].name + '<br> Tamaño: ' + returnFileSize(curFiles[i].size) + '.';
          //$(para ).html(paraText);

          var image = document.createElement('img');
          
          image.src = window.URL.createObjectURL(curFiles[i]);

          var liContainer = document.createElement('div');
          liContainer.classList.add("row");
          //var listItem = document.createElement('li');
          listItem.appendChild(liContainer);

          liContainer.appendChild(image);
          $( image ).wrap( "<div class='small-12 small-centered medium-6 large-6 columns colpo-files-list'></div>" );
          liContainer.appendChild(para);
          $( para ).wrap( "<div class='small-12 small-centered medium-6 large-6 colpo-files-list'></div>" );

        } else {
          //agregar estilo para hacerlo de color rojo
          //$( listItem ).addClass( "listItem-error-color" );
          $(listItem).css('background', '#fc1303');
          para.textContent = 'Nombre del archivo: ' + curFiles[i].name + '  -   Tipo de archivo incorrecto. Actualice las seleccion.';
          listItem.appendChild(para);
        }

        list.appendChild(listItem);
      }
    }
  }


  function updateImageDisplayDer(preview, fileInput) {
    alert("eco venosa DERECHO ");
    fileInput = document.querySelector('input[type="file"]');
    preview = document.querySelector('.preview-der');
    //cuando hay un cambio en input, remover todos los childs de preview
    while(preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    // console.log("fileInput", fileInput.files);
    var curFiles = fileInput.files;
    //si no se agregan o no hay ningun file, apendar a preview un parrafo con texto
    if(curFiles.length === 0) {
      var para = document.createElement('p');
      para.textContent = 'No hay archivos seleccionados';
      preview.appendChild(para);
    } else {
      var list = document.createElement('ol');
      preview.appendChild(list);
      for(var i = 0; i < curFiles.length; i++) {
        //var liContainer = document.createElement('div');
        //liContainer.classList.add("row");
        var listItem = document.createElement('li');
        //liContainer.appendChild(listItem);
        
        //$( listItem ).wrap( "<div class='row'></div>" );
        
        para = document.createElement('p');
        //para.classList.add("small-12");
        //si el tipo es validoy el tamnho no exede los 6MB
        if(validFileType(curFiles[i]) && curFiles[i].size < 6291456) {
          //add a class to change to succes/valid color
          //$(listItem).css('background', '#2c3840');
          
           para.textContent = 'Nombre del archivo:  ' + curFiles[i].name;
          //var paraText = 'Archivo:  ' + curFiles[i].name + '<br> Tamaño: ' + returnFileSize(curFiles[i].size) + '.';
          //$(para ).html(paraText);

          var image = document.createElement('img');
          
          image.src = window.URL.createObjectURL(curFiles[i]);

          var liContainer = document.createElement('div');
          liContainer.classList.add("row");
          //var listItem = document.createElement('li');
          listItem.appendChild(liContainer);

          liContainer.appendChild(image);
          $( image ).wrap( "<div class='small-12 small-centered medium-6 large-6 columns colpo-files-list'></div>" );
          liContainer.appendChild(para);
          $( para ).wrap( "<div class='small-12 small-centered medium-6 large-6 colpo-files-list'></div>" );

        } else {
          //agregar estilo para hacerlo de color rojo
          //$( listItem ).addClass( "listItem-error-color" );
          $(listItem).css('background', '#fc1303');
          para.textContent = 'Nombre del archivo: ' + curFiles[i].name + '  -   Tipo de archivo incorrecto. Actualice las seleccion.';
          listItem.appendChild(para);
        }

        list.appendChild(listItem);
      }
    }
  }


  var fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
  ]

  function validFileType(file) {
    for(var i = 0; i < fileTypes.length; i++) {
      if(file.type === fileTypes[i]) {
        return true;
      }
    }

    return false;
  }


  function returnFileSize(number) {
    if(number < 1024) {
      return number + 'bytes';
    } else if(number >= 1024 && number < 1048576) {
      return (number/1024).toFixed(1) + 'KB';
    } else if(number >= 1048576) {
      return (number/1048576).toFixed(1) + 'MB';
    }
  }
/*--------------------------------------*/

  return{
    init:init
  }

  }();

  CreateEcoVenosaModule.init();