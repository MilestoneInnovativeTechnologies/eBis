// import { WidgetMaster,Widgets } from 'src/store/models/WidgetMaster'

export default ({ store }) => {
  //
  // let DWM_H = DATA_WIDGET_MASTER['HEADS'], DWM_V = DATA_WIDGET_MASTER['VALUES'], DWM = _.map(DWM_V,(ARY) => _.zipObject(DWM_H,ARY));
  // WidgetMaster.insert({ data:DWM }).then(null)
  //
  // let DWS_H = DATA_WIDGETS['HEADS'], DWS_V = DATA_WIDGETS['VALUES'], DWS = _.map(DWS_V,(ARY) => _.zipObject(DWS_H,ARY));
  // Widgets.insert({ data:DWS }).then(null)

  _.forEach(_.keys(store._actions),action => action.substr(-4) === 'init' ? store.dispatch(action) : null)
}
