import { WIDGETS } from "src/assets/assets"

export function all({ DATA }){
  return _(DATA)
    .filter(({ status,widget }) => status === 'Active' && _.has(WIDGETS,_.toSafeInteger(widget)))
    .mapValues((record) => {
      let rAttrs = _.get(record,'attrs',{}), widget = _.toSafeInteger(_.get(record,'widget',null));
      let { id,component,attrs,name } = _.get(WIDGETS,widget,{});
      return _.assign({},{ id,component,name },{ attrs: _.assign({},attrs,rAttrs) })
    }).mapKeys('id').value();
}
