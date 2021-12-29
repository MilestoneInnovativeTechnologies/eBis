<template>
  <VueChartJS type="bar" :options="chartOptions()" :data="chart_data" v-bind="chartProps()" />
</template>

<script>
import VueChartJS from "components/widget/VueChartJS";
import {ColorMixin} from "src/mixins/color";
import {ChartJSAttributes} from "src/mixins/chartjs_attributes";

export default {
  name: "SimpleBarChart",
  components: {VueChartJS},
  mixins: [ColorMixin,ChartJSAttributes],
  props: ['name','data','opacity'],
  data(){ return {
    default: {
      borderColor: this.colorRgb(1),
      backgroundColor: this.colorRgb(this.opacity || 0.6),
      barPercentage: 1,
      categoryPercentage: 0.9
    },
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
