<template>
  <Head>
    <title>Каталог</title>
  </Head>

  <v-container>
    <v-row>
      <v-col cols="12">
        <h1 class="text-h3">Каталог</h1>
      </v-col>

      <ProductCard
        v-for="product in products"
        :product="product"
      />
    </v-row>
  </v-container>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ProductCard from '@/Components/ProductCard.vue'
import { defineOptions } from 'vue'
import { Head } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })
defineProps({ products: Array })
</script>