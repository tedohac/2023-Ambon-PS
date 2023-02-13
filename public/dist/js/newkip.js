
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

        // on button send click
        $('#checkValid').on('click',function()
        {
            if($('#formadd').valid())
            {
                $('#modal-submit').modal('show');
            }
            else $('#formadd').submit();
        });
        
        // on form submit
        $('button[type="submit"]').on('click',function(e)
        {
            e.preventDefault();
            var submit_value = $(this).val();
            var newInput = $("<input>").attr("type", "hidden").attr("name", "mode").val(submit_value);
            $('#formadd').append(newInput);
            $('#formadd').submit();
        });

        // form validation
        $('#formadd').validate({
            rules: {
                kip_judul_tema: {
                    required: true,
                },
            },
            messages: {
                kip_judul_tema: {
                    required: "Please enter Judul Tema",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // add row biaya
        var counter = 1;
        $("#biayaAddrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
    
            cols += '<td><input type="text" class="form-control" name="biaya_desc' + counter + '"/></td>';
            cols += '<td><input type="text" class="form-control" name="biaya_harga' + counter + '"/></td>';
    
            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
            newRow.append(cols);
            $("table.order-list").append(newRow);
            counter++;
        });
    
    
    
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });
    });