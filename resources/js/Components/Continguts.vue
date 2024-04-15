<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


const props = defineProps({
    selectedItem: String,
    datos2: Array,

});

</script>

<template>
        <ul v-for="(dato, index) in props.datos2" :key="index">
      <!-- Utiliza un bucle v-for para recorrer todos los elementos en props.datos -->
      <li  v-if="dato.id_curs === props.selectedItem && dato.visible === 1">
        <!-- Aquí puedes mostrar los detalles de cada dato -->
        <h3>Contingut {{ index }}</h3>
        <p>Titol: {{ dato.titol }}</p>
        <p>Continguts: {{ dato.contingut }}</p>
      </li>
      <br>
    </ul>
    <a class="btn btn-sm " :href="route('afegir1.index')">Editar</a>
</template>

<style></style>