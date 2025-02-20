<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $invoice = Invoice::all();
            if ($invoice->isEmpty()) {
                return response()->json([
                    'message' => 'Aucune facture n\'a été trouvée.',
                    'invoices' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de toutes les factures récupérées avec succès',
                'invoices' => $invoice
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de toutes les factures : ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'string',
            'invoice_date'=>'date',
            'expiry_date'=>'date',
            'total_HT'=>'numeric',
            'total_TVA'=>'numeric',
            'total_TTC'=>'numeric',
            'TVA_rate'=>'numeric',
            'payment_status'=>'string:max:255',
            'from_id'=>'required|exists:entreprises,id',
            'to_id'=>'required|exists:clients,id',
            'devi_id'=>'required|exists:devis,id'
        ], [
            'number.string' => 'Le numéro de la facture doit être une chaîne de caractères.',
            'invoice_date.date' => 'La date d\'émission de la facture doit être une date valide.',
            'expiry_date.date' => 'La date d\'expiration de la facture doit être une date valide.',
            'total_HT.numeric' => 'Le total HT doit être un nombre.',
            'total_TVA.numeric' => 'Le total TVA doit être un nombre.',
            'total_TTC.numeric' => 'Le total TTC doit être un nombre.',
            'TVA_rate.numeric' => 'Le taux de TVA doit être un nombre.',
            'payment_status.string' => 'Le statut de paiement doit être une chaîne de caractères.',
            'from_id.required' => 'L\'id de l\'entreprise de la facture doit être fourni.',
            'from_id.exists' => 'L\'id de l\'entreprise de la facture n\'existe pas.',
            'to_id.required' => 'L\'id du client de la facture doit être fourni.',
            'to_id.exists' => 'L\'id du client de la facture n\'existe pas.',
            'devi_id.required' => 'L\'id du devis de la facture doit être fourni.',
            'devi_id.exists' => 'L\'id du devis de la facture n\'existe pas.'
        ]);
        $invoice = Invoice::create($request->all());
        return response()->json($invoice, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            return response()->json($invoice, 200);
        } catch (Exception $exception) {
            return response()->json([
               'message' => 'Erreur lors de la récupération de la facture : '. $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $request->validate([
                'number' => 'string',
                'invoice_date'=>'date',
                'expiry_date'=>'date',
                'total_HT'=>'numeric',
                'total_TVA'=>'numeric',
                'total_TTC'=>'numeric',
                'TVA_rate'=>'numeric',
                'payment_status'=>'string:max:255',
                'from_id'=>'required|exists:entreprises,id',
                'to_id'=>'required|exists:clients,id',
                'devi_id'=>'required|exists:devis,id'
            ], [
                'number.string' => 'Le numéro de la facture doit être une chaîne de caractères.',
                'invoice_date.date' => 'La date d\'émission de la facture doit être une date valide.',
                'expiry_date.date' => 'La date d\'expiration de la facture doit être une date valide.',
                'total_HT.numeric' => 'Le total HT doit être un nombre.',
                'total_TVA.numeric' => 'Le total TVA doit être un nombre.',
                'total_TTC.numeric' => 'Le total TTC doit être un nombre.',
                'TVA_rate.numeric' => 'Le taux de TVA doit être un nombre.',
                'payment_status.string' => 'Le statut de paiement doit être une chaîne de caractères.',
                'from_id.required' => 'L\'id de l\'entreprise de la facture doit être fourni.',
                'from_id.exists' => 'L\'id de l\'entreprise de la facture n\'existe pas.',
                'to_id.required' => 'L\'id du client de la facture doit être fourni.',
                'to_id.exists' => 'L\'id du client de la facture n\'existe pas.',
                'devi_id.required' => 'L\'id du devis de la facture doit être fourni.',
                'devi_id.exists' => 'L\'id du devis de la facture n\'existe pas.'
            ]);
            $invoice->update($request->all());
            return response()->json($invoice, 200);
        } catch (Exception $exception) {
            return response()->json([
               'message' => 'Erreur lors de la mise à jour de la facture : '. $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
            return response()->json(['message' => 'Facture supprimée avec succès'], 200);
        } catch (Exception $exception) {
            return response()->json([
               'message' => 'Erreur lors de la suppression de la facture : '. $exception->getMessage()
            ], 500);
        }
    }
}
