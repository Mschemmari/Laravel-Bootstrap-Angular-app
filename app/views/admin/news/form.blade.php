<form method="POST" enctype="multipart/form-data" action="{{ (empty($news->id)) ?URL::route('admin.news.create') : URL::route('admin.news.get', ['id' => $news->id]) }}">
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
        <label for="volanta">Volanta</label>
        <input id="volanta" name="volanta" type="text" class="form-control"  value="{{ (Input::old('volanta') ? Input::old('volanta') : $news->volanta ) }}">
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label for="title">T&iacute;tulo*</label>
        <input id="title" name="title" type="text" class="form-control"  value="{{ (Input::old('title') ? Input::old('title') : $news->title ) }}">
    </div>

    <!-- Textarea -->
    <div class="form-group">
        <label for="crest">Copete*</label>
        <textarea id="crest" name="crest" class="form-control" data-rich-text >{{ (Input::old('crest') ? Input::old('crest') : $news->crest ) }}</textarea>
    </div>

    <!-- Textarea -->
    <div class="form-group">
        <label for="text">Texto*</label>
        <textarea id="text" name="text" class="form-control" data-rich-text >{{ (Input::old('text') ? Input::old('text') : $news->text ) }}</textarea>
    </div>

    @for($i = 0; $i < 6; $i++)
        <div class="form-group">
            <label for="image{{$i}}">Imagen {{$i+1}}</label>
            <input type="file" name="images[{{$i}}]" id="images{{$i}}" class="form-control imageInput">
            @if (! empty($images[$i]))
                <a href="{{ url('images/upload/news/'.$images[$i]['name']) }}" target="_blank">[Preview]</a>
            @endif
            <p class="help-block">
                Las dimensiones de la imagen deben tener como mínimo 750px de ancho y 500px de alto. El peso m&aacute;ximo es de 2MB y los formatos permitidos: .jpg o .png <br>
            </p>
            <div id="finalB64Containerimage{{$i}}"></div>
            <input type="hidden" name="finalB64Inputimages{{$i}}" id="finalB64Inputimages{{$i}}">
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label for="imagestitle{{$i}}">Leyenda Foto</label>
            <input id="imagestitle{{$i}}" name="imagestitle{{$i}}" type="text" class="form-control"  value="@if (Input::old('imagestitle$i')){{Input::old('imagestitle$i')}} @else @if(isset($images[$i])){{$images[$i]['title']}} @endif @endif">
        </div>
    @endfor

    <div class="form-group">
        <label for="file">Archivo</label>
        <input type="file" name="file" id="file" class="form-control">
        @if (! empty($file))
            <a href="{{ url($file->path.$file->filename) }}" target="_blank">[Preview]</a>
        @endif
        <p class="help-block">
            El archivo puede ser .ppt, .pdf, .doc, .xls, .png o .jpg <br>
        </p>
    </div>

    <div class="form-group">
        <label for="position">Posicion*</label>
        <select id="position" name="position" class="form-control" data-select >
            <?php $position = Input::old("position") ? Input::old("position") : $news->position; ?>
            @for($i = 1; $i < $countNews + 1; $i++)
                <option <?= $i == $position ? 'selected' : ''?>>{{$i}}</option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label for="">Published</label>
        <input type="checkbox" name="active" id="active" data-switch data-size="small" data-off-color="danger" data-on-color="success" {{ $news->active == 'Y' ? 'checked' : ''}}>
    </div>

    <!-- Button (Double) -->
    <div class="form-group clearfix">
        <div class="pull-right">
            <a name="cancel" class="btn btn-danger" href="{{route('admin.news.list')}}">Cancelar</a>
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
            $(this).click(cropFileInput)
        });
    });
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