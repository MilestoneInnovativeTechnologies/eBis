export const ChartMixin = {
  props: ['data','options'],
  mounted(){ this.renderChart(this.data, this.options || {}) }
}
