<template>
  <VueChartJS type="line" :options="chartOptions()" :data="chart_data" v-bind="chartProps()" />
</template>

<script>
import VueChartJS from "components/widget/VueChartJS";
import {ColorMixin} from "src/mixins/color";
import {ChartJSAttributes} from "src/mixins/chartjs_attributes";

export default {
  name: "SimpleAreaChart",
  components: {VueChartJS},
  mixins: [ColorMixin,ChartJSAttributes],
  props: ['name','data'],
  data(){ return {
    default: {
      borderColor: this.colorRgb(1),
      pointBackgroundColor: this.colorRgb(0.6),
      pointBorderColor: this.colorRgb(0.6),
      backgroundColor: this.colorRgb(0.6),
      fill: true,
      showLine: true,
      borderWidth: 1,
      lineTension: 0.4,
      pointRadius: 2,
      steppedLine: false,
      pointBorderWidth: 2
    }
  } },
  computed: {
    labels(){ return _.map(this.data,'name') },
    values(){ return _.map(this.data,'value') },
    chart_data(){ return {
      labels: this.labels,
      datasets: [ _.assign({},this.default,this.chartData(),{ data: this.values, label: this.name }) ],
    } },
  }
}
</script>
