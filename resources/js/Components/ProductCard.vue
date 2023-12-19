<template>
  <v-col md="4" lg="3" xl="2">
		<v-card>
      <v-img
        :src="'storage/' + product.image"
        class="w-100"
        style="aspect-ratio: 1 / 1;"
        cover
      >
        <div
          v-if="$page.props.user?.is_admin == 1"
          class="d-flex justify-end"
        >
          <v-btn
            class="ma-1"
            icon="mdi-pencil"
            @click="$inertia.get(route('products.edit', product.id))"
          />

          <v-btn
            class="ma-1"
            icon
          >
            <v-icon icon="mdi-delete"/>
            <Modal
              title="Внимание"
              text="Вы действительно хотите удалить этот продукт?"
              confirm-text="Да"
              @confirm="$inertia.delete(route('products.destroy', product.id))"
            />
          </v-btn>
        </div>
      </v-img>

      <v-card-title>
        {{ product.name }} <br>
      </v-card-title>

      <v-card-text>
        {{ product.price }} 
        <v-icon icon="mdi-currency-rub" size="16" class="ms-n1 pb-1"/>
      </v-card-text>

      <slot/>
    </v-card>
	</v-col>
</template>

<script setup>
import Modal from '@/Components/Modal.vue'

defineProps({
  product: Object,
})
</script>