<?php

namespace App\Http\Controllers;

use App\Models\LandlordDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandlordVerificationController extends Controller
{

    /**
     * Show verification pending page
     */
    public function pending()
    {
        $user = auth()->user();
        
        // If user is already verified, redirect to dashboard
        if ($user->is_verified) {
            return redirect()->route('landlord.properties.index');
        }
        
        $document = $user->documents()->latest()->first();
        
        return view('landlord.verification-pending', compact('document'));
    }

    /**
     * Upload additional verification document
     */
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document' => ['required', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:10240'],
            'document_type' => ['required', 'in:id_proof,property_ownership,business_permit'],
        ]);

        $user = auth()->user();
        
        // Delete old pending document of same type if exists
        $oldDoc = $user->documents()
            ->where('document_type', $request->document_type)
            ->where('status', 'pending')
            ->first();
            
        if ($oldDoc) {
            Storage::disk('public')->delete($oldDoc->document_path);
            $oldDoc->delete();
        }

        $path = $request->file('document')->store('landlord-documents', 'public');
        
        LandlordDocument::create([
            'user_id' => $user->id,
            'document_type' => $request->document_type,
            'document_path' => $path,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Document uploaded successfully! We will review it shortly.');
    }

    /**
     * Check verification status (for AJAX)
     */
    public function checkStatus()
    {
        $user = auth()->user();
        
        return response()->json([
            'is_verified' => $user->is_verified,
            'documents' => $user->documents()->get()->map(fn($doc) => [
                'type' => $doc->document_type,
                'status' => $doc->status,
                'rejection_reason' => $doc->rejection_reason,
            ]),
        ]);
    }
}
