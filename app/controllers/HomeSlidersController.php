<?php

class HomeSlidersController extends \BaseController {

    /**
     * Display a listing of the sliders
     *
     */
    public function get()
    {
        $sliders = Slider::orderBy('position', 'asc')->get();

        return \View::make('admin.home-sliders.list', [
            'title' => 'Home Sliders',
            'sliders' => $sliders
        ]);
    }


    /**
     * Create a slider
     *
     */
    public function postCreate()
    {
        $input = Input::all();
        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';

        if(!Input::hasFile('image') || !Input::has('finalB64Inputimage'))
            return Redirect::route('admin.home-sliders.create')->with('message', "Debes cargar 1 imagen")->withInput();
        
        $slider = new Slider();
        $slider->fill($input);
        
        $sliderWithSamePosition = Slider::where("position", "=", "$slider->position")->first();
        $aux_pos = $this->getFirstAvailablePosition();
        
        if ($slider->isValid() && $slider->save()) {
            if(count($sliderWithSamePosition)){
                $sliderWithSamePosition->position = $aux_pos;
                $sliderWithSamePosition->update();
            }
            $image = new Image();
            //$uploading = $image->upload('image', 'home-sliders');
            $uploading = $image->uploadFromBase64('image', 'home-sliders');
            if(!$uploading['success'])
                return Redirect::route('admin.home-sliders.get', [ 'id' => $slider->id ])->withErrors($uploading['msg'])->withInput();
            $image->fill(array('parent_id' => $slider->id, 'name' => $uploading['msg'], 'category' => 'Sliders', 'position' => 0, 'active' => 'Y'));
            if(!($image->isValid() && $image->save()))
                return Redirect::route('admin.home-sliders.get', [ 'id' => $slider->id ])->withErrors($image->getErrors())->withInput();
            
            return Redirect::route('admin.home-sliders.get', [ 'id' => $slider->id ])->with('message', "El slider <strong>{$slider->title}</strong> se cre&oacute; con &eacute;xito");
        }
        return Redirect::route('admin.home-sliders.create')->withErrors($slider->getErrors())->withInput();
    }

    /**
     * Get a slider
     *
     */
    public function getUpdate($id)
    {
        $slider = Slider::find($id);
        if (empty($slider->id)) 
            return Redirect::route('admin.home-sliders.list');

        $image = Image::where('parent_id', '=', $slider->id)->where('category', '=', 'Sliders')->get()->first();
        //dd($image);
        //dd(DB::getQueryLog());
        //$images = $slider->images(); 
        return \View::make('admin.home-sliders.edit', [
            'title' => $slider->title,
            'slider' => $slider,
            'image' => $image
        ]);
    }

    /**
     * Update a slider
     *
     */
    public function postUpdate($id)
    {
        $slider = Slider::find($id);
        if (empty($slider->id)) 
            return Redirect::route('admin.home-sliders.list');

        $orig_pos = $slider->position;
        $input = Input::all();
        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';
        $slider = $slider->fill($input);
       
        if(Input::hasFile('image')){
            $oldImage = Image::where('parent_id', '=', $slider->id)->where('category', '=', 'sliders')->first();
            if(count($oldImage))
                $oldImage->delete();
            $image = new Image();
            $uploading = $image->uploadFromBase64('image', 'home-sliders');
            if(!$uploading['success'])
                return Redirect::route('admin.home-sliders.get', [ 'id' => $slider->id ])->withErrors($uploading['msg'])->withInput();
            $image->fill(array('parent_id' => $slider->id, 'name' => $uploading['msg'], 'category' => 'Sliders', 'position' => 0, 'active' => 'Y'));
            if(!($image->isValid() && $image->save()))
                return Redirect::route('admin.home-sliders.get', ['id' => $slider->id])->withErrors($image->getErrors())->withInput();
        } 

        $sliderWithSamePosition = Slider::where("position", "=", "$slider->position")->first();

        if($slider->update()){
            if(count($sliderWithSamePosition)){
                $sliderWithSamePosition->position = $orig_pos;
                $sliderWithSamePosition->update();
            }
            return Redirect::route('admin.home-sliders.get', [
                'id' => $slider->id
            ])->with('message', "El slider <strong>{$slider->title}</strong> fue actualizado satisfactoriamente");
        }
        return Redirect::route('admin.home-sliders.get', ['id' => $slider->id])->withErrors($slider->getErrors())->withInput();
    }

    public function delete($id)
    {
        $slider = Slider::find($id);
        if (empty($slider->id)) 
            return Redirect::route('admin.home-sliders.list');

        $slider->delete();
            return Redirect::route('admin.home-sliders.list');
    }


    /**
     * Render form for post
     *
     */
    public function getCreate()
    {
        $slider = new Slider();
        
        return \View::make('admin.home-sliders.edit', [
            'title' => 'Crear Home Slider',
            'slider' => $slider,
            'image' => null
        ]);
    }

    
    public function getFirstAvailablePosition(){
        $sliders = Slider::orderBy('position', 'asc')->get();
        $pos = 1;
        foreach ($sliders as $slider) {
            if($slider->position != $pos)
                return $pos;
            $pos++;
        }
        return $pos;
    }

}

