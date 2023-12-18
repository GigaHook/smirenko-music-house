<template>
  <v-container>
		<v-row justify="center">
			<v-col cols="12" lg="6" xl="4">
				<v-card>
					<v-card-title>
						Регистрация
					</v-card-title>
					
					<v-card-text>
						<v-form
							@submit.prevent="submit"
							ref="form"
							validate-on="blur"
							:readonly="loading"
						>
							<v-text-field
								label="Имя"
								v-model="formData.name"
								:rules="[rules.required, rules.range]"
							/>

							<v-text-field
								label="Фамилия"
								v-model="formData.surname"
								:rules="[rules.required, rules.range]"
							/>

							<v-text-field
								label="Отчество"
								v-model="formData.patronymic"
								:rules="[rules.range]"
							/>

							<v-text-field
								label="Логин"
								v-model="formData.login"
								:rules="[rules.required, rules.range]"
							/>

							<v-text-field
								label="Почта"
								type="email"
								v-model="formData.email"
								:rules="[rules.required, rules.range, rules.email]"
							/>

							<v-text-field
								type="password"
								label="Пароль"
								v-model="formData.password"
								:rules="[rules.required, rules.range, rules.password]"
							/>

							<v-text-field
								type="password"
								label="Повторите пароль"
								v-model="repeat"
								:rules="[rules.required, rules.range, rules.repeat]"
							/>

							<v-checkbox
								:label="'&nbsp; Я согласен с правилами регистрации'"
								:rules="[rules.accept]"
								density="dense"
								class="mb-2"
							/>

							<div class="d-flex">
								<v-btn
									variant="flat"
									type="submit"
									color="black"
									class="me-auto"
									text="Зарегистрироваться"
									:loading="loading"
								/>
								
								<v-btn
									@click="$inertia.get('login')"
									variant="text"
									text="Уже есть аккаунт?"
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
import { ref, defineOptions } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineOptions({ layout: AppLayout })

const rules = {
	required: v => !!v || 'Заполните это поле',
	range: v => v?.length < 50 || 'Слишком длинное значение',
	accept: v => v || 'Вы должны согласиться с правилами регистрации',
	password: v => v?.length >= 6 || 'Не менее 6 символов',
	repeat: v => v == formData.password || 'Пароли не совпадают',
	email: v => /^[^@.]+@[^@.]+\.[^@.]+$/.test(v) || 'Введите почту правильно',
}

const loading = ref()
const form = ref()
const repeat = ref()
const formData = useForm({
	name: '',
	surname: '',
	patronymic: '',
	login: '',
	email: '',
	password: '',
})

function submit() {
	form.value.validate().then(() => {
		if (form.value.isValid) {
			formData.post(route('register')), {
				onStart: () => loading.value = true,
				onFinish: () => loading.value = false,
				onSuccess: () => form.value.reset(),
			}
		}
	})
}
</script>
