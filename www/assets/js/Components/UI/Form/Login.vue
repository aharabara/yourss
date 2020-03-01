<template>
  <div id="login-form">
    <div v-if="wrongCredentials">
      <b>Error</b>
      Your credentials are invalid.
    </div>
    <input
      v-model="email"
      type="email"
      placeholder="Email..."
    >
    <input
      v-model="password"
      type="password"
      placeholder="Password..."
    >
    <button
      type="submit"
      @click.prevent="login"
    >
      Log in
    </button>
  </div>
</template>

<script>

import AccountingService from "../../Application/Services/AccountingService";

export default {
  name: 'FormLogin',
  props: {},
  data() {
    return {
      email: "",
      password: "",
      wrongCredentials: false
    };
  },
  methods: {
    login() {
      const $vm = this;
      let username = $vm.email;
      let password = $vm.password;
      AccountingService.login(username, password)
        .then(function () {
          $vm.$router.replace("/feed");
        })
        .catch(function () {
          $vm.wrongCredentials = true;
          setTimeout(function () {
            $vm.wrongCredentials = false;
          }, 3000);
        });
    }
  }
};
</script>
