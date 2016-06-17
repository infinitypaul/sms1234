<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<h3 class="danger"></h3>
<h3 class="lead">You have {{ $data }} Records in Your DB</h3>
<form action="{{ url('upload')}}" id="my-dropzone" class="dropzone" id="my-awesome-dropzone">
    {{--<div id="img-thumb-preview">--}}
    {{--<img id="img-thumb" class="user size-lg img-thumbnail" src="">--}}
    {{--</div>--}}
    {{--<button id="upload-submit" class="btn btn-default margin-t-5"><i class="fa fa-upload"></i> Upload Picture</button>--}}

</form>
<?php
//
echo public_path().' hi';
?>
<script>

    $(document).ready(function() {

        //Dropzone.js Options - Upload an image via AJAX.
        Dropzone.options.myDropzone = {
            uploadMultiple: false,
            // previewTemplate: '',
            addRemoveLinks: false,
            // maxFiles: 1,
            dictDefaultMessage: 'Please Upload an Excel File ',
            init: function() {
                this.on("addedfile", function(file) {
                    // console.log('addedfile...');
                });
                this.on("thumbnail", function(file, dataUrl) {
                    // console.log('thumbnail...');
                    $('.dz-image-preview').hide();
                    $('.dz-file-preview').hide();
                });
                this.on("success", function(file, res) {
                    console.log('upload success...');
                    $(".danger").fadeIn();
                    $(".danger").html("<b><font color='green'> Upload Successfull</font></b>!");
                    $(".danger").fadeOut(3000);
                    $('#img-thumb').attr('src', res.path);
                    $('input[name="pic_url"]').val(res.path);
                });
            }
        };
        var myDropzone = new Dropzone("#my-dropzone");

        $('#upload-submit').on('click', function(e) {
            e.preventDefault();
            //trigger file upload select
            $("#my-dropzone").trigger('click');
        });

    });

    //we want to manually init the dropzone.
    Dropzone.autoDiscover = false;
</script>
<Style>
    .single-dropzone {
    .dz-image-preview, .dz-file-preview {
        display: none;
    }
    }

</Style>
