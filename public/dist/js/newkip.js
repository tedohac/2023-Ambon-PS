
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
            
            newInput = $("<input>").attr("type", "hidden").attr("name", "biayacount").val(counter);
            $('#formadd').append(newInput);

            $('#formadd').submit();
        });

        // form validation
        $('#formadd').validate({
            rules: {
                kip_judul_tema: {
                    required: true,
                },
                biaya_desc0: {
                    required: true,
                },
                biaya_harga0: {
                    required:true,
                    number: true,
                    min: 0
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
        var counter = 0;
        $("#biayaAddrow").on("click", function () {
            counter++;
            var newRow = $("<tr>");
            var cols = "";
    
            cols += '<td><div class="form-group"><input type="text" class="form-control val-biaya-desc" name="biaya_desc' + counter + '"/></div></td>';
            cols += '<td><div class="form-group"><input type="text" class="form-control val-biaya-harga" name="biaya_harga' + counter + '"/></div></td>';
    
            cols += '<td><button class="ibtnDel btn btn-md btn-danger"><i class="fa fa-fw fa-trash-alt"></i></button></td>';
            newRow.append(cols);
            $("table.order-list").append(newRow);

            $.validator.addClassRules('val-biaya-desc', {
                required: true,
            });
            
            $.validator.addClassRules('val-biaya-harga', {
                required:true,
                number: true,
                min: 0
            });
        });
    
    
    
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });
    });