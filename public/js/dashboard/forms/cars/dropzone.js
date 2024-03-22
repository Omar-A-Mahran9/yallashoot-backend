deletedImagesNames = [];
var myDropzone = new Dropzone("#dropzone_input", {
    url: "/dashboard/dropzone/validate-image", // Set the url for your upload script location
    method: "post",
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 15,
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    dictFileTooBig: "الملف كبير جدًا ({{filesize}}ميغا بايت). الحد الأقصى لحجم الملف: {{maxFilesize}} ميغا بايت.",
    dictMaxFilesExceeded: "لا يمكنك تحميل اكثر من {{maxFiles}} من الملفات.",
    dictFallbackMessage:  "متصفحك لا يدعم تحميلات السحب والإفلات.",
    dictInvalidFileType:  "لا يمكنك تحميل ملفات من هذا النوع.",
    dictResponseError:  "استجاب الخادم برمز {{statusCode}}.",
    leaveConfirm: null, // Set to null to disable the confirmation dialog

    accept: function(file, done) {
        
         if (file.image == "wow.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    init:function() {
        // myDropzone.addFile(file);

        // Get images
        if(window.setDropzoneImages)
             setDropzoneImages(this);
         
     },
    success: function(file, response)
    {
          $("#images_input").prop("files", new FileListItems(myDropzone.files));
    },

    error: function(file, response)
    {
        if($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        file.previewElement.style.border = '1px solid #ff000059';
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    removedfile: function(file){
                console.log(myDropzone.files);
        console.log(file)
         $("#images_input").prop("files", new FileListItems(myDropzone.files));
        //  console.log('Setting files:', $("#images_input").prop("files", new FileListItems(myDropzone.files)));

        file.previewElement.remove();
        if(!(file instanceof File)){
       
            deletedImagesNames.push(file.name);
            $(`[name='deleted_images']`).val(JSON.stringify(deletedImagesNames));
        }
        
        
    },
});



// function FileListItems(files) {
//     console.log(files);
//     var fileList = new ClipboardEvent("").clipboardData || new DataTransfer();
//     for (var i = 0, len = files.length; i < len; i++) {
//         fileList.items.add(files[i]);
//     }
//     return fileList.files;
// }
 
function FileListItems(files) {
    var fileList = new ClipboardEvent("").clipboardData || new DataTransfer();
    for (var i = 0, len = files.length; i < len; i++) {
        if (files[i] instanceof File) {
            fileList.items.add(files[i]);
        } else {
            console.error('Invalid file found:', files[i]);
        }
    }
    return fileList.files;
}




