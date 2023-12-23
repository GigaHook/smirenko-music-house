<template>
  <Head>
    <title>Корзина</title>
  </Head>

  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-text class="d-flex align-center">
            Всего {{ cart.totalItems }} предметов,
            на  общую стоимость {{ cart.total }} 
            <v-icon
              icon="mdi-currency-rub"
              size="16"
              class="me-auto"
            />
            
            <v-btn
              @click="$inertia.get(route('cart.clear'))"
              variant="flat"
              color="black"
              icon="mdi-cart-remove"
              size="36"
              class="me-2"
              rounded
              :disabled="cart.items.length < 1"
            />

            <v-btn
              @click="$inertia.get(route('orders.create'))"
              variant="flat"
              color="black"
              text="Оформить заказ"
              :disabled="cart.items.length < 1"
            />
          </v-card-text>
        </v-card>
      </v-col>

      <ProductCard
        v-for="product in cart.items"
        :product="product"
      >
        <CartActions :product="product"/>
      </ProductCard>
    </v-row>
  </v-container>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ProductCard from '@/Components/ProductCard.vue'
import CartActions from '@/Components/CartActions.vue'
import { defineOptions, onMounted } from 'vue'
import { Head } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })
const { cart } = defineProps({ cart: Object })
onMounted(() => {
  console.log(cart);
})
</script>