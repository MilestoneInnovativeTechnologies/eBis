export const ChartJSDimension = {
  props: ['width','height'],
  computed: {
    dimension(){
      let style = {};
      if(this.height) style['height'] = this.height + (_.isNumber(this.height) ? 'px' : '');
      if(this.width) style['width'] = this.width + (_.isNumber(this.width) ? 'px' : '');
      return style;
    }
  }
}
