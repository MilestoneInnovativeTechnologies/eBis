<template>
  <VueChartJS type="doughnut" :options="chart_options" :data="chart_data" v-bind="chartProps()" />
</template>

<script>
import VueChartJS from "components/widget/VueChartJS";
import {ColorMixin} from "src/mixins/color";
import {ChartJSAttributes} from "src/mixins/chartjs_attributes";

export default {
  name: "SimpleDoughnutChart",
  components: {VueChartJS},
  mixins: [ColorMixin,ChartJSAttributes],
  props: ['data','borderColor','borderWidth','semi'],
  computed: {
    names(){ return _.map(this.data,'name') },
    backgrounds(){ return _(this.names).map(name => this.getColor(_.indexOf(this.names,name),1)).value() },
    datasets(){ return [_.assign({},this.chartData(this.$attrs),_.zipObject(['borderColor','borderWidth','backgroundColor','data'],[this.borderColor || '#FFF',_.toNumber(this.borderWidth || 2),this.backgrounds,_.map(this.data,'value')]))] },
    chart_data(){ return {
      labels: this.names,
      datasets: this.datasets,
    } },
    chart_options(){ return this.semi ? _.assign({},this.chartOptions(this.$attrs),{ circumference: Math.PI,rotation: -Math.PI }) : this.chartOptions(this.$attrs) }
  }
}
</script>
