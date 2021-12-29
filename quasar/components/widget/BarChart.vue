<template>
  <VueChartJS type="bar" :options="chart_options" :data="chart_data" v-bind="chartProps()" />
</template>

<script>
import VueChartJS from "components/widget/VueChartJS";
import {ColorMixin} from "src/mixins/color";
import {ChartJSAttributes} from "src/mixins/chartjs_attributes";
import {ChartJSInvert} from "src/mixins/chartjs_invert";

export default {
  name: "BarChart",
  components: {VueChartJS},
  mixins: [ColorMixin,ChartJSAttributes,ChartJSInvert],
  props: ['data','opacity'],
  data(){ return {
    attrs: {
      barPercentage: 1,
      categoryPercentage: 0.9
    }
  } },
  computed: {
    datasets(){ return _(this.iData).map((dataArray,name) => _.assign({},this.attrs,this.chartData(),_.zipObject(['label','borderColor','backgroundColor','data'],[name,this.getColor(_.indexOf(this.names,name),1),this.getColor(_.indexOf(this.names,name),this.opacity || 0.7),_.map(dataArray,'value')]))).value() },
    chart_data(){ return {
      labels: this.invert ? this.setKeys : this.dataKeys,
      datasets: this.datasets,
    } },
    chart_options(){ return this.chartOptions() }
  }
}
</script>
