
    $(document).ready(function(){
  
        
        // Select2
        $('.select2bs4').select2({
            placeholder: "Select",
            id: '-1', // the value of the option
            theme: 'bootstrap4'
        });
        
        // Jodit
        $('.jodit').each(function () {
            var editor = new Jodit(this, {
                "spellcheck": false,
                "buttons": "undo,redo,|,bold,underline,italic,|,superscript,subscript,|,ul,ol,|,outdent,indent,align,fontsize,|,image,link,|",
            });
        });

        // Class Image Uploader
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        // Image Preview 1
        $("#kip_foto_sebelum").change(function()
        {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function() {
                    $('#previewpict1').attr('src', reader.result);
                    console.log('asd'+reader.result);
                }
                
                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });
        
        // Image Preview 1
        $("#kip_foto_sesudah").change(function()
        {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function() {
                    $('#previewpict2').attr('src', reader.result);
                }
                
                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });

    });