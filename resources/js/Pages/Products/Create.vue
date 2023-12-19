<template>
  <Head>
    <title>
      {{ product?.name ? 'Изменить товар' : 'Добавить товар' }}
    </title>
  </Head>

	<v-container>
		<v-row justify="center">
			<v-col lg="6" xl="4">
				<v-card>
          <v-card-title>
            Добавить товар
          </v-card-title>
          
          <v-card-text>
            <v-form
              ref="form"
              @submit.prevent="submit"
              :readonly="formData.processing"
              validate-on="blur"
            >
              <v-text-field
                label="Название"
                v-model="formData.name"
                :rules="[rules.required, rules.range]"
              />
  
              <v-file-input
                label="Изображение"
                v-model="image"
                prepend-icon
                append-inner-icon="mdi-image-plus"
                accept="image/png, image/jpeg, image/jpg"
                :rules="[rules.image]"
                validate-on="input"
              />
  
              <v-textarea
                label="Описание"
                v-model="formData.description"
                :rules="[rules.required, rules.textarea]"
              />
              
              <v-text-field
                label="Цена"
                v-model="formData.price"
                v-mask="'########'"
                append-inner-icon="mdi-currency-rub"
                :rules="[rules.required, rules.range]"
              />

              <div class="d-flex justify-space-between">
                <v-btn
                  variant="flat"
                  type="submit"
                  color="black"
                  :text="product?.name ? 'Сохранить' : 'Добавить'"
                  :loading="formData.processing"
                />

                <v-btn
                  @click="cancel"
                  variant="text"
                  color="black"
                  text="Отмена"
                />
              </div>
            </v-form>
          </v-card-text>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router, Head } from '@inertiajs/vue3'
import { ref, defineOptions } from 'vue'

defineOptions({ layout: AppLayout })

const { product } = defineProps({ 
  product: {
    type: Object,
    required: false,
    default: {},
  },
})

const form = ref()
const image = ref()
const formData = useForm({
	name: product?.name ?? '',
	image: '',
	price: String(product?.price) ?? '',
	description: product?.description ?? '',
})

const rules = {
  required: v => !!v || 'Заполните это поле',
  range:    v => v?.length <= 50 || 'Слишком длинное значение',
  textarea: v => v?.length <= 750 || 'Слишком длинное значение',
  image:    v => !!product.name || v[0] || 'Заполните это поле',
}

function submit() {
	form.value.validate().then(() => {
		if (form.value.isValid) {
      if (image.value?.[0]) {
        formData.image = image.value[0]
      }

      if (!product.name) {
        formData.post(route('products.store'), {
          onSuccess: () => router.get(route('products'))
        })
      } else {
        router.post(route('products.update', product.id), {
          _method: 'patch',
          name: formData.name,
          image: formData.image,
          description: formData.description,
          price: formData.price,
        }, {
          forceFormData: true,
          onSuccess: () => router.get(route('products'))
        })
        //formData.patch(route('products.update', product.id), {
        //  forceFormData: true,
        //  onSuccess: () => router.get(route('products'))
        //})
      }
		}
	})
}

function cancel() {
  router.get(route('products'))
}
</script>