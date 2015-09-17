<?php

class VideosController extends \BaseController {

    /**
     * Display a listing of the videos
     *
     */
    public function get()
    {
        $videos = Video::all();

        return \View::make('admin.videos.list', [
            'title' => 'Galer&iacute;a de Videos',
            'videos' => $videos
        ]);
    }


    /**
     * Create a Video
     *
     */
    public function postCreate()
    {
        $input = Input::all();
        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';
        
        if(!Input::hasFile('image') || !Input::has('finalB64Inputimage'))
            return Redirect::route('admin.videos.create')->with('message', "Debes cargar 1 imagen")->withInput();
        
        $video = new Video();
        $video->fill($input);
        
        if ($video->isValid() && $video->save()) {
            
            $image = new Image();
            $uploading = $image->uploadFromBase64('image', 'videos');
            if(!$uploading['success'])
                return Redirect::route('admin.videos.get', [ 'id' => $video->id ])->withErrors($uploading['msg'])->withInput();
            $image->fill(array('parent_id' => $video->id, 'name' => $uploading['msg'], 'category' => 'Videos', 'position' => 0, 'active' => 'Y'));
            if(!($image->isValid() && $image->save()))
                return Redirect::route('admin.videos.get', [ 'id' => $video->id ])->withErrors($image->getErrors())->withInput();
                
            return Redirect::route('admin.videos.get', [ 'id' => $video->id ])->with('message', "El video <strong>{$video->title}</strong> se cre&oacute; con &eacute;xito");
        }
        return Redirect::route('admin.videos.create')->withErrors($video->getErrors())->withInput();
    }

    /**
     * Get a Video
     *
     */
    public function getUpdate($id)
    {
        $video = Video::find($id);
        if (empty($video->id)) 
            return Redirect::route('admin.videos.list');

        $image = Image::where('parent_id', '=', $video->id)->where('category', '=', 'Videos')->get()->first();
        
        //dd($image); 
        return \View::make('admin.videos.edit', [
            'title' => $video->title,
            'video' => $video,
            'image' => $image
        ]);
    }

    /**
     * Update a video
     *
     */
    public function postUpdate($id)
    {
        $video = Video::find($id);
        if (empty($video->id)) 
            return Redirect::route('admin.videos.list');

        $input = Input::all();
        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';
        $video = $video->fill($input);
        
        if(Input::hasFile('image')){
            $oldImage = Image::where('parent_id', '=', $video->id)->where('category', '=', 'Videos')->first();
            if(count($oldImage))
                $oldImage->delete();
            $image = new Image();
            $uploading = $image->uploadFromBase64('image', 'videos');
            if(!$uploading['success'])
                return Redirect::route('admin.videos.get', [ 'id' => $video->id ])->withErrors($uploading['msg'])->withInput();
            $image->fill(array('parent_id' => $video->id, 'name' => $uploading['msg'], 'category' => 'Videos', 'position' => 0, 'active' => 'Y'));
            if(!($image->isValid() && $image->save()))
                return Redirect::route('admin.videos.get', ['id' => $video->id])->withErrors($image->getErrors())->withInput();
        } 
        if($video->update()){
            return Redirect::route('admin.videos.get', [
                'id' => $video->id
            ])->with('message', "El video<strong>{$video->title}</strong> fue actualizada satisfactoriamente");
        }
        return Redirect::route('admin.videos.get', ['id' => $video->id])->withErrors($video->getErrors())->withInput();
    }

    public function delete($id)
    {
        $video = Video::find($id);
        if (empty($video->id)) 
            return Redirect::route('admin.videos.list');

        $video->delete();
            return Redirect::route('admin.videos.list');
    }


    /**
     * Render form for post
     *
     */
    public function getCreate()
    {
        $video = new Video();
        
        return \View::make('admin.videos.edit', [
            'title' => 'Crear Video',
            'video' => $video,
            'image' => null
        ]);
    }

    



}

