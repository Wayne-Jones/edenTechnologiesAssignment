@extends('layouts.app')

@section('content')
    <canvas id="myChart" width="400" height="400"></canvas>
@endsection

@section('additionalScripts')
<?php 
$weekArr = [];
foreach($weekRanking as $weeks){
    array_push($weekArr, $weeks);
}
$rogerFedererRankArr = [];
foreach($rogerFedererRank as $ranks){
    array_push($rogerFedererRankArr, $ranks);
}
$raphaelNadalRankArr = [];
foreach($raphaelNadalRank as $ranks){
    array_push($raphaelNadalRankArr, $ranks);
}
$andyMurrayRankArr = [];
foreach($andyMurrayRank as $ranks){
    array_push($andyMurrayRankArr, $ranks);
}
$novakDjokoRankArr = [];
foreach($novakDjokoRank as $ranks){
    array_push($novakDjokoRankArr, $ranks);
}
?>
<script>
    var year = @json($weekArr);
    var roger_federer = @json($rogerFedererRankArr);
    var raphael_nadal = @json($raphaelNadalRankArr);
    var andy_murray = @json($andyMurrayRankArr);
    var novak_djoko = @json($novakDjokoRankArr);
    var data_viewer;

    var ctx = $('#myChart');
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Roger Federer',
            backgroundColor: 'transparent',
            data: roger_federer,
            borderColor: '#af92ee',
            pointBackgroundColor: '#af92ee'

        }, {
            label: 'Raphael Nadal',
            backgroundColor: 'transparent',
            data: raphael_nadal,
            borderColor: '#699ea3',
            pointBackgroundColor: '#699ea3'
        }, {
            label: 'Andy Murray',
            backgroundColor: 'transparent',
            data: andy_murray,
            borderColor: '#0fc796',
            pointBackgroundColor: '#0fc796'
        }, {
            label: 'Novak Djokovic',
            backgroundColor: 'transparent',
            data: novak_djoko,
            borderColor: '#bb030f',
            pointBackgroundColor: '#bb030f'
        }]
    };
    var myChart = new Chart(ctx, {
        type: 'line',
        data: barChartData,
        options: {
                elements: {
                    line: {
                        tension: '0',
                        borderCapStyle: 'round'
                    },
                    point:{
                        radius: 0
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Ranking of Top Tennis Stars'
                },
                scales: {
                   yAxes: [{
                       ticks: {
                           stepSize: 1,
                           reverse: true
                       }
                   }],
                   xAxes: [{
                        type: 'time',
                        time: {
                            displayFormats: {
                                week: 'YYYY-MM-DD'
                            }
                        },
                        distribution: 'series'
                    }]
                }
                
            }
    });
</script>
@endsection