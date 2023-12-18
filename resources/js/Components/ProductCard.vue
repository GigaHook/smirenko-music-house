<template>
  <v-col md="4" lg="3">
		<v-card>
      <v-img :src="'storage/' + product.image" class="w-100" cover/>

      <v-card-title>
        {{ product.name }} <br>
        {{ product.price }} 
        <v-icon icon="mdi-currency-rub" size="24" class="ms-n2 pb-1"/>
      </v-card-title>

      <v-card-actions>
        <slot />
      </v-card-actions>
    </v-card>
	</v-col>
</template>

<script setup>
defineProps({
  product: Object,
})
</script>