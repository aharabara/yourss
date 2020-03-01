<template>
  <div id="registration-form">
    <input
      :value="email"
      type="email"
    >
    <input
      :value="password"
      type="password"
      placeholder="Password..."
    >
    <input
      :value="repeatPassword"
      type="password"
      placeholder="Password repeat..."
    >
  </div>
</template>

<script>
export default {
  name: 'FormRegister',
  data() {
    return {
      email: null,
      password: null,
      repeatPassword: null,
    };
  },
};
</script>