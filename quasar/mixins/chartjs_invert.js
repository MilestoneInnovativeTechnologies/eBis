
export const ChartJSInvert = {
  props: ['invert'],
  computed: {
    dataKeys(){ return _.reduce(this.data,(labels,ary) => _.union(labels,_.map(ary,'label')),[]) },
    setKeys(){ return _.keys(this.data) },
    names(){ return this.invert ? this.dataKeys : this.setKeys },
    iData(){ return this.invert ? this.invertData(this.data,this.dataKeys,this.setKeys) : this.data },
  },
  methods: {
    invertData(data,setKeys,labels){
      let iData = {};
      _.forEach(setKeys,(setKey) => {
        if(!_.has(iData,setKey)) _.set(iData,setKey,[]);
        _.forEach(labels,(label) => {
          let value = _.get(_.find(data[label],['label',setKey]),'value');
          iData[setKey].push({ label,value })
        })
      });
      return iData;
    }
  }
}

const toNumIfNum = function (txt){
  return _.isNaN(_.toNumber(txt)) ? txt : _.toNumber(txt);
}
