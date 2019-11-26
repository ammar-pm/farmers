<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>



<script>
var trace1 = {
  name: 'Villa',
  x: [1997, 2007, 2017],
  y: [3398, 6754, 10110],
  type: '{{ $record->type }}'
};

var trace2 = {
  name: 'House',
  x: [1997, 2007, 2017],
  y: [259263, 311304, 363345],
  type: '{{ $record->type }}'
};

var trace3 = {
  name: 'Building',
  x: [1997, 2007, 2017],
  y: [42272, 80417, 118562],
  type: '{{ $record->type }}'
};

var trace4 = {
  name: 'Tent',
  x: [1997, 2007, 2017],
  y: [1474, 1452, 1452],
  type: '{{ $record->type }}'
};

var data = [trace1, trace2, trace3, trace4];

Plotly.newPlot('chart', data);
</script>