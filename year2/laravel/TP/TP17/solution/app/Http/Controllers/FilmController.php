<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    public function seed()
    {
        DB::table("films")->insert([
            [
                "titre" => "Inception",
                "realisateur" => "Christopher Nolan",
                "annee" => 2010,
                "genre" => "Sci-Fi",
                "note" => 8.8,
                "votes" => 100,
                "updated_at" => now(),
            ],
            [
                "titre" => "The Matrix",
                "realisateur" => "Wachowski",
                "annee" => 1999,
                "genre" => "Action",
                "note" => 8.7,
                "votes" => 50,
                "updated_at" => now()->subDays(1),
            ],
            [
                "titre" => "Pulp Fiction",
                "realisateur" => "Quentin Tarantino",
                "annee" => 1994,
                "genre" => "Crime",
                "note" => 8.9,
                "votes" => 200,
                "updated_at" => now()->subMonth(),
            ],
            [
                "titre" => "Interstellar",
                "realisateur" => "Christopher Nolan",
                "annee" => 2014,
                "genre" => "Sci-Fi",
                "note" => 8.6,
                "votes" => 150,
                "updated_at" => null,
            ],
            [
                "titre" => "Dune",
                "realisateur" => "Denis Villeneuve",
                "annee" => 2021,
                "genre" => "Sci-Fi",
                "note" => 8.0,
                "votes" => 80,
                "updated_at" => now(),
            ],
        ]);
        return response()->json(["message" => "Données insérées"]);
    }

    function selectAll()
    {
        $films = DB::table("films")->get();
        // foreach ($films as $film) {
        //     echo $film->titre;
        // }
        return response()->json($films);
    }

    function first()
    {
        $film = DB::table("films")->where("titre", "Inception")->first();
        return response()->json($film ? $film->realisateur : null);
    }
    public function value()
    {
        $note = DB::table("films")->where("titre", "Inception")->value("note");
        return response()->json($note);
    }
    public function find()
    {
        $film = DB::table("films")->find(1);
        return response()->json($film);
    }
    public function pluck()
    {
        $titres = DB::table("films")->pluck("titre");
        foreach ($titres as $titre) {
            echo $titre;
        }
        return response()->json($titres);
    }
    public function pluckKey()
    {
        $titres = DB::table("films")->pluck("titre", "realisateur");
        // foreach ($titres as $realisateur => $titre) {
        //     echo $realisateur . "=>" . $titre;
        // }
        return response()->json($titres);
    }
    public function chunk()
    {
        DB::table("films")
            ->orderBy("id")
            ->chunk(2, function ($films) {
                echo "============Begin chunk============" . "<br>";
                foreach ($films as $film) {
                    echo $film->titre . "<br>";
                }
                echo "============End chunk============" . "<br>";
            });
        // return response()->json(["message" => "Chunk exécuté"]);
    }
    public function chunkStop()
    {
        DB::table("films")
            ->orderBy("id")
            ->chunk(2, function ($films) {
                // Traitement
                echo "============Begin chunk============" . "<br>";
                foreach ($films as $film) {
                    echo $film->titre . "<br>";
                }
                echo "============End chunk============" . "<br>";
                return false;
            });
        // return response()->json(["message" => "Chunk arrêté"]);
    }
    public function lazy()
    {
        DB::table("films")
            ->orderBy("id")
            ->lazy()
            ->each(function ($film) {
                // Traitement
            });
        return response()->json(["message" => "Lazy exécuté"]);
    }
    public function lazyById()
    {
        DB::table("films")
            ->where("votes", "<", 100)
            ->lazyById()
            ->each(function ($film) {
                DB::table("films")
                    ->where("id", $film->id)
                    ->update(["votes" => 100]);
            });
        return response()->json(["message" => "LazyById exécuté"]);
    }
    public function aggregates()
    {
        $count = DB::table("films")->count();
        $maxNote = DB::table("films")->max("note");
        $avgNote = DB::table("films")->avg("note");
        $sumVotes = DB::table("films")->sum("votes");
        $minAnnee = DB::table("films")->min("annee");
        return response()->json([
            "count" => $count,
            "max" => $maxNote,
            "avg" => $avgNote,
            "sum" => $sumVotes,
            "min" => $minAnnee,
        ]);
    }
    public function exists()
    {
        $hasHighNote = DB::table("films")->where("note", ">", 8.5)->exists();
        $noLowNote = DB::table("films")->where("note", "<", 5.0)->doesntExist();
        return response()->json([
            "hasHighNote" => $hasHighNote,
            "noLowNote" => $noLowNote,
        ]);
    }
    public function selectColumns()
    {
        $films = DB::table("films")
            ->select(
                "titre",
                'realisateur as
    realisateur_film',
            )
            ->get();
        return response()->json($films);
    }
    public function raw()
    {
        $counts = DB::table("films")
            ->select(
                DB::raw('count(*) as film_count,
    genre'),
            )
            ->groupBy("genre")
            ->get();
        return response()->json($counts);
    }

    public function join()
    {
        $result = DB::table("films")
            ->join("acteurs", "films.id", "=", "acteurs.film_id")
            ->select("films.*", "acteurs.nom")
            ->get();
        return response()->json($result);
    }
    public function leftRightJoin()
    {
        $left = DB::table("films")
            ->leftJoin("acteurs", "films.id", "=", "acteurs.film_id")
            ->get();
        $right = DB::table("films")
            ->rightJoin("acteurs", "films.id", "=", "acteurs.film_id")
            ->get();
        return response()->json(["left" => $left, "right" => $right]);
    }
    public function union()
    {
        $first = DB::table("films")->whereNull("updated_at");
        $films = DB::table("films")
            ->where("annee", ">", 2010)
            ->union($first)
            ->get();
        return response()->json($films);
    }
    public function where()
    {
        $films = DB::table("films")
            ->where("votes", "=", 100)
            ->where("annee", ">", 2000)
            ->get();
        // Ou avec tableau : ->where([['votes', '=', 100], ['annee', '>', 2000]])
        return response()->json($films);
    }
}
