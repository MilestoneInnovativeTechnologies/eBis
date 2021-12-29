<template>
  <q-page padding>
    <div class="row">
      <div class="col-3 q-px-xs"><DigitMetric bg="green" value="47" text="white" title="Sales" icon="shopping_cart" /></div>
      <div class="col-3 q-px-xs"><DigitMetric bg="blue" value="54" text="white" title="Purchase" icon="publish" /></div>
      <div class="col-3 q-px-xs"><DigitMetric bg="red" value="65" text="white" title="Receivable" icon="zoom_out_map" /></div>
      <div class="col-3 q-px-xs"><DigitMetric bg="purple" value="14" text="white" title="Payable" icon="refresh" /></div>
    </div>
    <div class="row">
      <div class="col-6">
        <Progress :value="32" title="Opened" color="deep-orange" />
        <Progress :value="62" title="Active" color="brown" />
        <Progress :value="58" title="Closed" color="grey" />
      </div>
      <div class="col-6">
        <Progress :value="67" title="Dismissed" color="yellow" />
        <Progress :value="56" title="Approved" color="lime" />
        <Progress :value="93" title="Rejected" color="deep-purple" />
      </div>
    </div>
    <div class="row q-my-md">
      <div class="col-2"><CircularProgress :value="32" title="Cash in hand" color="indigo" /></div>
      <div class="col-2"><CircularProgress :value="54" title="Monthly Income" color="purple" /></div>
      <div class="col-2"><CircularProgress :value="20" title="Out gone vehicles" color="teal" /></div>
      <div class="col-2"><CircularProgress :value="69" title="Present members" color="pink" /></div>
      <div class="col-2"><CircularProgress :value="56" title="Online activities" color="cyan" /></div>
      <div class="col-2"><CircularProgress :value="87" title="Blocked sites" color="amber" /></div>
    </div>
    <div class="row q-my-md">
      <div class="col-6">
        <Progress :value="32" label="Cash in hand" color="indigo" />
        <Progress :value="54" label="Monthly Income" color="purple" />
        <Progress :value="20" label="Out gone vehicles" color="teal" />
      </div>
      <div class="col-6">
        <Progress :value="69" label="Present members" color="pink" />
        <Progress :value="56" label="Online activities" color="cyan" />
        <Progress :value="87" label="Blocked sites" color="amber" />
      </div>
    </div>
    <div class="row q-my-sm">
      <div class="col-4 q-px-xs"><DetailMetric value="$23,567.00" detail="32% increase in current month" color="teal" progress="32" title="Sales" icon="shopping_cart" /></div>
      <div class="col-4 q-px-xs"><DetailMetric value="$12,52.00" detail="54% increase in current month" color="lime" progress="64" title="Purchase" icon="shop_two" /></div>
      <div class="col-4 q-px-xs"><DetailMetric value="$93,7.00" detail="81% increase in current month" color="indigo" progress="96" title="Depreciation" icon="add_to_home_screen" /></div>
    </div>
    <div class="row q-my-sm">
      <div class="col-3"><SummaryBlock right="69" title="Today Total Sale" value="3654687" /></div>
      <div class="col-3"><SummaryBlock down="57" title="Today Total Sale" value="3655277" /></div>
      <div class="col-3"><SummaryBlock left="35" title="Today Total Sale" value="8236894" /></div>
      <div class="col-3"><SummaryBlock up="65" title="Today Total Sale" value="4574045" /></div>
    </div>
    <div class="row q-my-sm">
      <div class="col-3 q-px-sm"><SimpleMetric :shadow="false" bordered value="2568" caption="Outgoing" icon="shopping_cart" /></div>
      <div class="col-3 q-px-sm"><SimpleMetric :shadow="false" bordered value="6565" caption="Sales" icon="redo" /></div>
      <div class="col-3 q-px-sm"><SimpleMetric :shadow="false" bordered value="5984" caption="Purchases" icon="launch" /></div>
      <div class="col-3 q-px-sm"><SimpleMetric :shadow="false" bordered value="4397" caption="Carry forward" icon="system_update" /></div>
    </div>
  </q-page>
</template>

<script>
import DigitMetric from "components/widget/DigitMetric";
import SummaryBlock from "components/widget/SummaryBlock";
import SimpleMetric from "components/widget/SimpleMetric";
import Progress from "components/widget/Progress";
import CircularProgress from "components/widget/CircularProgress";
import DetailMetric from "components/widget/DetailMetric";
export default {
  name: 'AllMetrics',
  components: {DetailMetric, CircularProgress, Progress, SimpleMetric, SummaryBlock, DigitMetric},
  computed: {
    widgets(){ return this.$store.getters["widget/all"] },
    cls(){ return ['col-'+(12/_.size(this.widgets))] }
  }
}
</script>
