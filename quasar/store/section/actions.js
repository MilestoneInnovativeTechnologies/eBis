export function init({ commit }){
  let DATA = DATA_SECTIONS;
  if(typeof DATA !== undefined && _.has(DATA,'HEADS')){
    let { HEADS,VALUES } = DATA;
    commit('HEADS',HEADS); commit('VALUES',VALUES); commit('JSONIFY','widgets');
  }
}
