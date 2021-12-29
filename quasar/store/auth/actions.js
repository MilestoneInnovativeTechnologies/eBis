export function init({ commit }){
  if(typeof DATA_AUTH !== undefined && _.has(DATA_AUTH,'HEADS')){
    let { HEADS,VALUES } = DATA_AUTH;
    commit('HEADS',HEADS); commit('VALUES',VALUES);
  }
}
