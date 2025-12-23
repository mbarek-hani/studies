<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function setData(Request $request)
    {
        // Via instance de requête
        $request->session()->put('user.name', 'John Doe');
        $request->session()->put('visit_count', 1);
        // Via helper session
        session(['user.email' => 'john@example.com']);
        return 'Données stockées dans la session.';
    }
    public function getData(Request $request)
    {
        // Récupération avec valeur par défaut
        $statut = $request->session()->get('status', 'inconnu');
        return "Statut: $statut";
    }
    public function getAll(Request $request)
    {
        $data = $request->session()->all();
        dd($data); // Dump pour afficher le tableau
    }
    public function checkHas(Request $request)
    {
        if ($request->session()->has('user.name')) {
            return 'La clé user.name existe et n\'est pas null.';
        }
        return 'La clé user.name n\'existe pas ou est null.';
    }
    public function checkExists(Request $request)
    {
        if ($request->session()->exists('user.name')) {
            return 'La clé user.name existe et n\'est pas null.';
        }
        return 'La clé user.name n\'existe pas ou est null.';
    }

    public function checkMissing(Request $request)
    {
        if ($request->session()->missing('user.age')) {
            return 'La clé user.age n\'existe pas ou est null.';
        }
        return 'La clé user.age existe et n\'est pas null.';
    }
    public function pushToArray(Request $request)
    {
        $request->session()->push('user.teams', 'Developers');
        $request->session()->push('user.teams', 'Designers');
        return 'Valeurs poussées dans user.teams.';
    }
    public function pullData(Request $request)
    {
        $name = $request->session()->pull('user.name', 'Inconnu');
        return "Nom retiré: $name";
    }
    public function incrementCount(Request $request)
    {
        $request->session()->increment('visit_count', 1);
        return $request->session()->get('visit_count');
    }
    public function flashData(Request $request)
    {
        $request->session()->flash('status', 'Tâche réussie !');
        return 'Données flash stockées.';
    }
    public function reflashData(Request $request)
    {
        $request->session()->reflash();
        return 'Flash reflashés.';
    }
    public function keepData(Request $request)
    {
        $request->session()->keep(['status']);
        return 'Flash spécifiques conservés.';
    }
    public function forgetData(Request $request)
    {
        $request->session()->forget('user.name');
        $request->session()->forget(['user.email', 'visit_count']);
        return 'Clés oubliées.';
    }
    public function flushData(Request $request)
    {
        $request->session()->flush();
        return 'Session vidée.';
    }
    public function regenerateId(Request $request)
    {
        $request->session()->regenerate();
        return 'ID de session régénéré.';
    }
    public function invalidateSession(Request $request)
    {
        $request->session()->invalidate();
        return 'Session invalidée.';
    }
}
