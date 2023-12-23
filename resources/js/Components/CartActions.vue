<template>
  <v-card-actions class="d-flex">
    <v-btn
      @click="decrease"
      variant="flat"
      color="black"
      icon="mdi-minus"
      size="36"
      rounded
    />  

    <v-sheet
      height="36"
      width="120"
      color="black"
      rounded
      class="ms-2 d-flex align-center justify-center text-h6"
    >
      {{ product.cart_item.quantity }}
    </v-sheet>

    <v-btn
      @click="increase"
      variant="flat"
      color="black"
      icon="mdi-plus"
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

    <v-btn
      @click="remove"
      variant="flat"
      color="black"
      icon="mdi-delete"
      size="36"
      rounded
    />  
  </v-card-actions>
</template>

<script setup>
import useCartItem from '@/Composables/useCartItem'

const { product } =  defineProps({ product: Object })
const { increase, decrease, remove } = useCartItem(product)
</script>