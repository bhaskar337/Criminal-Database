   function previewFile(){
       var preview = document.querySelector('img'); //selects the query named img
       var file    = document.querySelector('input[type=file]').files[0]; //sames as here
       var reader  = new FileReader();
       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file.type.match('image.*')) {
           reader.readAsDataURL(file); //reads the data as a URL
       } else if(!file.type.match('image.*'))
       {
       	   window.alert("Not an image file. Upload an appropriate file.");
       }else {
           preview.src = "";
       }
  }

  
