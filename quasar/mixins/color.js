const { getBrand,hexToRgb,getPaletteColor } = require('quasar').colors
export const ColorMixin = {
  props: ['color','colors'],
  data(){ return {
    colorSet: ['primary','info','teal-4','indigo-12','cyan-5','deep-purple-13','blue-7','teal-9','deep-purple-9','purple-13'],
  } },
  methods: {
    colorRgb(opacity,color){
      let mColor = color || this.color;
      let hexColor = mColor ? (mColor.substr(0,1) === "#" ? mColor : getPaletteColor(mColor)) : getBrand('primary');
      return `rgba(${_.values(hexToRgb(hexColor)).join(',')},${opacity || 0.6})`;
    },
    getColor(idx, opacity){
      let color = (this.colors) ? (_.isArray(this.colors) ? this.colors[_.toSafeInteger(idx) % this.colors.length] : this.colors) : this.colorSet[_.toSafeInteger(idx) % this.colorSet.length];
      return this.colorRgb(opacity,color);
    }
  }
}
