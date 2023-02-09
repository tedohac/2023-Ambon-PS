
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
                "buttons": "undo,redo,|,bold,underline,italic,|,superscript,subscript,|,ul,ol,|,outdent,indent,align,|,link,|",
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

        // on form submit
        $('button[type="submit"]').on('click',function(e)
        {
            e.preventDefault();
            var submit_value = $(this).val();
            console.log($('#formadd').serialize());
            console.log(submit_value);
            $.post
            (
                $('#formadd').attr('action'),
                $('#formadd').serialize()+ "&mode="+ submit_value,
                function(data) {
                }
            );
        });
    });