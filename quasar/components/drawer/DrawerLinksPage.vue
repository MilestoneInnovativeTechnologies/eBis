<template>
  <q-list>
    <q-item-label header>PAGES</q-item-label>
    <DrawerLinkPage v-for="page in PAGES" :key="'drawer-link-page-' + page.id" v-bind="page" />
  </q-list>
</template>

<script>
import {PAGES} from "assets/assets";
import DrawerLinkPage from "components/drawer/DrawerLinkPage";

export default {
  name: "DrawerLinksPage",
  components: {DrawerLinkPage},
  data(){ return { PAGES } }
}
</script>
