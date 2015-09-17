<?php
//namespace App\Modules\Backend\Controllers;

class DashboardController extends \BaseController {

	public function index()
	{

        /*$products = \Product::byClient();
        $features = \Feature::byClient();
        $specs = \Spec::byClient();
        $categories = \Category::byClient();
        $groups = \Group::byClient();*/

        return \View::make('backend::admin.home', [
            'title' => 'Dashboard',
            /*'products' => $products,
            'features' => $features,
            'specs' => $specs,
            'categories' => $categories,
            'groups' => $groups,*/
        ]);
	}

}
