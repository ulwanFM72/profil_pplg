<template>
  <!-- "Island" Vue: satu-satunya bagian galeri yang interaktif secara penuh (JS). -->
  <div
    v-if="open"
    class="fixed inset-0 z-50 flex items-center justify-center bg-ink/90 p-4"
    role="dialog"
    aria-modal="true"
    :aria-label="current?.judul"
    @click.self="close"
    @keydown.esc="close"
    @keydown.left="prev"
    @keydown.right="next"
    tabindex="-1"
    ref="dialog"
  >
    <button type="button" class="nb-btn nb-btn-light absolute right-4 top-4" @click="close" aria-label="Tutup">✕</button>

    <button
      v-if="items.length > 1"
      type="button"
      class="nb-btn nb-btn-light absolute left-2 top-1/2 -translate-y-1/2 sm:left-6"
      @click="prev"
      aria-label="Foto sebelumnya"
    >←</button>

    <figure class="max-h-[85vh] max-w-3xl">
      <img :src="current?.src" :alt="current?.judul" class="max-h-[70vh] w-full border-[3px] border-white object-contain">
      <figcaption class="nb-card mt-3 bg-white p-4">
        <span class="nb-tag bg-sun">{{ current?.kategori }}</span> <span class="nb-tag bg-white">{{ current?.tahun }}</span>
        <p class="mt-2 text-lg font-extrabold">{{ current?.judul }}</p>
        <p v-if="current?.deskripsi" class="text-sm">{{ current.deskripsi }}</p>
      </figcaption>
    </figure>

    <button
      v-if="items.length > 1"
      type="button"
      class="nb-btn nb-btn-light absolute right-2 top-1/2 -translate-y-1/2 sm:right-6"
      @click="next"
      aria-label="Foto berikutnya"
    >→</button>
  </div>
</template>

<script setup>
import { computed, nextTick, ref } from 'vue';

const open = ref(false);
const items = ref([]);
const index = ref(0);
const dialog = ref(null);
const current = computed(() => items.value[index.value] ?? null);

function show(detail) {
  items.value = detail.items ?? [];
  index.value = detail.index ?? 0;
  open.value = true;
  nextTick(() => dialog.value?.focus());
}
function close() { open.value = false; }
function next() { index.value = (index.value + 1) % items.value.length; }
function prev() { index.value = (index.value - 1 + items.value.length) % items.value.length; }

window.addEventListener('lightbox:open', (e) => show(e.detail));
</script>
