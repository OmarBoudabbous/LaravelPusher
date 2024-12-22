<?php

namespace App\Http\Controllers;

use App\Events\PanneNotification;
use App\Models\Panne;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PanneController extends Controller
{
    public function index()
    {
        $userPannes = Panne::where('user_id', Auth::id())->paginate(7);
        return view('role.admin.panne', compact('userPannes'));
    } //end method


    public function getOnePanne($id)
    {
        $pannes = Panne::orderBy('id', 'desc')->paginate(9);
        $panne = Panne::find($id);
        // Check if the panne exists
        if (!$panne) {
            // If the panne is not found, redirect or show an error page
            return redirect()->route('panne.index')->with('error', 'Panne not found!');
        }


        // Pass the panne data to the view
        return view('role.admin.panne-by-id', compact('panne', 'pannes'));
    } //end method


    public function update(Request $request, $id)
    {
        $panne = Panne::findOrFail($id);

        $request->validate([
            'user_id' => 'required',
            'voie' => 'required|in:S1,S2,S3,E4,E5,E6',
            'type' => 'required|in:LECTURE,PANNE_ELECTRICITE,BARRIERE,CLASSE',
            'status' => 'required|in:En cours,Terminée,Annulée',
            'comment' => 'nullable|string',
        ]);

        // Update the panne object with the new data from the request
        $panne->user_id = $request->input('user_id');
        $panne->voie = $request->input('voie');
        $panne->type = $request->input('type');
        $panne->status = $request->input('status');
        $panne->comment = $request->input('comment');

         // Set session message and alert type
         Session::flash('message', 'Panne modifier avec succès!');
         Session::flash('alert-type', 'success');

        // Save the changes to the database
        $panne->save();

        return redirect()->back();
    }


    public function destroy($id)
    {
        $panne = Panne::findOrFail($id); // Fetch the panne by ID or throw a 404 error
        // Delete the panne from the database
        $panne->delete();

        // Set session message and alert type
        Session::flash('message', 'Panne suprimer avec succès!');
        Session::flash('alert-type', 'success');
        // Redirect to the pannes index with a success message
        return redirect()->route('admin.index');
    }


    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'voie' => ['required', 'in:S1,S2,S3,E4,E5,E6'],
            'type' => ['required', 'in:LECTURE,PANNE_ELECTRICITE,BARRIERE,CLASSE'],
            'status' => ['required', 'in:En cours,Terminée,Annulée'],
            'comment' => ['nullable', 'string'],
        ]);

        // Store the panne record with the user_id from Auth
        $panne = Panne::create([
            'voie' => $validatedData['voie'],
            'type' => $validatedData['type'],
            'status' => $validatedData['status'],
            'comment' => $validatedData['comment'],
            'user_id' => Auth::id(), // Get the authenticated user's ID
        ]);

        // Dispatch the event with the post data
        event(new PanneNotification([
            'voie' => $panne->voie,
            'type' => $panne->type,
            'id' => $panne->id,
            'user' => $panne->user->name,
            'matricule' => $panne->user->matricule
        ]));

         // Set session message and alert type
         Session::flash('message', 'Panne ajoutée avec succès!');
         Session::flash('alert-type', 'success');
 
         // Redirect to the panne route
         return redirect()->route('panne');
    }
}
