require('lodash')

const DWM_H = DATA_WIDGET_MASTER['HEADS'];
const DWM_D = DATA_WIDGET_MASTER['VALUES'];

export const WIDGET_MASTER =
  _(DWM_D)
  .mapKeys(ARY => _.toSafeInteger(ARY[0]))
  .mapValues(ARY => _.assign({},_.zipObject(DWM_H,ARY),{ attrs:JSON.parse(ARY[3] || '{}') }))
  .value();

const DWS_H = DATA_WIDGETS['HEADS'];
const DWS_D = DATA_WIDGETS['VALUES'];

export const WIDGETS =
  _(DWS_D)
    .filter(ARY => ARY[5] === 'Active')
    .mapKeys(ARY => _.toSafeInteger(ARY[0]))
    .mapValues(ARY => {
      let { name,attrs } = _.get(WIDGET_MASTER,_.toSafeInteger(ARY[2]));
      return _.assign(
        {},{ id: _.toSafeInteger(ARY[0]) },{ name: ARY[1], component: name },
        { attrs: _.assign({}, attrs, JSON.parse(ARY[3] || '{}')) }
        )
    }).value();

const DSC_H = DATA_SECTIONS['HEADS'];
const DSC_D = DATA_SECTIONS['VALUES'];

export const SECTIONS =
  _(DSC_D)
    .filter(ARY => ARY[4] === 'Active')
    .mapKeys(ARY => _.toSafeInteger(ARY[0]))
    .mapValues(ARY => {
      let widgets = JSON.parse(ARY[3] || '{}');
      return _.assign({},_.zipObject(DSC_H,ARY),{ widgets });
    }).value();

const DLY_H = DATA_LAYOUTS['HEADS'];
const DLY_D = DATA_LAYOUTS['VALUES'];

export const LAYOUTS =
  _(DLY_D)
    .filter(ARY => ARY[3] === 'Active')
    .mapKeys(ARY => _.toSafeInteger(ARY[0]))
    .mapValues(ARY => {
      let sections = _.map(JSON.parse(ARY[2] || '[]'),id => _.get(SECTIONS,_.toSafeInteger(id)));
      return _.assign({},_.zipObject(DLY_H,ARY),{ sections });
    }).value();

const DPG_H = DATA_PAGES['HEADS'];
const DPG_D = DATA_PAGES['VALUES'];

export const PAGES =
  _(DPG_D)
    .mapKeys(ARY => _.toSafeInteger(ARY[0]))
    .mapValues(ARY => {
      let layout = _.get(LAYOUTS,_.toSafeInteger(ARY[5]));
      return _.assign({},_.zipObject(DPG_H,ARY),{ layout },{ id:_.toSafeInteger(ARY[0]) });
    }).value();

const DC_V = DATA_COMPANY['VALUES'];

export const COMPANY =
  _(DC_V)
    .mapKeys(Ary => Ary[1])
    .mapValues(Ary => Ary[2])
    .value();

const DA_H = DATA_AUTH['HEADS'];
const DA_V = DATA_AUTH['VALUES'][0];

export const USER =  _.zipObject(DA_H,DA_V);

