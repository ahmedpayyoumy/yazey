
var UploadFile = function () {
    var demo1 = function demo1() {

    var token = $('input[name=_token]').val();

    var myDropzone4 = new Dropzone('#kt_dropzone_1', { // Make the whole body a dropzone
        url: config.routes.upload,
        // Set the url for your upload script location
        paramName: "file",
        // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 80,
        // MB
        addRemoveLinks: false,
        chunking: true,
        chunkSize: 1000000,
        sending: function(file, xhr, formData){
            formData.append("_token", token);

            // This will track all request so we can get the correct request that returns final response:
            // We will change the load callback but we need to ensure that we will call original
            // load callback from dropzone
            var dropzoneOnLoad = xhr.onload;
            xhr.onload = function (e) {
                dropzoneOnLoad(e)
    
                // Check for final chunk and get the response
                var uploadResponse = JSON.parse(xhr.responseText)
                console.log(uploadResponse);
                if(typeof uploadResponse.done === 'number'){
                    $("#kt_dropzone_1 .dz-upload").css('width', uploadResponse.done + "%");
                }
                if (typeof uploadResponse.name === 'string') {
                    $("#kt_dropzone_1 #name").val(uploadResponse.name);
                    $("#kt_dropzone_1 #file-url").val(uploadResponse.path + uploadResponse.name);
                    alert("Uploaded");
                }
            }
        },
        accept: function accept(file, done) {
            done()
        }
    });

    };
  
    return {
      //main function to initiate the module
      init: function init() {
        demo1();
      }
    };
  }();
  
  jQuery(document).ready(function () {
    UploadFile.init();
  });
  