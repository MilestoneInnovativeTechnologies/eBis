
const optionKeys = {
  legend: ['legend.position','legend.align','legend.labels.fontSize','legend.labels.fontStyle','legend.labels.fontColor','legend.labels.boxWidth'],
  padding: ['layout.padding.left','layout.padding.top','layout.padding.right','layout.padding.bottom'],
  title: 'title.text',
  titleProp: ['title.position','title.fontSize','title.fontStyle','title.fontColor','title.padding','title.lineHeight'],
  tooltip: 'tooltips.enabled',
  mode: 'tooltips.mode',
  xAxes: 'scales.xAxes.0.display', yAxes: 'scales.yAxes.0.display',
  xMin: 'scales.xAxes.0.ticks.suggestedMin', yMin: 'scales.yAxes.0.ticks.suggestedMin',
  xMax: 'scales.xAxes.0.ticks.suggestedMax', yMax: 'scales.yAxes.0.ticks.suggestedMax',
  xZero: 'scales.xAxes.0.ticks.beginAtZero', yZero: 'scales.yAxes.0.ticks.beginAtZero',
  xTicks: 'scales.xAxes.0.ticks.maxTicksLimit', yTicks: 'scales.yAxes.0.ticks.maxTicksLimit',
  xPrecision: 'scales.xAxes.0.ticks.precision', yPrecision: 'scales.yAxes.0.ticks.precision',
  xStep: 'scales.xAxes.0.ticks.stepSize', yStep: 'scales.yAxes.0.ticks.stepSize',
  xFormat: 'scales.xAxes.0.ticks.callback', yFormat: 'scales.yAxes.0.ticks.callback',
}

const optionKeysAlt = {
  legend: 'legend.display'
}

const existValues = {
  legend: ['legend',{ display: true }],
  title: ['title',{ display: true, position: 'bottom' }],
}

const defaultValues = {
  legend: ['top','center',12,'normal','#6D6D6D',40],
  padding: [0,0,0,0],
  titleProp: ['bottom',12,'normal','#6D6D6D',10,1.2]
}

const defaultOptions = {
  responsive: true,
  maintainAspectRatio: false,
}

const callbackKeys = ['xFormat','yFormat'];
const omitAttrs = ['card','heading','width','height']

export const ChartJSAttributes = {
  methods: {
    chartOptions(){
      return _.reduce(this.$attrs,function(opts,value,key){
        if(!_.has(optionKeys,key)) return opts;
        let optKey = _.get(optionKeys,key);
        if(_.has(existValues,key)) for(let i = 0; i < existValues[key].length; i+=2) _.set(opts,existValues[key][i],_.cloneDeep(existValues[key][i+1]))
        if(_.isArray(optKey)) {
          if(value.toString().indexOf(' ') === -1){
            _.set(opts,_.get(optionKeysAlt,key),value);
          } else {
            let valueParts = value.toString().split(' ');
            if(valueParts.length > optKey.length) {
              valueParts.splice(optKey.length-1,valueParts.length,valueParts.slice(optKey.length-1).join(' '));
            }
            _.forEach(optKey,function(oKey,idx){
              let oKeyValue = _.has(valueParts,idx) ? toNumIfNum(valueParts[idx]) : defaultValues[key][idx];
              _.set(opts,oKey,oKeyValue);
            })
          }
        } else if(_.includes(callbackKeys,key)) {
          let fn = new Function("value", "index", "values", `return ${value};`);
          _.set(opts,_.get(optionKeys,key),fn)
        } else _.set(opts,_.get(optionKeys,key),value)
        return opts;
      },_.cloneDeep(defaultOptions))
    },
    chartData(){
      let omit = _.concat(omitAttrs,_.keys(optionKeys))
      return _.omit(this.$attrs,omit);
    },
    chartProps(){
      return _.pick(this.$attrs,omitAttrs);
    },
  }
}

const toNumIfNum = function (txt){
  return _.isNaN(_.toNumber(txt)) ? txt : _.toNumber(txt);
}
