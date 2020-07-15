@extends('layouts.app')

@section('content')
<div id="visualization"></div>
@endsection

@section('additionalScripts')
<>
<script>
    var container = $('#visualization');
    var items = [
    {x: '20-25', y: 22.92, group: 0},
    {x: '26-30', y: 29.9, group: 0},
    {x: '31-35', y: 31.43, group: 0},
    {x: '36-40', y: 34.9, group: 0},
    {x: '41-45', y: 36.05, group: 0},
    {x: '46-50', y: 36.57, group: 0},
    {x: '51-55', y: 37.19, group: 0},
    {x: '56-60', y: 36.57, group: 0},
    {x: '61-65', y: 34.91, group: 0},
    {x: '66-70', y: 33.09, group: 0},
    {x: 'Over 70', y: 30.8, group: 0},
    {x: 'Under 20', y: 15.76, group: 0},

    {x: '20-25', y: 26.3, group: 1},
    {x: '26-30', y: 31.64, group: 1},
    {x: '31-35', y: 35.54, group: 1},
    {x: '36-40', y: 37.1, group: 1},
    {x: '41-45', y: 39.28, group: 1},
    {x: '46-50', y: 40.38, group: 1},
    {x: '51-55', y: 41.39, group: 1},
    {x: '56-60', y: 40.66, group: 1},
    {x: '61-65', y: 40.67, group: 1},
    {x: '66-70', y: 40.82, group: 1},
    {x: 'Over 70', y: 34.52, group: 1},
    {x: 'Under 20', y: 13.43, group: 1},

    {x: '20-25', y: 25.32, group: 2},
    {x: '26-30', y: 31.06, group: 2},
    {x: '31-35', y: 34.08, group: 2},
    {x: '36-40', y: 36.35, group: 2},
    {x: '41-45', y: 38.19, group: 2},
    {x: '46-50', y: 39.01, group: 2},
    {x: '51-55', y: 39.77, group: 2},
    {x: '56-60', y: 39.1, group: 2},
    {x: '61-65', y: 38.28, group: 2},
    {x: '66-70', y: 38, group: 2},
    {x: 'Over 70', y: 33.42, group: 2},
    {x: 'Under 20', y: 14.59, group: 2}
  ];

  var dataset = new vis.DataSet(items);

  var options = {
        width:  '100%',
        height: '400px',
        style: 'surface'
    };
    
  var graph2d = new vis.Graph2d(container, dataset, options);
</script>
@endsection