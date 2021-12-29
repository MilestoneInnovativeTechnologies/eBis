<template>
  <VueChartJS type="pie" :options="chart_options" :data="chart_data" v-bind="chartProps()" />
</template>

<script>
import VueChartJS from "components/widget/VueChartJS";
import {ColorMixin} from "src/mixins/color";
import {ChartJSAttributes} from "src/mixins/chartjs_attributes";
import {ChartJSInvert} from "src/mixins/chartjs_invert";

export default {
  name: "PieChart",
  components: {VueChartJS},
  mixins: [ColorMixin,ChartJSAttributes,ChartJSInvert],
  props: ['data','borderColor','borderWidth'],
  computed: {
    backgrounds(){ return _(this.names).map(name => this.getColor(_.indexOf(this.names,name),1)).value() },
    datasets(){ return _(this.iData).map((dataArray,name) => _.assign({},this.chartData(),_.zipObject(['borderColor','borderWidth','backgroundColor','data','label'],[this.borderColor || '#FFF',_.toNumber(this.borderWidth || 2),this.backgrounds,_.map(dataArray,'value'),name]))).value() },
    chart_data(){ return {
      labels: this.invert ? this.setKeys : this.dataKeys,
      datasets: this.datasets,
    } },
    chart_options(){ return this.chartOptions() }
  }
}
</script>
