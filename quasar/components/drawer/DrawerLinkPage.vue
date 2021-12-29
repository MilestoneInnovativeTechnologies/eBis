<template>
  <q-item :to="{ name: 'page', params: { id: a('id') } }">
    <q-item-section avatar><q-icon :name="a('icon')" /></q-item-section>
    <q-item-section>
      <q-item-label>{{ a('title') }}</q-item-label>
      <q-item-label caption lines="2">{{ a('details') }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
export default {
  name: "DrawerLinkPage",
  methods: {
    a(k) { return _.get(this.$attrs,k,'') }
  }
}
</script>
