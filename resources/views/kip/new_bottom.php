
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      placeholder: "Select",
      id: '-1', // the value of the option
      theme: 'bootstrap4'
    })
  });
</script>

<!-- Jodit-->
<script src="{{ asset('plugins/jodit/jodit.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.jodit').each(function () {
            var editor = new Jodit(this, {
            "spellcheck": false,
            "buttons": "undo,redo,|,bold,underline,italic,|,superscript,subscript,|,ul,ol,|,outdent,indent,align,fontsize,|,image,link,|",
        });
    });

    });
</script>


<!-- Preview Profile Pict -->
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
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
            
            $("#profilethumb1").empty();
            reader.onload = function(e) {
                $("#profilethumb1").append('<img id="previewpict1" style="max-width: 200px;" class="bg-white border p-1"');
                $('#previewpict1').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });
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
            
            $("#profilethumb2").empty();
            reader.onload = function(e) {
                $("#profilethumb2").append('<img id="previewpict2" style="max-width: 200px;" class="bg-white border p-1"');
                $('#previewpict2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });
</script>