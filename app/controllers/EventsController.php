<?php

class EventsController extends \BaseController {

    /**
     * Display a listing of the event
     *
     */
    public function get()
    {
        $events = CalendarEvent::all();

        return \View::make('admin.events.list', [
            'title' => 'Calendario',
            'events' => $events
        ]);
    }


    /**
     * Create a event
     *
     */
    public function postCreate()
    {
        $input = Input::all();
        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';

        $event = new CalendarEvent();
        $event = $event->fill($input);
        
        if ($event->isValid() && $event->save()) 
            return Redirect::route('admin.events.get', [ 'id' => $event->id ])->with('message', "El evento del calendario <strong>{$event->title}</strong> se cre&oacute; con &eacute;xito");
        return Redirect::route('admin.events.create')->withErrors($event->getErrors())->withInput();
    }

    /**
     * Get a event
     *
     */
    public function getUpdate($id)
    {
        $event = CalendarEvent::find($id);
        if (empty($event->id)) 
            return Redirect::route('admin.events.list');

        return \View::make('admin.events.edit', [
            'title' => $event->title,
            'event' => $event
        ]);
    }

    /**
     * Update a event
     *
     */
    public function postUpdate($id)
    {
        $event = CalendarEvent::find($id);

        if (empty($event->id)) 
            return Redirect::route('admin.events.list');

        $input = Input::all();
        $input['active'] = Input::get('active') == 'on' ? 'Y' : 'N';
        $event->fill($input);

        if($event->update()){
            return Redirect::route('admin.events.get', [
                'id' => $event->id
            ])->with('message', "El evento del calendario <strong>{$event->title}</strong> fue actualizado satisfactoriamente");
        }
        return Redirect::route('admin.events.get', ['id' => $event->id])->withErrors($event->getErrors())->withInput();
    }

    public function delete($id)
    {
        $event = CalendarEvent::find($id);
        if (empty($event->id)) 
            return Redirect::route('admin.events.list');

        $event->delete();
            return Redirect::route('admin.events.list');
    }


    /**
     * Render form for post
     *
     */
    public function getCreate()
    {
        $event = new CalendarEvent();
        
        return \View::make('admin.events.edit', [
            'title' => 'Crear Evento del Calendario',
            'event' => $event
        ]);
    }

    public function activateDeactive()
    {
        $event = CalendarEvent::find(Input::get('id'));
        if($event->active == 'Y')
            $event->active = 'N';
        else
            $event->active = 'Y';
        $event->update();
    }


}

