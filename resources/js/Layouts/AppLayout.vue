<template>
  <v-app>
		<v-layout>
			<v-app-bar>
				<v-app-bar-title>
					Music House
				</v-app-bar-title>
				
				<v-btn
					v-for="item in menuItems"
					:active="page.url.includes(item.to) || (page.url == '/' && item.to == 'products')"
					:prepend-icon="item.icon"
					@click="$inertia.get(route(item.to))"
					stacked
				>
					{{ item.text }}
				</v-btn>
			</v-app-bar>

			<v-main>
				<slot/>
			</v-main>
		</v-layout>
	</v-app>
</template>

<script setup>
import { onMounted, ref, watchEffect } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const menuItems = ref([])

function setMenu() {
	if (page.props.user) {
		if (page.props.user.isAdmin) {
			menuItems.value = [		
				{
					text: 'Каталог',
					icon: 'mdi-shopping',
					to: 'products',
				},
				{
					text: 'Заказы',
					icon: 'mdi-notebook',
					to: 'orders',
				},
				{
					text: 'Выйти',
					icon: 'mdi-logout',
					to: 'logout',
				},
			]
		} else {
			menuItems.value = [
				{
					text: 'Каталог',
					icon: 'mdi-shopping',
					to: 'products',
				},
				{
					text: 'Корзина',
					icon: 'mdi-cart',
					to: 'cart',
				},
				{
					text: 'Заказы',
					icon: 'mdi-notebook',
					to: 'orders',
				},
				{
					text: 'О нас',
					icon: 'mdi-information',
					to: 'about',
				},
				{
					text: 'Выйти',
					icon: 'mdi-logout',
					to: 'logout',
				},
			]
		}
	} else {
		menuItems.value = [
			{
				text: 'Каталог',
				icon: 'mdi-shopping',
				to: 'products',
			},
			{
				text: 'О нас',
				icon: 'mdi-information',
				to: 'about',
			},
			{
				text: 'Войти',
				icon: 'mdi-account',
				to: 'login',
			},
		]
	}
}

watchEffect(() => setMenu())
</script>