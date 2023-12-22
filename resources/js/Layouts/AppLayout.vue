<template>
  <v-app>
		<v-layout>
			<v-app-bar>
				<v-app-bar-title>
					Music House
				</v-app-bar-title>
				
				<v-btn
					v-for="item in menuItems"
					:active="page.url == item.active"
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
import { ref, watchEffect } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const menuItems = ref([])

function setMenu() {
	if (page.props.user) {
		if (page.props.user?.is_admin == 1) {
			menuItems.value = [		
				{
					text: 'Каталог',
					icon: 'mdi-shopping',
					to: 'products.index',
					active: '/products',
				},
				{
					text: 'Добавить',
					icon: 'mdi-plus-box',
					to: 'products.create',
					active: '/products/create',
				},
				{
					text: 'Заказы',
					icon: 'mdi-notebook',
					to: 'orders.index',
					active: '/orders',
				},
				{
					text: 'Выйти',
					icon: 'mdi-logout',
					to: 'logout',
					active: '',
				},
			]
		} else {
			menuItems.value = [
				{
					text: 'Каталог',
					icon: 'mdi-shopping',
					to: 'products.index',
					active: '/products',
				},
				{
					text: 'Корзина',
					icon: 'mdi-cart',
					to: 'cart.index',
					active: '/cart',
				},
				{
					text: 'Заказы',
					icon: 'mdi-notebook',
					to: 'orders.index',
					active: '/orders',
				},
				{
					text: 'О нас',
					icon: 'mdi-information',
					to: 'about',
					active: '/about',
				},
				{
					text: 'Выйти',
					icon: 'mdi-logout',
					to: 'logout',
					active: '',
				},
			]
		}
	} else {
		menuItems.value = [
			{
				text: 'Каталог',
				icon: 'mdi-shopping',
				to: 'products.index',
				active: '/products',
			},
			{
				text: 'О нас',
				icon: 'mdi-information',
				to: 'about',
				active: '/about',
			},
			{
				text: 'Войти',
				icon: 'mdi-account',
				to: 'login',
				active: '/login',
			},
		]
	}
}

watchEffect(() => setMenu())
</script>