<script>
import {ChartMixin} from "src/mixins/chart";
const { Bar } = require('vue-chartjs')

export default {
  name: "VueChartJSBar",
  extends: Bar,
  mixins: [ChartMixin]
}
</script>
