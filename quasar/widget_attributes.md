### Global Options

**legend**
Type: _string_ or _boolean_
Example: `top center 12 bold #DDD 40`, `false`
If boolean false, no legend will be displayed
If boolean true, legend will be displayed with default/global settings
If string
All details to be separated by space. Each item is
Position: top,bottom,left,right
Align: start,center,end
fontSize: (integer number in pixels)
fontStyle: normal,bold
fontColor: #F00 (any hexa color code)
boxWidth: The box shown left to legend text.

**padding**
Type: _string_
Example: `0 0 0 0`
All details to be separated by space.
This is to set padding on a chart in the order
top right bottom left.

**title**
Type: _string_
Example: `eBis`
The text to be displayed as title of the chart

**titleProp**
Type: _string_
Example: `top 12 bold #DDD 10 1.2`
All details to be separated by space. Each item is
Position: top,bottom,left,right
fontSize: (integer number in pixels)
fontStyle: normal,bold
fontColor: #F00 (any hexa color code)
padding: (integer number) padding to all direction to be applied
lineHeight: line height of the title text.

**tooltip**
Type: _boolean_
Example: `true`, `false`
The details will be shown on the mouse hover over the chart

**mode**
Type: _string_
Example: `point`, `nearest`, `index`, `dataset`, `x`, `y`
What detail to be shown on the tooltip on the mouse hover
_https://www.chartjs.org/docs/latest/general/interactions/modes.html_

**xAxes**, **yAxes**
Type: _boolean_
Decides whether the x-axis or y-axis to be shown or not

**xMin**, **yMin**
Type: _number_
The minimum number to be started on corresponding axis

**xMax**, **yMax**
Type: _number_
The maximum number to be started on corresponding axis

**xZero**, **yZero**
Type: _boolean_
Whether the corresponding axis to be start from zero or not

**xTicks**, **yTicks**
Type: _number_
The number of steps/grid to be shown in corresponding axis

**xPrecision**, **yPrecision**
Type: _number_
The number precision digits to be rounded when any floating number comes on corresponding axis

**xStep**, **yStep**
Type: _number_
The number which describes the difference between each tick on corresponding axis

**xFormat**, **yFormat**
Type: _string_
The string which should be the return statement, which return the modified value for corresponding axis.
ex: `"value.substr(0,7) + '...'"`
Three arguments are made available, which are
`value` the value which is supposed to plot,
`index` the number starting from 0 which is the index of value in values,
`values` the array of value to be plotted

**width**, **height**
Type: _string_,_number_
If provided, the chart will be plotted in that corresponding dimension. Supports number, which will be converted in to px. Ex: `20` => 20px.
String supported which should be a number with its unit. Ex: `20%`,`100px`,`30vw`

**card**
Type: _boolean_
By default each chart metric will be displayed in a card until a value of `false` or `'false'` is passed

**heading**
Type: _string_
The heading will be shown as card title. This is only applicable if the chart is being display in a card.

### Simple Line Chart
data: `[{ name:'Mon',value:111 },{ name:'Tue',value:141 },{ name:'Wed',value:160 }]`
name: name of the value. `Ex: Payables`
color: color of the graph to be plotted. Supported formats: #F00, rgba, quasar color pallets.
###### Defaults
borderColor: color of the line
pointBackgroundColor: Color of the point of value
pointBorderColor: Color of the border of the point of value
`{"showLine": true, "borderWidth": "1", "lineTension": "0.4", "pointRadius": "2", "steppedLine": false, "pointBorderWidth": "2"}`
showLine: connecting lines from one point to another
lineTension: bezier curve, 0 for no curve, 1 for a maximum curve.
pointRadius: Radius of dots on each value(x,y)
pointBorderRadius: Radius of the border of dots on each value(x,y)
steppedLine: `true`,`false`,`'after'`,`'before'`,`'middle'`


### Simple Area Chart
(Same as Simple Line Chart)
`{ "fill":"origin" }`
fill: The filling of background. Supported values: `false`,`'origin'` from 0 to boundary, `'start'` from x-axis to boundary, `'end'` from top to boundary.

### Line Chart
data: `{"data": {"Sales": [{"label": "JAN", "value": 150}, {"label": "FEB", "value": 120}, {"label": "MAR", "value": 140}], "Revenue": [{"label": "JAN", "value": 15}, {"label": "FEB", "value": 24}, {"label": "MAR", "value": 19}], "Purchase": [{"label": "JAN", "value": 120}, {"label": "FEB", "value": 100}, {"label": "MAR", "value": 125}]}}`
colors: array of colors which is equal to number of data sets. Each color should be like hexa '#F00' or quasar pallet 'red-4' or rgb 'rgba(255,0,0,1)'
###### Attrs
`{"showLine": true, "borderWidth": "1", "lineTension": "0.4", "pointRadius": "2", "steppedLine": false, "pointBorderWidth": "2"}`
showLine: connecting lines from one point to another
lineTension: bezier curve, 0 for no curve, 1 for maximum curve
pointRadius: Radius of dots on each value(x,y)
pointBorderRadius: Radius of the border of dots on each value(x,y)
steppedLine: `true`,`false`,`'after'`,`'before'`,`'middle'`

### Area Chart
(SAME AS LINE CHART)

### Stacked Area Chart
(SAME AS AREA CHART)

### Simple Bar Chart, Simple Horizontal Bar Chart
data: `[{ name:'Mon',value:111 },{ name:'Tue',value:141 },{ name:'Wed',value:160 }]`
name: name of the value. `Ex: Payables`
color: color of the graph to be plotted. Supported formats: #F00, rgba, quasar color pallets.
###### Defaults
pointBorderColor: Color of the border of the point of value
backgroundColor: Color of the filled area,
borderColor: color of the line
pointBackgroundColor: Color of the point of value
`{ "barPercentage":0.8,"categoryPercentage":0.8 }`
barPercentage: `0 to 1`Percentage of width to be allocated for whole bars from available category width
categoryPercentage: `0 to 1` Percentage of width to be allocated for each bar section from available width

### Bar Chart, Horizontal Bar Chart
data: `{"data": {"Sales": [{"label": "JAN", "value": 150}, {"label": "FEB", "value": 120}, {"label": "MAR", "value": 140}], "Revenue": [{"label": "JAN", "value": 15}, {"label": "FEB", "value": 24}, {"label": "MAR", "value": 19}], "Purchase": [{"label": "JAN", "value": 120}, {"label": "FEB", "value": 100}, {"label": "MAR", "value": 125}]}}`
colors: array of colors which is equal to number of data sets. Each color should be like hexa '#F00' or quasar pallet 'red-4' or rgb 'rgba(255,0,0,1)'
invert: `true`,`false`. This will swap dataSetKeys and DataKeys each other.
###### Attrs
`{"barPercentage": 1, "categoryPercentage": 0.9 }`
barPercentage: `0 to 1` Percentage of width to be allocated for whole bars from available category width
categoryPercentage: `0 to 1` Percentage of width to be allocated for each bar section from available width

### Simple Pie Chart
data: `{"data": [{"name": "Monitor", "value": 3100}, {"name": "Mouse", "value": "920"}, {"name": "Keyboard", "value": 1520}]}`
###### Attrs
`{"borderColor": "#F00", "borderWidth": 1 }`
borderColor: Color of border in hex value or rgb value. Default `#FFF`
borderWidth: `1`. Integer in pixel. Default is 1

### Simple Doughnut Chart
(SAME AS SIMPLE PIE CHART)
###### Attrs
`{"semi": false }`
semi: `true`,`false`. Semi circle doughnut.
invert: `true`,`false`. This will swap dataSetKeys and DataKeys each other.

### Pie Chart
data: `{"data": {"Sales": [{"label": "JAN", "value": 150}, {"label": "FEB", "value": 120}, {"label": "MAR", "value": 140}], "Revenue": [{"label": "JAN", "value": 15}, {"label": "FEB", "value": 24}, {"label": "MAR", "value": 19}], "Purchase": [{"label": "JAN", "value": 120}, {"label": "FEB", "value": 100}, {"label": "MAR", "value": 125}]}}`
###### Attrs
(SAME AS SIMPLE PIE CHART)

### Doughnut Chart
data: `{"data": {"Sales": [{"label": "JAN", "value": 150}, {"label": "FEB", "value": 120}, {"label": "MAR", "value": 140}], "Revenue": [{"label": "JAN", "value": 15}, {"label": "FEB", "value": 24}, {"label": "MAR", "value": 19}], "Purchase": [{"label": "JAN", "value": 120}, {"label": "FEB", "value": 100}, {"label": "MAR", "value": 125}]}}`
###### Attrs
(SAME AS SIMPLE DOUGHNUT CHART)

### Polar Area Chart
(SAME AS SIMPLE PIE CHART)

### Radar Chart
data: `{"data": {"Sales": [{"label": "JAN", "value": 150}, {"label": "FEB", "value": 120}, {"label": "MAR", "value": 140}], "Revenue": [{"label": "JAN", "value": 15}, {"label": "FEB", "value": 24}, {"label": "MAR", "value": 19}], "Purchase": [{"label": "JAN", "value": 120}, {"label": "FEB", "value": 100}, {"label": "MAR", "value": 125}]}}`
###### Defaults
borderWidth: `1` Width of the border
lineTension: `0` Bezier curve, 0 for no curve, 1 for maximum curve
opacity: `0.1` Opacity of filling portion
