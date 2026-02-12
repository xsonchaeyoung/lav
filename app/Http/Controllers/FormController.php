<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function saveData(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email',
            'telefono' => 'required|digits_between:8,10',
            'mensaje' => 'required',
        ]);

        Contact::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'contacto guardado correctamente',
        ]);
    }

    public function getContacts()
    {

        $contacts = DB::table('contacts')
            ->select('id', 'nombre', 'telefono', 'email', 'mensaje')
            ->get();

        return view('contacts', ['contacts' => $contacts]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email',
            'telefono' => 'required|digits_between:8,10',
            'mensaje' => 'required',
        ]);

        Contact::where('id', $request->id)->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'contacto actualizado correctamente',
        ]);
    }
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Eliminado correctamente'
        ]);
    }
    
    
}
