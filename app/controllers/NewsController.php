<?php

class NewsController extends \BaseController {

    /**
     * Display a listing of the news
     *
     */
    public function get()
    {
        $this->resetPositions();

        $news = Content::orderBy('position', 'asc')->get();

        return \View::make('admin.news.list', [
            'title' => 'Novedades',
            'news' => $news,
            'countNews' => count($news)
        ]);
    }


    /**
     * Create a News
     *
     */
    public function postCreate()
    {
        $input = Input::all();
        $file = Input::file();
     
        if(!Input::hasFile('images')|| !Input::has('finalB64Inputimages0'))
            return Redirect::route('admin.news.create')->with('message', "Debes cargar por lo menos 1 imagen")->withInput();
        
        $input['category'] = 'news';
        
        $news = new Content();
        $news = $news->fill($input);
        $news->active = Input::get('active') == 'on' ? 'Y' : 'N';

        /*$newsWithSamePosition = Content::where("position", "=", $news->position)->first();
        $aux_pos = $this->getFirstAvailablePosition();*/

        if ($news->isValid() && $news->save()) {
            /*if(count($newsWithSamePosition)){
                $newsWithSamePosition->position = $aux_pos;
                $newsWithSamePosition->update();
            }*/
            $this->reorder($news->position, $news->id);
            $imgMax = 6;
            for($i = 0; $i < $imgMax; $i++){
                if(isset($file['images'][$i])){
                    $image = new Image();
                    $uploading = $image->uploadFromBase64('images', 'news', $i);
                    if(!$uploading['success'])
                        return Redirect::route('admin.news.get', [ 'id' => $news->id ])->withErrors($uploading['msg'])->withInput();
                    $image->fill(array('parent_id' => $news->id, 'name' => $uploading['msg'], 'category' => 'News', 'position' => $i, 'active' => 'Y'));
                    $image->title = Input::get('imagestitle'.$i);
                    if(!($image->isValid() && $image->save()))
                        return Redirect::route('admin.news.get',[ 'id' => $news->id ])->withErrors($image->getErrors())->withInput();
                }
            }
            if(Input::hasFile('file')){
                $file = Input::file('file');
                $filename = uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/files/',$filename);
            
                $fileObj = new Archive();
                $fileObj->fill(array('news_id' => $news->id, 'type' => $file->getClientOriginalExtension(), 'path' =>'files/', 'filename' => $filename, 'active' => 'Y'));
                if(!($fileObj->isValid() && $fileObj->save()))
                    return Redirect::route('admin.news.get', [ 'id' => $news->id ])->withErrors($fileObj->getErrors())->withInput();
            }
            return Redirect::route('admin.news.get', [ 'id' => $news->id ])->with('message', "La novedad <strong>{$news->title}</strong> se cre&oacute; con &eacute;xito");
        }
        return Redirect::route('admin.news.create')->withErrors($news->getErrors())->withInput();
    }

    /**
     * Get a News
     *
     */
    public function getUpdate($id)
    {
        $news = Content::find($id);
        if (empty($news->id)) 
            return Redirect::route('admin.news.list');

        if(count($news->archive))
            $file = $news->archive;
        else
            $file = null;

        $images = Image::where('parent_id', '=', $news->id)->where('category', '=', 'News')->orderBy('position')->get();
        
        $allNews = Content::all();

        return \View::make('admin.news.edit', [
            'title' => $news->title,
            'news' => $news,
            'images' => $images,
            'file' => $file,
            'countNews' => count($allNews)
        ]);
    }

    /**
     * Update a News
     *
     */
    public function postUpdate($id)
    {
        $news = Content::find($id);
        if (empty($news->id)) 
            return Redirect::route('admin.news.list');

        $input = Input::all();
        $file = Input::file();

        //$orig_pos = $news->position;
        $news = $news->fill($input);
        $news->active = Input::get('active') == 'on' ? 'Y' : 'N';
        $imgMax = 6;
        for($i = 0; $i < $imgMax; $i++){
            if(isset($file['images'][$i])){
                $oldImage = Image::where('parent_id', '=', $news->id)->where('category', '=', 'News')->where('position', '=', $i)->first();
                if(count($oldImage))
                    $oldImage->delete();
                $image = new Image();
                $uploading = $image->uploadFromBase64('images', 'news', $i);
                if(!$uploading['success'])
                    return Redirect::route('admin.news.get', [ 'id' => $news->id ])->withErrors($uploading['msg'])->withInput();
                $image->fill(array('parent_id' => $news->id, 'name' => $uploading['msg'], 'category' => 'News', 'position' => $i, 'active' => 'Y'));
                $image->title = Input::get('imagestitle'.$i);
                if(!($image->isValid() && $image->save()))
                    return Redirect::route('admin.news.get', [ 'id' => $news->id ])->withErrors($image->getErrors())->withInput();
            }
            //dd(Input::get('imagestitle'.$i));
           $image = Image::where('parent_id', '=', $news->id)->where('category', '=', 'News')->where('position', '=', $i)->first();
            if(count($image) > 0){
               $image->title = Input::get('imagestitle'.$i);
                $image->save();
            }
        }
        if(Input::hasFile('file')){
            $oldFile = $news->archive;
            if($oldFile)
                $oldFile->delete();

            $file = Input::file('file');
             $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path() . '/files/',$filename);

            $fileObj = new Archive();
            $fileObj->fill(array('news_id' => $news->id, 'type' => $file->getClientOriginalExtension(), 'path' =>'files/', 'filename' => $filename, 'active' => 'Y'));
            if(!($fileObj->isValid() && $fileObj->save()))
                return Redirect::route('admin.news.get', [ 'id' => $news->id ])->withErrors($fileObj->getErrors())->withInput();
        }

        //$newsWithSamePosition = Content::where("position", "=", "$news->position")->first();

        if($news->update()){
            /*if(count($newsWithSamePosition)){
                $newsWithSamePosition->position = $orig_pos;
                $newsWithSamePosition->update();
            }*/
            $this->reorder($news->position, $news->id);
            return Redirect::route('admin.news.get', [
                'id' => $news->id
            ])->with('message', "La Noticia <strong>{$news->title}</strong> fue actualizada satisfactoriamente");
        }
        return Redirect::route('admin.news.get', ['id' => $news->id])->withErrors($news->getErrors())->withInput();
    }

    public function delete($id)
    {
        $news = Content::find($id);
        if (empty($news->id)) 
            return Redirect::route('admin.news.list');

        $news->delete();
            return Redirect::route('admin.news.list');
    }


    /**
     * Render form for post
     *
     */
    public function getCreate()
    {
        $allNews = Content::all();
        $news = new Content();
        
        return \View::make('admin.news.edit', [
            'title' => 'Crear Novedad',
            'news' => $news,
            'images' => null,
            'file' => null,
            'countNews' => count($allNews)
        ]);
    }

    public function activateDeactive()
    {
        $news = Content::find(Input::get('id'));
        if($news->active == 'Y')
            $news->active = 'N';
        else
            $news->active = 'Y';
        $news->update();
    }

    public function getFirstAvailablePosition(){
        $news = Content::orderBy('position', 'asc')->get();
        $pos = 1;
        foreach ($news as $aNew) {
            if($aNew->position != $pos)
                return $pos;
            $pos++;
        }
        return $pos;
    }

    public function updatePosition()
    {
        $news = Content::find(Input::get('id'));
        $news->position = Input::get('position');
        if($news->update()){
            $this->reorder($news->position, $news->id);
            echo 'success';
        }
    }

    public function reorder($pos, $id){
        $all = Content::orderBy('position', 'asc')->get();
        $goOn = false;
        foreach ($all as $aNew) {
            if($aNew->position == $pos && $aNew->id != $id){
                $aNew->position++;
                $aNew->update();
                $samePos = Content::where('position','=', $aNew->position)->count();
                if($samePos > 1)
                    $goOn = true;
            }elseif($aNew->position > $pos && $goOn){
                $aNew->position++;
                $aNew->update();
            }
        }
    }

    public function resetPositions(){
         $news = Content::orderBy('position', 'asc')->get();
         $q = count($news);
         for($x = 0; $x < $q; $x++){
            $news[$x]->position = $x+1;
            $news[$x]->update(); 
         }
    }


}

