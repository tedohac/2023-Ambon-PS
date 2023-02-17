
    $(document).ready(function(){
        
        // form validation
        $('#formadd').validate({
            rules: {
                user_npk: {
                    required: true,
                    number: true,
                },
                user_name: {
                    required: true,
                },
                user_dept: {
                    required: true,
                },
                user_line: {
                    required: true,
                },
                user_password: {
                    required: true,
                },
                user_passwordre: {
                    required: true,
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
        

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox();
    });