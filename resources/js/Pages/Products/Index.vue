<template>
  <Head>
    <title>Каталог</title>
  </Head>

  <v-container>
    <v-row>
      <ProductCard
        v-for="product in products"
        :product="product"
      >
        <ProductActions :product="product"/>
      </ProductCard>
    </v-row>
  </v-container>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ProductCard from '@/Components/ProductCard.vue'
import ProductActions from '@/Components/ProductActions.vue'
import { defineOptions } from 'vue'
import { Head } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })
defineProps({ products: Array })
</script>