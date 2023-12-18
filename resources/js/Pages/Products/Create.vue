<template>
  
  
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
              :readonly="loading"
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
                  text="Добавить"
                  :loading="loading"
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

const loading = ref()
const form = ref()
const image = ref()
const formData = useForm({
	name: '',
	image: '',
	price: '',
	description: '',
})

const rules = {
  required: v => !!v || 'Заполните это поле',
  range: v => v?.length <= 50 || 'Слишком длинное значение',
  textarea: v => v?.length <= 750 || 'Слишком длинное значение',
  image: v => v[0] || 'Заполните это поле',
}

function submit() {
	form.value.validate().then(() => {
		if (form.value.isValid) {
			formData.image = image.value[0]
			formData.post(route('products.store'), {
				onStart: () => loading.value = true,
				onFinish: () => loading.value = false,
				onSuccess: () => router.get(route('products'))
			})
		}
	})
}

function cancel() {
  form.value.reset()
  router.get(route('products'))
}
</script>