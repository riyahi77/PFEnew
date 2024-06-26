<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Chef;
use App\Models\Consultation;
use App\Models\Filiere;
use App\Models\User;


use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // if the user is a candidat then show only his consultations
        if ($user->role == 'candidat') {
            if (!Candidat::where('user_id', $user->id)->exists()) {
                $consultations = Consultation::all();
                return view('consultations.index', compact('consultations'));
            }

            $candidat = Candidat::where('user_id', $user->id)->first();
            $consultations = Consultation::where('candidat_id', $candidat->id)->get();
            return view('consultations.index', compact('consultations'));
        }

        // if the user is a chef_filiere then show only the consultations of his filiere
        if ($user->role == 'chef_filiere') {
            $chef = Chef::where('user_id', $user->id)->first();
            if ($chef) {
                $consultations = Consultation::where('filiere_id', $chef->filiere_id)->get();
                return view('consultations.index', compact('consultations'));
            }
        }

        // if the user is a chef then show all consultations
        if ($user->role == 'chef') {
            $consultations = Consultation::all();
            return view('consultations.index', compact('consultations'));
        }

        // Default: return all consultations
        $consultations = Consultation::all();

        return view('consultations.index', compact('consultations'));
    }

    public function store(Request $request, $candidatId, $filiereName){
        $userID = $candidatId;
        $candidat = Candidat::where('user_id', $userID)->first();
        $filiere = Filiere::where('nom', $filiereName)->first();

        $validDiplomasForMaster = ['LICENCE', 'MASTER'];
        $filiereType = $filiere->type;




        if ($filiereType === 'master' && !in_array($candidat->dernier_diplome, $validDiplomasForMaster)) {
            return redirect()->route('consultations.index')->withErrors(['error' => 'You need to have one of the following diplomas to create a consultation for master: LICENCE, MASTER.']);
        }


        // Check if the user has already made a consultation for this filiere
        $existingConsultation = Consultation::where('candidat_id', $candidat->id)
            ->where('filiere_id', $filiere->id)
            ->first();
        if ($existingConsultation) {
            return redirect()->route('consultations.index')->withErrors(['error' => 'You have already made a consultation for this filiere.']);
        }

        // Check if the user has already made 3 consultations
        $consultationsCount = Consultation::where('candidat_id', $candidat->id)->count();
        if ($consultationsCount >= 3) {
            return redirect()->route('consultations.index')->withErrors(['error' => 'You have already made 3 consultations.']);
        }

        // Create and save the new consultation
        $consultation = new Consultation();
        $consultation->candidat_id = $candidat->id;
        $consultation->filiere_id = $filiere->id;
        $consultation->save();

        return redirect()->route('consultations.index');
    }


    public function valider(Consultation $consultation)
    {
        $consultation->verification = 'executer';
        $consultation->save();
        return redirect()->route('consultations.index');
    }

    public function rejeter(Consultation $consultation)
    {
        $consultation->verification = 'non executer';
        $consultation->save();
        return redirect()->route('consultations.index');
    }

    public function show(Consultation $consultation)
    {
        return view('consultations.show', compact('consultation'));
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('consultations.index');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('searchQuery');

        // i want to search by the consultation by the candidat name the candidat name is in the User table
        $consultations = Consultation::whereHas('candidat', function ($query) use ($searchQuery) {
            $query->whereHas('user', function ($query) use ($searchQuery) {
                $query->where('nom', 'like', "%$searchQuery%");
            });
        })->get();

        return view('consultations.index', compact('consultations'));
    }
}
