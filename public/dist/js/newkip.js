
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
                var fileName = this.value,
                    idxDot = fileName.lastIndexOf(".") + 1,
                    extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            
                if (extFile!="jpg" && extFile!="jpeg" && extFile!="png")
                {
                    $("#kip_foto_sebelum").addClass("is-invalid text-danger");
                    return;
                }
                
                $('#previewpict1').attr('src', URL.createObjectURL(this.target.files[0]));
            }
        });
        
        // Image Preview 1
        $("#kip_foto_sesudah").change(function()
        {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                var fileName = this.value,
                    idxDot = fileName.lastIndexOf(".") + 1,
                    extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            
                if (extFile!="jpg" && extFile!="jpeg" && extFile!="png")
                {
                    $("#kip_foto_sesudah").addClass("is-invalid text-danger");
                    return;
                }
                
                $('#previewpict2').attr('src', URL.createObjectURL(this.target.files[0]));
            }
        });

    });