<template>
  <v-btn outlined color :href="href">
    <slot />
  </v-btn>
</template>

<script>
  export default {
    name: 'ButtonLink',
    props: {
      href: {
        type: [String, Boolean],
        default: false
      },
    },
  }
</script>

<style lang="scss" scoped>

</style>