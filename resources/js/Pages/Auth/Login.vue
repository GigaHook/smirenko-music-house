<template>
	<Head>
		<title>Вход в аккаунт</title>
	</Head>

  <v-container>
		<v-row justify="center">
			<v-col cols="12" lg="6" xl="4">
				<v-card>
					<v-card-title>
						Войти в аккаунт
					</v-card-title>
					
					<v-card-text>
						<v-form
							@submit.prevent="submit"
							ref="form"
							validate-on="blur"
							:readonly="formData.processing"
						>
							<v-text-field
								label="Логин"
								v-model="formData.login"
								prepend-inner-icon="mdi-account"
								:rules="[rules.required, rules.range]"
								:error-messages="formData.errors.login"
								@update:model-value="formData.clearErrors('login')"
							/>

							<v-text-field
								type="password"
								label="Пароль"
								v-model="formData.password"
								prepend-inner-icon="mdi-key"
								:rules="[rules.required, rules.range]"
								@update:model-value="formData.clearErrors('password')"
							/>

							<div class="d-flex">
								<v-btn
									variant="flat"
									type="submit"
									color="black"
									class="me-auto"
									text="Войти"
									:loading="formData.processing"
								/>
								
								<v-btn
									variant="text"
									@click="$inertia.get('register')"
									text="Нет аккаунта?"
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
import { ref, defineOptions, watch } from 'vue'
import { useForm, Head } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineOptions({ layout: AppLayout })

const rules = {
	required: v => !!v || 'Заполните это поле',
	range: v => v?.length < 50 || 'Слишком длинное значение',
}

const form = ref()
const formData = useForm({
	login: '',
	password: '',
})

function submit() {
	form.value.validate().then(() => {
		if (form.value.isValid) {
			formData.post(route('login'))
		}
	})
}
</script>
