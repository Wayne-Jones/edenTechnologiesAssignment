@extends('layouts.app')

@section('content')
    <table id="matchScores" class="table">
        <thead>
            <tr>
                <th>Tournament Name</th>
                <th>Tournament Round</th>
                <th>Winner Name</th>
                <th>Loser Name</th>
                <th>Winner Seed</th>
                <th>Loser Seed</th>
                <th>Match Score - Tiebreaks</th>
                <th>Winner Games Won</th>
                <th>Loser Games Won</th>
                <th>Winner Tiebreaks Won</th>
                <th>Loser Tiebreaks Won</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
@endsection

@section('additionalScripts')
<script>
    $(document).ready( function () {
        $('#matchScores').DataTable({
                "serverSide": true,
                "processing": true,
                "stateSave": true,
                "pagingType": "full_numbers",
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "ajax":{
                    "url": "{{ url('datatables') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "tournamentName" },
                    { "data": "tournamentRound" },
                    { "data": "winnerName" },
                    { "data": "loserName" },
                    { "data": "winnerSeed" },
                    { "data": "loserSeed" },
                    { "data": "matchScore" },
                    { "data": "winnerGamesWon" },
                    { "data": "loserGamesWon" },
                    { "data": "winnerTiebreaksWon" },
                    { "data": "loserTiebreaksWon" }
            ]	 
        });
    });
</script>    
@endsection