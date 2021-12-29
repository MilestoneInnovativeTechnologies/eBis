<template>
  <Page :id="1" />
</template>

<script>
import Page from "./Page";
import {PAGES} from "assets/assets";

export default {
  name: "Index",
  components: { Page },
  data(){ return {
    id: 1
  } },
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
