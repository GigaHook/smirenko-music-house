import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

export default function useCartItem(product) {
  function increase() {
    router.post(route('cart.store'), { id: product.id })
  }

  function decrease() {
    router.patch(route('cart.update', product.id))
  }

  function remove() {
    router.delete(route('cart.destroy', product.id))
  }

  return {
    increase,
    decrease,
    remove,
  }
}