import { Model } from '@vuex-orm/core'

export class WidgetMaster extends Model {
  static entity = 'widget_masters'
  static fields() {
    return {
      id: this.number(null),
      component: this.string('').nullable(),
      name: this.string('').nullable(),
      attrs: this.string('').nullable()
    }
  }
  static mutators(){
    return {
      attrs(value){ return JSON.parse(value || '{}') }
    }
  }
}

export class Widgets extends Model {
  static entity = 'widgets'
  static fields() {
    return {
      id: this.number(null),
      name: this.string('').nullable(),
      attrs: this.string('').nullable(),
      component: this.string('').nullable(),
      type: this.number(0).nullable(),
    }
  }
  static mutators(){
    return {
      attrs(value){
        return value;
        console.log(value);
        return '-A-';
      }
    }
  }
}
