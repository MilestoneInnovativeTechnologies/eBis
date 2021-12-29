<script>
import {ChartMixin} from "src/mixins/chart";
const { Doughnut } = require('vue-chartjs')

export default {
  name: "VueChartJSDoughnut",
  extends: Doughnut,
  mixins: [ChartMixin]
}
</script>
