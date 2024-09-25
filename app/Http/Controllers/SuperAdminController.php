<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Clients;
use App\Models\ClientMenuPrice;

class SuperAdminController extends Controller
{
    //Client Details

    public function clientDetails()
    {
        $clientDetails = Clients::all();
        return view('clientDetails', compact('clientDetails'));
    }


    public function addClient(Request $request)
    {
        $client = new Clients;
        $client->client_name = $request->client_name;
        $client->client_domain_name = $request->client_domain_name;
        $client->client_contact1 = '+91 ' . $request->client_contact1;
        $client->client_contact2 = $request->client_contact2 ? '+91 ' . $request->client_contact2 : null;
        $client->client_location = $request->client_location;
        $client->client_status = $request->client_status;
        $client->client_email = $request->email;
        $client->save();

        return back()->with('success', 'Client added successfully!');
    }

    public function checkDomain(Request $request)
    {
        $domainName = $request->input('client_domain_name');
        $exists = Clients::where('client_domain_name', $domainName)->exists();
        return response()->json(['exists' => $exists]);
    }


    public function editClientDetails($id)
    {
    $client = Clients::findOrFail($id); 
    return response()->json($client); 
    }


    public function updateClientDetails(Request $request, $id)
    {
        $client = Clients::find($id);

        if (!$client) {
            return redirect()->back()->with('error', 'Client not found.');
        }
        
        $client->updated_client_name = $request->client_name;
        $client->updated_client_domain_name = $request->client_domain_name;
        $client->updated_client_contact1 = $request->client_contact1;
        $client->updated_client_contact2 = $request->client_contact2 ? $request->client_contact2 : null;
        $client->updated_client_location = $request->client_location;
        $client->updated_client_status = $request->client_status;
        $client->updated_client_email = $request->client_email;

        // Save the updated client
        $client->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Client updated successfully!');
    }

    

    //Menu Details

    public function menuDetails()
    {
        $menuDetails = Menu::all();
        return view('menuDetails', compact('menuDetails'));
    }


    public function addMenu(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_description' => 'required|string',
            'menu_type' => 'required|integer',
            'menu_category' => 'required|string|max:255',
        ]);
        $imagePath = null; 

        if ($request->hasFile('menu_image')) {
            $image = $request->file('menu_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }
        $menu = new Menu();
        $menu->menu_name = $request->input('menu_name');
        $menu->menu_image = $imagePath; 
        $menu->menu_description = $request->input('menu_description');
        $menu->menu_type = $request->input('menu_type');
        $menu->menu_category = $request->input('menu_category');
        $menu->save();

        return redirect()->route('addMenu')->with('success', 'Menu added successfully!');
    }


    public function destroyMenu($id)
    {
    $menu = Menu::findOrFail($id);
    $menu->delete();

    return response()->json(['message' => 'Menu deleted successfully']);
    }


    public function editMenu($id)
    {
    $menu = Menu::findOrFail($id);
    return response()->json($menu); 
    }


    //Client Menu Price Details

    public function menuPriceDetails()
    {
        $menuPriceDetails = ClientMenuPrice::select(
            'www_menu_price.id',
            'www_menu_price.menu_price',
            'www_menu_price.created_at',
            'www_clients.client_domain_name',   
            'www_menu.menu_name'          
        )
        ->join('www_clients', 'www_menu_price.client_id', '=', 'www_clients.id') 
        ->join('www_menu', 'www_menu_price.menu_id', '=', 'www_menu.id')       
        ->get();
        
        return view('menuPriceDetails', compact('menuPriceDetails'));
    }


    public function addClientMenuPrice()
    {
    $menu = Menu::all();
    $clients = Clients::all();
    return view('addClientMenuPrice', compact('menu','clients'));
    }


    public function submitClientMenuPrice(Request $request)
    {

    $client_id = $request->input('client_id');

    $menu_ids = $request->input('menu_id');
    $menu_prices = $request->input('menu_price');

    foreach ($menu_ids as $index => $menu_id) {
        $price = $menu_prices[$index];

        $clientMenuPrice = new ClientMenuPrice();
        $clientMenuPrice->client_id = $client_id;
        $clientMenuPrice->menu_id = $menu_id;
        $clientMenuPrice->menu_price = $price;
        $clientMenuPrice->save();
    }
    return redirect()->back()->with('success', 'Client menu and prices saved successfully.');
    }

}
