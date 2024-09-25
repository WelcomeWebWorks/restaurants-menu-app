<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Clients;
use App\Models\ClientMenuPrice;

class ProductController extends Controller
{
    public function checkDomainName(Request $request, $domainName)
    {
        $exists = Clients::where('client_domain_name', $domainName)->exists();
        
        if ($exists) {
            return view('welcome', ['domainName' => $domainName]);
        }

        return view('404');
    }


    public function getMenuItems(Request $request) {
        $domainName = $request->query('domainName');
    
        $menuItems = ClientMenuPrice::select(
            'www_menu_price.menu_price',
            'www_clients.client_domain_name',
            'www_menu.menu_name',
            'www_menu.menu_description',
            'www_menu.menu_image',
            'www_menu.menu_type'
        )
        ->join('www_clients', 'www_menu_price.client_id', '=', 'www_clients.id')
        ->join('www_menu', 'www_menu_price.menu_id', '=', 'www_menu.id')
        ->where('www_clients.client_domain_name', $domainName)
        ->get();
    
        return response()->json($menuItems);
    }
}
