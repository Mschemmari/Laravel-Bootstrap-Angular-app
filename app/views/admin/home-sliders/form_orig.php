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
        <input type="file" name="image" id="image" class="form-control">
        @if (! empty($image))
            <a href="{{ url('images/upload/home-sliders/'.$image['name']) }}" target="_blank">[Preview]</a>
        @endif
        <p class="help-block">
            Las dimensiones de la imagen deben tener como mínimo 750px de ancho y 500px de alto. El peso m&aacute;ximo es de 2MB y los formatos permitidos: .jpg o .png <br>
        </p>
        <div class="finalImage"></div>
        <input type="hidden" name="imageb64" id="imageb64">
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
<div id="modal" style="margin:auto;display:none;width:70%; height:80%; top:40%!important">
    <strong style="float:right"><a href="#" rel="modal:close">X</a></strong><div style="clear:both"></div>
    <div class="canvasContainer" style="margin:auto"></div>
    <button id="button-getData" class="btn btn-primary pull-right">Guardar</button><div style="clear:both"></div>
  </div>
<script type="text/javascript">
    $(function(){
        var fileInput = document.getElementById('image');
        var canvasContainer = $(".canvasContainer");

        fileInput.addEventListener('change', function(e) {

            $(".finalImage").empty();
            canvasContainer.empty();
            var file = fileInput.files[0];
            var imageType = /image.*/;
            var imageWidth = 750;
            //var imageHeight = 500;
            var imageHeight = 334;
            var imageMaxSize = 2097152;

            if(file.size < imageMaxSize){

                if (file.type.match(imageType)) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = new Image();
                        img.src = reader.result;

                        if(img.width >= imageWidth && img.height >= imageHeight){
                            if(img.width  > img.height ){
                                var x = (imageWidth * 100) / img.width;
                                img.width = imageWidth;
                                img.height = (img.height / 100) * x;
                            }else{
                                var x = (imageHeight * 100) / img.height;
                                img.height = imageHeight;
                                img.width = (img.width / 100) * x;
                            }
                            var c = document.createElement("canvas");
                            c.width = img.width;
                            c.height = img.height;
                            canvasContainer.css({'width':c.width+'px', 'height':c.height});
                            canvasContainer.html(c);
                            var ctx = c.getContext("2d");
                            ctx.clearRect(0, 0, img.width, img.height);
                            ctx.drawImage(img, 0, 0, img.width, img.height);
                            
                            $('#modal').modal();
                            $('canvas').cropper({
                              /*aspectRatio: 3 / 2,*/
                              aspectRatio: 375 / 167,
                              autoCropArea : 1,
                              guides: false,
                              highlight: false,
                              dragCrop: false,
                              resizable: false
                            });
                            $("#button-getData").click(function(){
                                var croppedCanvas = $('canvas').cropper('getCroppedCanvas');
                                $("#imageb64").val(croppedCanvas.toDataURL(file.type));
                                $(".finalImage").html(croppedCanvas);
                                $.modal.close();
                            });

                        }else{
                            alert("La imagen debe tener como mínimo "+imageWidth+" px de ancho y "+imageHeight+"px de alto");
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
    });   
</script>