<template>
  <v-card-actions class="d-flex justify-space-between">
    <v-btn
      @click="increase"
      variant="flat"
      color="black"
      text="В корзину"
    />
    
    <v-btn
      @click="$inertia.get(route('products.show', product.id))"
      text="Подробнее"
    />  
  </v-card-actions>
</template>

<script setup>
import useCartItem from '@/Composables/useCartItem'

const { product } =  defineProps({ product: Object })
const { increase } = useCartItem(product)
</script>