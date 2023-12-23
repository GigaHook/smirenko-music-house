<template>
  <Head>
    <title>
      {{ product.name }}
    </title>
  </Head>

  <v-container>
    <v-row justify="center">
      <v-col cols="6" xl="4">
        <v-img
          :src="'../storage/' + product.image"
          class="rounded"
          cover
        />
      </v-col>

      <v-col cols="6" xl="4">
        <h1 class="text-h4">
          {{ product.name }}
        </h1>

        {{ product.description }}

        <div class="text-h5">
          {{ product.price }}
          <v-icon
            icon="mdi-currency-rub"
            class="pb-1 ms-n2 my-3"
            size="24"
          />
        </div>

        <v-btn
          @click="increase"
          color="black"
          text="В корзину"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import useCartItem from '@/Composables/useCartItem'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { defineOptions } from 'vue'

defineOptions({ layout: AppLayout })

const { product } =  defineProps({ product: Object })
const { increase } = useCartItem(product)
</script>