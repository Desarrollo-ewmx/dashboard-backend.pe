<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Menus\GetSidebarMenu;
use App;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if (session()->has('locale')) {
        //    App::setLocale(session()->get('locale'));
        //}
        App::setLocale($request->locale);
        try {
            $user = auth()->user();
            if($user && !empty($user)){
                $roles =  $user->menuroles;
            }else{
                $roles = '';
            }
        } catch (Exception $e) {
            $roles = '';
        }  
        if($request->has('menu')){
            $menuName = $request->input('menu');
        }else{
            $menuName = 'sidebar menu';
        } 
        $menus = new GetSidebarMenu();
        return response()->json( $menus->get( $roles, App::getLocale(), $menuName ) );
    }

}

