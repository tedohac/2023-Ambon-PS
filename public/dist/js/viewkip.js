
    $(document).ready(function(){
        
        // form validation
        $('#formnilai').validate({
            rules: {
                // nilai_penghematan: {
                //     required: true,
                //     number: true
                // },
                // nilai_quality: {
                //     required: true,
                //     number: true
                // },
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

        // // on form submit
        // $('button[type="submit"]').on('click',function(e)
        // {
        //     e.preventDefault();
        //     var submit_value = $(this).val();
        //     var newInput = $("<input>").attr("type", "hidden").attr("name", "mode").val(submit_value);
        //     $('#formadd').append(newInput);
        //     $('#formadd').submit();
        // });
    });