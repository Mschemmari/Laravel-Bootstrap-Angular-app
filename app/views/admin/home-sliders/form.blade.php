<form method="POST" enctype="multipart/form-data" action="{{ (empty($slider->id)) ?URL::route('admin.home-sliders.create') : URL::route('admin.home-sliders.get', ['id' => $slider->id]) }}">
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
        <input id="title" name="title" type="text" class="form-control"  value="{{ (Input::old('title') ? Input::old('title') : $slider->title ) }}">
    </div>

    <!-- Textarea -->
    <div class="form-group">
        <label for="text">Texto*</label>
        <textarea id="text" name="text" class="form-control" data-rich-text >{{ (Input::old('text') ? Input::old('text') : $slider->text ) }}</textarea>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label for="link">Link*</label>
        <input id="link" name="link" type="text" class="form-control"  value="{{ (Input::old('link') ? Input::old('link') : $slider->link ) }}">
    </div>

    <div class="form-group">
        <label for="image0">Imagen*</label>
        <input type="file" name="image" id="image" class="form-control imageInput">
        @if (! empty($image))
            <a href="{{ url('images/upload/home-sliders/'.$image['name']) }}" target="_blank">[Preview]</a>
        @endif
        <p class="help-block">
            Las dimensiones de la imagen deben tener como mínimo 750px de ancho y 334px de alto. El peso m&aacute;ximo es de 2MB y los formatos permitidos: .jpg o .png <br>
        </p>
        <div id="finalB64Containerimage"></div>
        <input type="hidden" name="finalB64Inputimage" id="finalB64Inputimage">
    </div>

    <div class="form-group">
        <label for="position">Posicion*</label>
        <select id="position" name="position" class="form-control" data-select >
            <?php $position = Input::old("position") ? Input::old("position") : $slider->position; ?>
            @for($i = 1; $i < 7; $i++)
                <option <?= $i == $position ? 'selected' : ''?>>{{$i}}</option>
            @endfor
        </select>
        <p class="help-block">
            De existir otro slider en la posici&oacute;n seleccionada, este se correr&aacute; a la primera posici&oacute;n posterior disponible. <br>
        </p>
    </div>

    <div class="form-group">
        <label for="">Publicado</label>
        <input type="checkbox" name="active" id="active" data-switch data-size="small" data-off-color="danger" data-on-color="success" {{ $slider->active == 'Y' ? 'checked' : ''}}>
    </div>

    <!-- Button (Double) -->
    <div class="form-group clearfix">
        <div class="pull-right">
            <a name="cancel" class="btn btn-danger" href="{{route('admin.home-sliders.list')}}">Cancelar</a>
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
        $(".imageInput").click(cropFileInput);
    });
    var cropFileInput = function(){
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
            //var imageHeight = 500;
            var imageHeight = 334;
            var imageMaxSize = 2097152;

            fileInput.addEventListener('change', function(e) {
                finalImageContainer.empty();
                canvasContainer.empty();
                var file = fileInput.files[0];

                if(file.size < imageMaxSize){

                    if (file.type.match(imageType)) {

                        var reader = new FileReader();

                        reader.onload = function(e) {
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
                                      /*aspectRatio: 3 / 2,*/
                                      aspectRatio: 375 / 167,
                                      autoCropArea : 1,
                                      guides: false,
                                      highlight: false,
                                      dragCrop: false,
                                      resizable: false,
                                      zoomable: false
                                    });
                                    $("#button-getData").click(function(){
                                        var croppedCanvas = $('#canvas').cropper('getCroppedCanvas');
                                        finalImageInput.val(croppedCanvas.toDataURL(file.type));
                                        //finalImageContainer.html(croppedCanvas);
                                        $.modal.close();
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