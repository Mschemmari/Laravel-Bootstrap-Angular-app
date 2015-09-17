<?php

class ApiController extends \BaseController {

    /**
     * Display a listing of the sliders
     *
     */
    public function home()
    {
        $sliders = Slider::where("active", "=", "Y")->orderBy('position', 'asc')->get();
            
        foreach ($sliders as $slider) 
            $slider->image = $slider->images()->where('category', '=', 'Sliders')->first();
        
        return Response::json($sliders);
    }

    public function lastNews()
    {
        $news = Content::where("active", "=", "Y")->orderBy('position', 'asc')->take(2)->get();
            
        foreach ($news as $new) 
            $new->image = Content::find($new->id)->images()->where('category', '=', 'News')->orderBy("position", 'asc')->first();
        
        return Response::json($news);
    }

    public function lastAlbums()
    {
        $albums = Album::where("active", "=", "Y")->orderBy('id', 'desc')->take(2)->get();
            
        foreach ($albums as $album) 
            $album->image = Album::find($album->id)->images()->where('category', '=', 'Albums')->orderBy("position", 'asc')->first();
        
        return Response::json($albums);
    }

    public function lastVideos()
    {
        $videos = Video::where("active", "=", "Y")->orderBy('id', 'desc')->take(2)->get();
            
        foreach ($videos as $video) 
            $video->image = Video::find($video->id)->images()->where('category', '=', 'Videos')->orderBy("position", 'asc')->first();
        
        return Response::json($videos);
    }

    public function calendarEvents()
    {
        $events = CalendarEvent::where("active", "=", "Y")->where("date", ">=", date('Y-m-d'))->orderBy('date', 'asc')->get();
            
        return Response::json($events);
    }

    public function vote()
    {
        $input = Input::all();
        $score = Input::get('score');
        $ip = Input::get('ip');
        $voteable_type = Input::get('voteable_type');
        $voteable_id = Input::get('voteable_id');

        $vote = Vote::where('ip', '=', $ip)->where('voteable_type', '=', $voteable_type)->where('voteable_id', '=', $voteable_id)->first();
        if(count($vote) > 0){ 
            $vote->fill($input);
            $vote->update();
        }else{
            $vote = new Vote();
            $vote->fill($input);
            $vote->save();
        }
        $votes = Vote::where('voteable_type', '=', $voteable_type)->where('voteable_id', '=', $voteable_id)->get();
        return Vote::getAverage($votes);
    }

    public function news()
    {
        $news = Content::where("active", "=", "Y")->orderBy('position', 'asc')->get();
        	
		foreach ($news as $new) {
			$votes = $new->votes()->where('voteable_type', '=', 'News')->get();
			$new->stars = Vote::getAverage($votes);
			$images = $new->images()->where('category', '=', 'News')->orderBy("position", 'asc')->get();
			$new->images = $images; 
            $new->date = $new->created_at->format('d/m/Y');
            $new->archive;
		}
		
        return Response::json($news);
    }

    public function albums()
    {
        $albums = Album::where("active", "=", "Y")->orderBy('id', 'desc')->get();
            
        foreach ($albums as $album) {
            $votes = $album->votes()->where('voteable_type', '=', 'Albums')->get();
            $album->stars = Vote::getAverage($votes);
            $images = $album->images()->where('category', '=', 'Albums')->orderBy("position", 'asc')->get();
            $album->images = $images; 
            $album->date = $album->created_at->format('d/m/Y');
        }
        
        return Response::json($albums);
    }

    public function videos()
    {
        $videos = Video::where("active", "=", "Y")->orderBy('id', 'desc')->get();
            
        foreach ($videos as $video) {
            $votes = $video->votes()->where('voteable_type', '=', 'Videos')->get();
            $video->stars = Vote::getAverage($votes);
            $images = $video->images()->where('category', '=', 'Videos')->orderBy("position", 'asc')->get();
            $video->images = $images; 
            $video->date = $video->created_at->format('d/m/Y');
        }
        
        return Response::json($videos);
    }

    
}

