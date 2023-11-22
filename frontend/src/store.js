// store.js

import { createStore } from 'vuex';

export default createStore({
  state: {
    userId: null,
    userRole: null,
  },
  mutations: {
    setUserId(state, userId) {
      state.userId = userId;
      // Store the userId in localStorage
      localStorage.setItem('userId', userId);
    },
    setUserRole(state, userRole) {
      state.userRole = userRole;
      // Store the userRole in localStorage
      localStorage.setItem('userRole', userRole);
    },
  },
  actions: {
    init({ commit }) {
      const userId = localStorage.getItem('userId');
      const userRole = localStorage.getItem('userRole');
  
      if (userId) {
        commit('setUserId', userId);
      }
  
      if (userRole) {
        commit('setUserRole', userRole);
      }
    },
  },
  modules: {
    // Additional modules if needed
  },
});
