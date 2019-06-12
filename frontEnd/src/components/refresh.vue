<template>
	<div></div>
</template>
<script>
export default {
  created() {
    console.log('in refresh')
    console.log(this.$route.query)
    if (this.$route.query.name) {
      if (this.$route.query.item) {
        router.replace({ name: this.$route.query.name, params: { item: this.$route.query.item }})
      } else {
        router.replace({ name: this.$route.query.name })
      }
    } else {
      console.log('refresh fail')
    }
  }
}
</script>
