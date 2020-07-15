<?php

namespace App\Http\Controllers;

use App\MatchScores;
use App\Rankings;
use App\PlayerOverview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContentsController extends Controller
{
    public function datatables(){   
        return view('datatables');
    }

    public function loadDataTables(Request $request){
        $columns = array( 
            0 =>'tourney_slug',
            1 =>'tourney_round_name',
            2=> 'winner_name',
            3=> 'loser_name',
            4=> 'winner_seed',
            5=> 'loser_seed',
            6=> 'match_score_tiebreaks',
            7=> 'winner_games_won',
            8=> 'loser_games_won',
            9=> 'winner_tiebreaks_won',
            10=> 'loser_tiebreaks_won'
        );

        $totalData = MatchScores::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {            
        $matchScores = MatchScores::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $matchScores =  MatchScores::where('tourney_slug','LIKE',"%{$search}%")
                    ->orWhere('tourney_round_name', 'LIKE',"%{$search}%")
                    ->orWhere('winner_name', 'LIKE',"%{$search}%")
                    ->orWhere('loser_name', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = MatchScores::where('tourney_slug','LIKE',"%{$search}%")
                    ->orWhere('tourney_round_name', 'LIKE',"%{$search}%")
                    ->orWhere('winner_name', 'LIKE',"%{$search}%")
                    ->orWhere('loser_name', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($matchScores))
        {
        foreach ($matchScores as $matchScore)
        {
        $nameArr = explode("-", $matchScore->tourney_slug);
        $tournyName = implode(" ", $nameArr);
        $tournyNameFormatted = ucwords($tournyName, " ");

        $nestedData['tournamentName'] = $tournyNameFormatted;
        $nestedData['tournamentRound'] = $matchScore->tourney_round_name;
        $nestedData['winnerName'] = $matchScore->winner_name;
        $nestedData['loserName'] = $matchScore->loser_name;
        $nestedData['winnerSeed'] = $matchScore->winner_seed;
        $nestedData['loserSeed'] = $matchScore->loser_seed;
        $nestedData['matchScore'] = $matchScore->match_score_tiebreaks;
        $nestedData['winnerGamesWon'] = $matchScore->winner_games_won;
        $nestedData['loserGamesWon'] = $matchScore->loser_games_won;
        $nestedData['winnerTiebreaksWon'] = $matchScore->winner_tiebreaks_won;
        $nestedData['loserTiebreaksWon'] = $matchScore->loser_tiebreaks_won;
        // $nestedData['title'] = $post->title;
        // $nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
        // $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
        // $nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
        //                         &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";
        $data[] = $nestedData;

        }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );

        echo json_encode($json_data);
    }

    public function vis(){
        return view('vis');
    }

    public function chartjs(){ 

        $weekRanking = Rankings::select('week_title')
                                ->where('week_title', '>', '2016-01-01')
                                ->groupBy('week_title')
                                ->get()->toArray();
        $rogerFedererRank = Rankings::select('rank_number')
                                ->where('player_id', '=', 'f324')
                                ->where('week_title', '>', '2016-01-01')
                                ->get()->toArray();
        $raphaelNadalRank = Rankings::select('rank_number')
                                ->where('player_id', '=', 'n409')
                                ->where('week_title', '>', '2016-01-01')
                                ->get()->toArray();
        $andyMurrayRank = Rankings::select('rank_number')
                                ->where('player_id', '=', 'mc10')
                                ->where('week_title', '>', '2016-01-01')
                                ->get()->toArray();
        $novakDjokoRank = Rankings::select('rank_number')
                                ->where('player_id', '=', 'd643')
                                ->where('week_title', '>', '2016-01-01')
                                ->get()->toArray();
        // $weekRanking = Rankings::select('week_title')
        // ->where('week_title', '>', '1998-01-01')
        // ->groupBy('week_title')
        // ->get()->toArray();
        $weekRanking = array_column($weekRanking, 'week_title');
        $rogerFedererRank = array_column($rogerFedererRank, 'rank_number');
        $raphaelNadalRank = array_column($raphaelNadalRank, 'rank_number');
        $andyMurrayRank = array_column($andyMurrayRank, 'rank_number');
        $novakDjokoRank = array_column($novakDjokoRank, 'rank_number');



        return view('chartjs', ['weekRanking' => $weekRanking, 'rogerFedererRank' => $rogerFedererRank, 
                                'raphaelNadalRank' => $raphaelNadalRank, 'andyMurrayRank' => $andyMurrayRank, 'novakDjokoRank' => $novakDjokoRank ]);
    }
}