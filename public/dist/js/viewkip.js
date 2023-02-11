
    $(document).ready(function(){
        
        // form validation
        $('#formnilai').validate({
            rules: {
                nilai_penghematan: {
                    required: true,
                    number: true,
                    max: 100
                },
                nilai_quality: {
                    required: true,
                    number: true,
                    max: 100
                },
                nilai_safety: {
                    required: true,
                    number: true,
                    max: 100
                },
                nilai_ergonomi: {
                    required: true,
                    number: true,
                    max: 100
                },
                nilai_manfaat: {
                    required: true,
                    number: true,
                    max: 100
                },
                nilai_kepekaan: {
                    required: true,
                    number: true,
                    max: 100
                },
                nilai_keaslian: {
                    required: true,
                    number: true,
                    max: 100
                },
                nilai_usaha: {
                    required: true,
                    number: true,
                    max: 100
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
                    sum += parseFloat($(this).text());
                });
                $(this).text() = sum;
            }
            else {
                $(this).text() = "0";
            }
        });

        // on button send click
        $('#checkValid').on('click',function()
        {
            if($('#formnilai').valid())
            {
                $('#modal-submit').modal('show');
            }
        });
    });