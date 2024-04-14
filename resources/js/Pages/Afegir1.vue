<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios'; // Importa axios para realizar solicitudes HTTP
import { ref, defineProps } from 'vue';

const props = defineProps({ // obtener los elementos recibidos del servidor
    datos: Array,
});

const inputValue = ref(''); // Variable reactiva para almacenar el valor del input
const notification = ref(''); // Variable reactiva para almacenar el mensaje de notificación

const addToDatabase = async () => {
    try {
        const response = await axios.post('/afegir1', {
            nom: inputValue.value // Enviar el valor del input al backend
        });

        // Establecer el mensaje de notificación
        notification.value = '¡Dato añadido correctamente!';
        
        // Limpiar el input después de añadir el dato
        inputValue.value = '';

        console.log(response.data);
    } catch (error) {
        console.error(error);
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex w-9/12 mx-auto">
            <input v-model="inputValue" type="text" placeholder="Ingrese el dato a agregar" class="border rounded px-2 py-1 mr-2">
            <button @click="addToDatabase" class="bg-blue-500 text-black px-4 py-2 rounded">Afegir</button>
        </div>
        <div class="mt-4" v-if="notification">
            <div class="bg-green-200 text-green-800 px-4 py-2 rounded" v-if="notification">{{ notification }}</div>
        </div>
        <div class="mt-4">
            <h2 class="text-lg font-semibold">Datos en la tabla afegir1:</h2>
            <ul>
                <li v-for="dato in props.datos" :key="dato.id">{{ dato.nom }}</li> <!-- Mostrar cada dato -->
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
