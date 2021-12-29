import Vue from 'vue'
import Vuex from 'vuex'
// import VuexORM from '@vuex-orm/core'

Vue.use(Vuex)

import * as actions from './actions'

import server from './server'
import widget from './widget'
import auth from './auth'

// import { WidgetMaster,Widgets } from './models/WidgetMaster'

// const database = new VuexORM.Database()
// database.register(WidgetMaster)
// database.register(Widgets)

export default new Vuex.Store({
  modules: {
    server, widget, auth
  },
  // plugins: [VuexORM.install(database, { namespace: 'db' })],
  actions,
  strict: process.env.DEV
})
