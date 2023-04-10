
    $(document).ready(function(){
        
        // form validation
        $('#formnilai').validate({
            rules: {
                nilai_penghematan: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
                },
                nilai_quality: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
                },
                nilai_safety: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
                },
                nilai_ergonomi: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
                },
                nilai_manfaat: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
                },
                nilai_kepekaan: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
                },
                nilai_keaslian: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
                },
                nilai_usaha: {
                    required: true,
                    number: true,
                    max: 10,
                    min: 0
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

        // calculate Total
        $(".nilai-input").focusout(function() {
            if($('#formnilai').valid())
            {
                var sum = 0;
                $('.nilai-input').each(function(){
                    sum += parseFloat(this.value);
                });
                $('#disabled_total').val(sum);
            }
            else {
                $('#disabled_total').val('0');
            }
        });

        // on button beri penilaian click
        $('#checkValid').on('click',function()
        {
            if($('#formnilai').valid())
            {
                $('#modal-submit').modal('show');
            }
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
    });