<template>
  <v-card-actions>
    <v-btn
      @click="increase"
      variant="flat"
      color="black"
      icon="mdi-cart-plus"
      size="36"
      rounded
    />
    
    <v-btn
      @click="$inertia.get(route('products.show', product.id))"
      variant="flat"
      color="black"
      icon="mdi-dots-horizontal"
      size="36"
      rounded
    />  
  </v-card-actions>
</template>

<script setup>
import useCartItem from '@/Composables/useCartItem'

const { product } =  defineProps({ product: Object })
const { increase } = useCartItem(product)
</script>