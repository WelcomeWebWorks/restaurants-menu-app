<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Clients;
use App\Models\ClientMenuPrice;

class SrinuController extends Controller
{
    /* public function clientDatas()
    {
        $clientDatas = Clients::all();
        return view('srinuWork', compact('clientDatas'));
    } */
   public function index()
   {
    $clientDatas = Clients::all();
    return view('srinuWork', compact('clientDatas'));
    //return view('srinuWork');
   }

    public function create(Request $request)
    {
        $js_clients = new Clients;
        $js_clients->client_name = $request->js_client_name;
        $js_clients->client_domain_name = $request->js_client_domain_name;
        $js_clients->client_contact1 = $request->js_client_contact1;
        $js_clients->client_contact2 = $request->js_client_contact2;
        $js_clients->client_email = $request->js_client_email;
        $js_clients->client_location = $request->js_client_location;
        $js_clients->client_status = $request->js_client_status;

        $js_clients->save();
        return redirect(route('index'));
    }

   /*  public function edit($id)
    {
        $client = Clients::find($id);
        $clientDatas = Clients::all(); // Fetch the menu by ID
        //return response()->json($client); // Return menu data as JSON
        return view('srinuWork',['clientid'=>$client,'clientDatas'=>$clientDatas]);
    } */
    
    /* public function edit($id)
    {
    $client = Clients::findOrFail($id); // Fetch the menu by ID
    return response()->json($client); // Return menu data as JSON
    }

    public function update(Request $request, $id)

    {
    // Find the client by ID
    $client = Clients::find($id);
    if (!$client) {
        return response()->json(['status' => 'error', 'message' => 'Client not found'], 404);
    }

    // Update client data
    // $client->update($request->all());
    
    if ($request->has('client_name')) {
        $client->client_name = $request->client_name;
    }

    if ($request->has('client_domain_name')) {
        $client->client_domain_name = $request->client_domain_name;
    }

    if ($request->has('client_contact1')) {
        $client->client_contact1 = $request->client_contact1;
    }

    if ($request->has('client_contact2')) {
        $client->client_contact2 = $request->client_contact2;
    }

    if ($request->has('client_email')) {
        $client->client_email = $request->client_email;
    }

    if ($request->has('client_location')) {
        $client->client_location = $request->client_location;
    }

    if ($request->has('client_status')) {
        $client->client_status = $request->client_status;
    }

    // Save the updated client
    $client->save();

    return redirect(route('srinuWork'));


    //return response()->json(['status' => 'success', 'message' => 'Client updated successfully']);
    } */

}
