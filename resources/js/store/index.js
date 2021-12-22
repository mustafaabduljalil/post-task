import Vue from 'vue/dist/vue'
import Vuex from 'vuex';
Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';
export default new Vuex.Store({
  state: {
    posts: [],
  },

  actions: {
    async getPosts({ commit }) {
      return commit('setPosts', await api.get('/posts'))
    },
  },

  mutations: {
    setPosts(state, response) {
      state.posts = response.data.data;
    },
  },
  strict: debug
});
