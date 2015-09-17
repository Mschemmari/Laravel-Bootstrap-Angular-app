<?php
//namespace App\Controllers;

//use App\models\User;

class AdminController extends \BaseController {

    public function index()
    {
        // $var =
        return \View::make('admin.login');
    }

    public function createUser()
    {
        $user = new User();

        $user->username = 'admin';

        $user->password = \Hash::make('912bayer');

        $user->save();
    }

    public function login()
    {

        $credentials = array(
            'username' => \Input::get('username'),
            'password' => \Input::get('password'),
        );

        if (\Auth::attempt($credentials)) {

            /*if (\Auth::user()->active == 0) {
                $this->logout(false);
                return \Redirect::route('backend.login')->withErrors(array('message' => 'The selected user is inactive'))->withInput(\Input::except('password'));
            };*/

            return \Redirect::route('backend.home');
        }

        return \Redirect::route('backend.login')->withErrors(array('message' => 'Incorrect username or password'))->withInput(\Input::except('password'));
    }

    public function logout($redirect = true)
    {
        \Auth::logout();

        if ($redirect === true) {
            return \Redirect::route('backend.login');
        }
    }

    public function dashIndex(){

        $albums = Album::all();
        $news = Content::all();
        $videos = Video::all();
        $sliders = Slider::all();
        $events = CalendarEvent::all();
        
        return \View::make('admin.home', [
            'title' => 'Dashboard',
            'news' => $news,
            'albums' => $albums,
            'videos' => $videos,
            'sliders' => $sliders,
            'events' => $events
        ]);
    }

    public function getUsers()
    {

        $admins = \Admin::orderBy('username', 'ASC')->get();

        return \View::make('backend::admin.list', [
            'title' => 'Administrators',
            'admins' => $admins
        ]);

    }

    /**
     * Render form for Admin
     *
     */
    public function getCreate()
    {
        $admin = new \Admin();
        $clients = \Client::get();

        return \View::make('backend::admin.edit', [
            'title' => 'Create admin',
            'admin' => $admin,
            'clients' => $clients,
        ]);
    }

    /**
     * Create admin
     *
     */
    public function postCreate()
    {
        $input = \Input::only('username', 'password', 'email','client_id');
        $input['active'] = \Input::get('active') == 'on' ? 1 : 0;
        // dd($input);exit;
        $admin = new \Admin();
        $input['password'] = empty($input['password']) ? $admin->password : \Hash::make($input['password']);

        $admin = $admin->fill($input);

        if ($admin->isValid() && $admin->save()) {
            return \Redirect::route('backend.admin.get', [
                'id' => $admin->admin_id]
            )
            ->with('message', "The admin <strong>{$admin->name}</strong> was created successfully");
        }

        return \Redirect::route('backend.admin.create')
        ->withErrors($admin->getErrors())
        ->withInput();
    }

   /**
     * Get admin
     *
     */
    public function getUpdate($admin_id)
    {
        $admin = \Admin::where('admin_id', $admin_id)->first();

        if (empty($admin->admin_id)) {
            return \Redirect::route('backend.admins');
        }

        $clients = \Client::leftJoin('admins', 'admins.client_id', '=', 'clients.client_id')->get();

        return \View::make('backend::admin.edit', [
            'title' => $admin->username,
            'admin' => $admin,
            'clients' => $clients,
        ]);
    }

    /**
     * Update admin
     *
     */
    public function postUpdate($admin_id)
    {
        $input = \Input::only('username', 'password', 'email','client_id');
        $input['active'] = \Input::get('active') == 'on' ? 1 : 0;

        $admin = \Admin::where('admin_id', $admin_id)->first();

        if (empty($admin->admin_id)) {
            return \Redirect::route('backend.admins');
        }

        $input['password'] = empty($input['password']) ? $admin->password : \Hash::make($input['password']);
        $input['client_id'] = empty($input['client_id']) && ! empty($admin->client_id) ? $admin->client_id : $input['client_id'];

        $admin = $admin->fill($input);
        if ($admin->isValid() && $admin->update()) {
            return \Redirect::route('backend.admin.get', [
                'id' => $admin->admin_id
            ])
            ->with('message', "The admin <strong>{$admin->name}</strong> was updated successfully");;
        }

        return \Redirect::route('backend.admin.get',  [
            'id' => $admin->admin_id
        ])
        ->withErrors($admin->getErrors())
        ->withInput();
    }

}