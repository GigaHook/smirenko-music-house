<template>
	<v-container>
		<v-row justify="center">
			<v-col cols="8">
				<v-card>
					<v-card-title>
						Где нас найти?
					</v-card-title>

					<v-card-text>
						<v-row>
							<v-col cols="4" class="text-center text-h6">
								<v-icon icon="mdi-map"/>
								Адрес <br>
								г. Канск, ул. Ленина, д. 4
							</v-col>
							
							<v-col cols="4"  class="text-center text-h6">
								<v-icon icon="mdi-phone"/>
								Номер телефона <br>
								+7 (123) 456-78-90
							</v-col>

							<v-col cols="4"  class="text-center text-h6">
								<v-icon icon="mdi-email"/>
								Почта <br>
								music.house@gmail.com
							</v-col>
						</v-row>
					</v-card-text>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script setup>
import { defineOptions } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

defineOptions({ layout: AppLayout })
</script>