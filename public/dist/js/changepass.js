
    $(document).ready(function(){
        
        // form validation
        $('#formadd').validate({
            rules: {
                current_password: {
                    required: true,
                },
                user_password: {
                    required: true,
                },
                user_passwordre: {
                    equalTo: "#user_password"
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

        // on button send click
        $('#checkValid').on('click',function()
        {
            if($('#formadd').valid())
            {
                $('#modal-submit').modal('show');
            }
        });

    });