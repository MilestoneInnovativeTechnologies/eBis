<template>
  <q-page padding>
    <div class="row q-col-gutter-xs q-mb-md" v-for="section in sections" :key="'page-' + id + '-section-' + section.id">
      <div class="col-12 text-weight-bold text-h6 q-mt-md" v-if="section.title">{{ section.title }}</div>
      <div v-for="(col,id) in section.widgets" :key="'page-' + id + '-section-' + section.id + '-widget-' + id" :class="'col-xs-12 col-sm-6 col-md-' + col">
        <component :is="component(id)" v-bind="attrs(id)" />
      </div>
    </div>
  </q-page>
</template>

<script>
import {PAGES} from "assets/assets";

export default {
  name: "Page",
  props: ['id'],
  computed: {
    title(){ return _.get(PAGES, [_.toSafeInteger(this.id), 'title']) },
    sections(){ return _.get(PAGES, [_.toSafeInteger(this.id), 'layout', 'sections']) },
    widgets(){ return this.$store.getters['widget/all'] },
  },
  methods: {
    component(id){
      let component = _.get(this.widgets,[_.toSafeInteger(id),'component'],null);
      return component ? require(`src/components/widget/${component}`).default : {};
    },
    attrs(id){
      return _.get(this.widgets,[_.toSafeInteger(id),'attrs'],{});
    }
  }
}
</script>
