<script>
import {ChartMixin} from "src/mixins/chart";
const { Pie } = require('vue-chartjs')

export default {
  name: "VueChartJSPie",
  extends: Pie,
  mixins: [ChartMixin]
}
</script>
