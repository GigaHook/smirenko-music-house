<template>
  <v-dialog
    v-model="dialog"
    activator="parent"
    scrim="black"
  >
    <v-row class="justify-center">
      <v-col cols="10" sm="8" md="6" lg="4" xl="3">
        <v-card class="position-relative pb-3 px-1" style="overflow: visible;">
          <v-btn
            @click="handle('close')"
            icon="mdi-close"
            class="position-absolute me-n10"
            style="right: 0"
            size="36"
          />

          <v-card-title class="text-wrap">
            {{ title }}
          </v-card-title>

          <v-card-text class="text-body-1 my-2">
            <slot>{{ text }}</slot>
          </v-card-text>

          <div class="d-flex">
            <v-btn
              variant="flat"
              color="black"
              @click="handle('confirm')"
              class="ms-2"
            >
              {{ confirmText }}
            </v-btn>
  
            <v-spacer/>
            
            <v-btn
              variant="text"
              v-if="!noDeny"
              @click="handle('deny')"
              class="me-2"
            >
              {{ denyText }}
            </v-btn>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-dialog>
</template>

<script setup>
import { ref } from 'vue'


const props = defineProps({
  noDeny: {
    type: Boolean,
    required: false,
    default: false,
  },
  confirmText: {
    type: String,
    required: false,
    default: 'Ок',
  },
  denyText: {
    type: String,
    required: false,
    default: 'Отмена',
  },
  title: {
    type: String,
    required: false,
    default: 'Подтверждение',
  },
  text: {
    type: String,
    required: false,
  },
})

const dialog = ref(false)
const emit = defineEmits('confirm', 'deny', 'close')

function handle(option) {
  emit(option)
  dialog.value = false
}
</script>