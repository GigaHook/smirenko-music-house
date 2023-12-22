<template>
  <Head>
    <title>Корзина</title>
  </Head>

  <v-container>
    <v-row>
      <v-col cols="12">
        <h1 class="text-h3">Корзина</h1>
      </v-col>

      <ProductCard
        v-for="product in cart.items"
        :product="product"
      >
        <v-card-actions class="d-flex justify-space-between">
          <v-btn
            
          />
        </v-card-actions>
      </ProductCard>
    </v-row>
  </v-container>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ProductCard from '@/Components/ProductCard.vue'
import { defineOptions, onMounted } from 'vue'
import { Head } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })
const { cart } = defineProps({ cart: Object })
onMounted(() => {
  console.log(cart);
})
</script>