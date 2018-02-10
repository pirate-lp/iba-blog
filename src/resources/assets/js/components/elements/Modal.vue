<template>
	<div class="modal" style="display: block;" @mousedown.stop="close()" @touchstart.stop="close()">
		<span class="close" v-on:click="close()">&times;</span>
		<div class="modal-content" style="z-index: 10;" @mousedown.stop @touchstart.stop>
			<slot></slot>
		</div>
	</div>
</template>

<script>
export default {
	methods: {
		close() {
			this.$emit('close')
		}
	},
	created() {
		document.body.style.overflow = "hidden"
	},
	destroyed() {
		document.body.style.overflow = "auto"
	},
}
</script>

<style>
</style>