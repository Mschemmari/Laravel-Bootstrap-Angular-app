<form method="POST" enctype="multipart/form-data" action="{{ (empty($album->id)) ?URL::route('admin.albums.create') : URL::route('admin.albums.get', ['id' => $album->id]) }}">
    @if ($errors->has())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <span class="glyphicon glyphicon-info-sign"></span> {{ $error }}<br>
        @endforeach
    </div>
    @endif

    @if (Session::get('message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-info-sign"></span> {{ Session::get('message') }}
        </div>
    @endif
    <!-- Text input-->
    <div class="form-group">
        <label for="title">T&iacute;tulo*</label>
        <input id="title" name="title" type="text" class="form-control"  value="{{ (Input::old('title') ? Input::old('title') : $album->title ) }}">
    </div>
    @for($i = 0; $i < 70; $i++)
        <div class="form-group imageInputContainer" <?= ($i < 7  ||  $i < $showableInputs) ? '' : 'style="display:none"' ?> id="imageInputContainer{{$i}}" data-input="{{$i}}">
            <label for="image{{$i}}">Imagen {{$i+1}}</label>
            <input type="file" name="images[{{$i}}]" id="images{{$i}}" class="form-control imageInput">
            @if (! empty($images[$i]))
                <a href="{{ url('images/upload/albums/'.$images[$i]['name']) }}" target="_blank">[Preview]</a>
            @endif
            <p class="help-block">
                Las dimensiones de la imagen deben tener como mínimo 750px de ancho y 500px de alto. El peso m&aacute;ximo es de 2MB y los formatos permitidos: .jpg o .png <br>
            </p>
            <div id="finalB64Containerimage{{$i}}"></div>
            <input type="hidden" name="finalB64Inputimages{{$i}}" id="finalB64Inputimages{{$i}}">
        </div>
    @endfor
    
    <div class="form-group clearfix">
        <button class="btn btn-success" id="addInputs">Subir m&aacute;s im&aacute;genes</button>
    </div>

    <div class="form-group">
        <label for="">Publicado</label>
        <input type="checkbox" name="active" id="active" data-switch data-size="small" data-off-color="danger" data-on-color="success" {{ $album->active == 'Y' ? 'checked' : ''}}>
    </div>

    <!-- Button (Double) -->
    <div class="form-group clearfix">
        <div class="pull-right">
            <a name="cancel" class="btn btn-danger" href="{{route('admin.albums.list')}}">Cancelar</a>
            <button id="save" name="save" class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </div>
</form>

<div id="modal" style="display:none; width:70%; max-height:100%; overflow:scroll">
    <div id="canvasContainer" style="margin:auto"></div>
    <button id="button-getData" class="btn btn-primary pull-right">Guardar</button><a class="btn btn-default pull-right" href="#close" rel="modal:close">Cancelar</a>
  </div>
<script type="text/javascript">
    $(function(){
        $(".imageInput").each(function(){
            $(this).click(cropFileInput);
        });
        $("#addInputs").click(function(event){
            event.preventDefault();
            console.log("Hey");
            if(showableInputs < maxInputsQuantity){
                var newShowableInputs = showableInputs + 7;
                $(".imageInputContainer").each(function(){
                    var num = $(this).data('input');
                    if(num >= showableInputs && num < newShowableInputs){
                        $(this).slideDown();
                    }
                });
                showableInputs = newShowableInputs;
            }
        });
    });
    var showableInputs = <?php echo $showableInputs; ?>;
    var maxInputsQuantity = 70;

    var cropFileInput = function(e){
            e.stopPropagation();
            var fileInput = this;
            var id = fileInput.id;
           
            var canvasContainer = $("#canvasContainer");
            var canvasContainerCanvas = $("#canvasContainer canvas");
            var finalImageContainerid = "#finalB64Container"+id;
            var finalImageContainer = $(finalImageContainerid);
            var finalImageInputid = "#finalB64Input"+id;
            var finalImageInput = $(finalImageInputid);
            

            var imageType = /image.*/;
            var imageWidth = 750;
            var imageHeight = 500;
            var imageMaxSize = 2097152;

            $(fileInput).unbind();
            $(fileInput).change(function(e) {
                e.stopPropagation();
                finalImageContainer.empty();
                canvasContainer.empty();
                var file = fileInput.files[0];

                if(file.size < imageMaxSize){

                    if (file.type.match(imageType)) {

                        var reader = new FileReader();

                        reader.onload = function() {
                            var img = new Image();
                            img.src = reader.result;
                            img.onload = function(){
                                if(img.width >= imageWidth && img.height >= imageHeight){
                                    var x = (imageWidth * 100) / img.width;
                                    var h = (img.height / 100) * x;
                                    if(h >= imageHeight){
                                        img.width = imageWidth;
                                        img.height = h;
                                    }else{
                                        x = (imageHeight * 100) / img.height;
                                        img.height = imageHeight;
                                        img.width = (img.width / 100) * x;
                                    }
                                    var c = document.createElement("canvas");
                                    c.width = img.width;
                                    c.height = img.height;
                                    c.id = 'canvas';
                                    canvasContainer.css({'width':c.width+'px', 'height':c.height});
                                    canvasContainer.html(c);
                                    var ctx = c.getContext("2d");
                                    ctx.clearRect(0, 0, img.width, img.height);
                                    ctx.drawImage(img, 0, 0, img.width, img.height);
                                    
                                    $('#modal').modal();
                                    $('#canvas').cropper({
                                      aspectRatio: 3 / 2,
                                      autoCropArea : 1,
                                      guides: false,
                                      highlight: false,
                                      dragCrop: false,
                                      resizable: false,
                                      zoomable: false
                                    });
                                    
                                    $("#button-getData").unbind();
                                    $("#button-getData").click(function(){
                                        var croppedCanvas = $('#canvas').cropper('getCroppedCanvas');
                                        finalImageInput.val(croppedCanvas.toDataURL(file.type));
                                        finalImageContainer.html(croppedCanvas);
                                        $.modal.close();
                                        console.log(finalImageInput.val());
                                    });

                                }else{
                                    alert("La imagen debe tener como mínimo "+imageWidth+" px de ancho y "+imageHeight+"px de alto");
                                }
                            }
                        }

                        reader.readAsDataURL(file); 
                    } else {
                        alert("Formato no soportado!");
                    }
                }else{
                        alert("Archivo demasiado pesado!");
                }
            });
        } 
</script>