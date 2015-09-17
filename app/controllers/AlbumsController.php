<?php

class AlbumsController extends \BaseController {

    /**
     * Display a listing of the albums
     *
     */
    public function get()
    {
        $albums = Album::all();

        return \View::make('admin.albums.list', [
            'title' => 'Galer&iacute;a de Im&aacute;genes',
            'albums' => $albums
        ]);
    }


    /**
     * Create an Album
     *
     */
    public function postCreate()
    {
        $input = Input::all();
        $file = Input::file();

        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';

        if(!Input::hasFile('images')|| !Input::has('finalB64Inputimages0'))
            return Redirect::route('admin.albums.create')->with('message', "Debes cargar por lo menos 1 imagen")->withInput();
        
        $album = new Album();
        $album->fill($input);
        
        if ($album->isValid() && $album->save()) {
            $imgMax = 70;
            for($i = 0; $i < $imgMax; $i++){
                if(isset($file['images'][$i])){
                    $image = new Image();
                    $uploading = $image->uploadFromBase64('images', 'albums', $i);
                    if(!$uploading['success'])
                        return Redirect::route('admin.albums.get', [ 'id' => $album->id ])->withErrors($uploading['msg'])->withInput();
                    $image->fill(array('parent_id' => $album->id, 'name' => $uploading['msg'], 'category' => 'Albums', 'position' => $i, 'active' => 'Y'));
                    if(!($image->isValid() && $image->save()))
                        return Redirect::route('admin.albums.get', [ 'id' => $album->id ])->withErrors($image->getErrors())->withInput();
                }
            }
            return Redirect::route('admin.albums.get', [ 'id' => $album->id ])->with('message', "El album <strong>{$album->title}</strong> se cre&oacute; con &eacute;xito");
        }
        return Redirect::route('admin.albums.create')->withErrors($album->getErrors())->withInput();
    }

    /**
     * Get an Album
     *
     */
    public function getUpdate($id)
    {
        $album = Album::find($id);
        if (empty($album->id)) 
            return Redirect::route('admin.albums.list');

        $images = Image::where('parent_id', '=', $album->id)->where('category', '=', 'Albums')->orderBy('position')->get();
        //dd(DB::getQueryLog());
        //$images = $album->images(); 
        return \View::make('admin.albums.edit', [
            'title' => $album->title,
            'album' => $album,
            'images' => $images,
            'showableInputs' => count($images)
        ]);
    }

    /**
     * Update an album
     *
     */
    public function postUpdate($id)
    {
        $album = Album::find($id);
        if (empty($album->id)) 
            return Redirect::route('admin.albums.list');

        $input = Input::all();
        $file = Input::file();
        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';
        $album = $album->fill($input);
        $imgMax = 70;
        for($i = 0; $i < $imgMax; $i++){
            if(isset($file['images'][$i])){
                $oldImage = Image::where('parent_id', '=', $album->id)->where('category', '=', 'Albums')->where('position', '=', $i)->first();
                if(count($oldImage))
                    $oldImage->delete();
                $image = new Image();
                $uploading = $image->uploadFromBase64('images', 'albums', $i);
                if(!$uploading['success'])
                    return Redirect::route('admin.albums.get', [ 'id' => $album->id ])->withErrors($uploading['msg'])->withInput();
                $image->fill(array('parent_id' => $album->id, 'name' => $uploading['msg'], 'category' => 'Albums', 'position' => $i, 'active' => 'Y'));
                if(!($image->isValid() && $image->save()))
                    return Redirect::route('admin.albums.get', ['id' => $album->id])->withErrors($image->getErrors())->withInput();
            }
        }
        if($album->update()){
            return Redirect::route('admin.albums.get', [
                'id' => $album->id
            ])->with('message', "El &aacute;lbum <strong>{$album->title}</strong> fue actualizada satisfactoriamente");
        }
        return Redirect::route('admin.albums.get', ['id' => $album->id])->withErrors($album->getErrors())->withInput();
    }

    public function delete($id)
    {
        $album = Album::find($id);
        if (empty($album->id)) 
            return Redirect::route('admin.albums.list');

        $album->delete();
            return Redirect::route('admin.albums.list');
    }


    /**
     * Render form for post
     *
     */
    public function getCreate()
    {
        $album = new Album();
        
        return \View::make('admin.albums.edit', [
            'title' => 'Crear Album',
            'album' => $album,
            'images' => null,
            'showableInputs' => 7
        ]);
    }

    



}

