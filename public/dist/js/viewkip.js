
    $(document).ready(function(){
        
        // form validation
        $('#formnilai').validate({
            rules: {
                nilai_penghematan: {
                    required: true,
                    number: true
                },
                nilai_quality: {
                    required: true,
                    number: true
                },
                nilai_safety: {
                    required: true,
                    number: true
                },
                nilai_ergonomi: {
                    required: true,
                    number: true
                },
                nilai_manfaat: {
                    required: true,
                    number: true
                },
                nilai_kepekaan: {
                    required: true,
                    number: true
                },
                nilai_keaslian: {
                    required: true,
                    number: true
                },
                nilai_usaha: {
                    required: true,
                    number: true
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

        // on form submit
        $('#checkValid').on('click',function()
        {
            console.log($('#formadd').valid());
            // if($('#formadd').valid())
            // {
            //     $('#modal-submit').modal('show');
            // }
        });
    });