<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn v-if="pageCount > 1" flat dense round icon="menu" aria-label="Menu" @click="leftDrawerOpen = !leftDrawerOpen"/>
        <div class="q-ml-md q-mr-xl">{{ COMPANY.name }}</div>
        <q-space />
        <q-btn round flat>
          <q-avatar size="32px">
            <img :src="'https://ui-avatars.com/api/?name='+USER.name+'&rounded=true&bold=true&size=32&background=FFFFFF&color=1976d2'">
          </q-avatar>
          <q-menu auto-close :offset="[110, 0]">
            <q-list style="min-width: 150px">
              <q-item>
                <q-item-section>
                  <q-item-label lines="1">{{ USER.name }}</q-item-label>
                  <q-item-label caption>{{ USER.email }}</q-item-label>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item>
                <q-item-section>
                  <q-item-label lines="1">Subscription</q-item-label>
                  <q-item-label caption>Package: {{ COMPANY.package }}</q-item-label>
                  <q-item-label caption>Expires: {{ COMPANY.end }}</q-item-label>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item clickable @click="logout">
                <q-item-section avatar>
                  <q-avatar rounded icon="logout"></q-avatar>
                </q-item-section>
                <q-item-section>Logout</q-item-section>
              </q-item>
            </q-list>
          </q-menu>
        </q-btn>
      </q-toolbar>
    </q-header>

    <q-drawer v-if="pageCount > 1" v-model="leftDrawerOpen" show-if-above bordered content-class="bg-grey-1">
      <DrawerLinksPage />
    </q-drawer>

    <q-page-container>
      <transition appear enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
        <router-view />
      </transition>
    </q-page-container>
  </q-layout>
</template>

<script>
import DrawerLinksPage from "components/drawer/DrawerLinksPage";
import {PAGES,COMPANY,USER} from "assets/assets";
export default {
  name: 'DashboardLayout',
  components: {DrawerLinksPage},
  data () {
    return {
      COMPANY, USER,
      leftDrawerOpen: false,
      pageCount: Object.keys(PAGES).length
    }
  },
  methods: {
    logout(){ location.href = LOGOUT }
  }
}
</script>
