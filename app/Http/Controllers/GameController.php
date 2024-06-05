<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    private $choices = ['rock', 'paper', 'scissors', 'lizard', 'spock'];

    private $results = [
        'rock' => ['scissors' => 'win', 'lizard' => 'win', 'rock' => 'draw', 'paper' => 'lose', 'spock' => 'lose'],
        'paper' => ['rock' => 'win', 'spock' => 'win', 'paper' => 'draw', 'scissors' => 'lose', 'lizard' => 'lose'],
        'scissors' => ['paper' => 'win', 'lizard' => 'win', 'scissors' => 'draw', 'rock' => 'lose', 'spock' => 'lose'],
        'lizard' => ['spock' => 'win', 'paper' => 'win', 'lizard' => 'draw', 'rock' => 'lose', 'scissors' => 'lose'],
        'spock' => ['scissors' => 'win', 'rock' => 'win', 'spock' => 'draw', 'paper' => 'lose', 'lizard' => 'lose'],
    ];

    public function play(Request $request)
    {
        $userChoice = $request->input('choice');
        if (!in_array($userChoice, $this->choices)) {
            return response()->json(['error' => 'Invalid choice'], 400);
        }

        $computerChoice = $this->choices[array_rand($this->choices)];
        $result = $this->results[$userChoice][$computerChoice];

        return response()->json([
            'user_choice' => $userChoice,
            'computer_choice' => $computerChoice,
            'result' => $result
        ]);
    }
}