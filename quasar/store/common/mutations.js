import Vue from 'vue'
export function HEADS(state,heads){
  let PROP = 'HEADS'
  if(!_.isArray(heads) && _.isObject(heads) && _.has(heads,'prop') && _.has(heads,'heads')){
    PROP = 'HEADS_' + heads.prop; heads = heads.heads;
  }
  state[PROP].splice(0)
  Array.prototype.push.apply(state[PROP],heads)
}
export function VALUES(state,values){
  if(!values) return; let PROP = 'DATA';
  if(!_.isArray(values) && _.isObject(values) && _.has(values,'prop') && _.has(values,'values')){
    PROP = values.prop; values = values.values;
  }
  if(!_.isArray(values) || !values.length) return;
  let { HEADS, DATA } = state; if(PROP !== 'DATA') HEADS = state['HEADS_' + PROP]
  _.forEach(values, VALUE => {
    let KEY = VALUE[0], data = _.zipObject(HEADS,VALUE);
    if(!_.has(DATA,KEY)) Vue.set(state[PROP],KEY,{});
    Vue.set(state[PROP],KEY,data);
  })
}
export function JSONIFY(state,KEY){
  if(!KEY) return; let PROP = 'DATA';
  if(_.isObject(KEY) && _.has(KEY,'prop') && _.has(KEY,'key')){
    PROP = KEY.prop; KEY = KEY.key;
  }
  _.forEach(state[PROP],(VALUE,ID) => {
    if(VALUE[KEY] && _.isString(VALUE[KEY])){
      try {
        let json = JSON.parse(VALUE[KEY]);
        Vue.set(state[PROP][ID],KEY,json);
      } catch(e) { }
    }
  })
}
