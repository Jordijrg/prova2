<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios'; // Importa axios para realizar solicitudes HTTP
import { ref, defineProps, watch } from 'vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


const props = defineProps({ // obtener los elementos recibidos del servidor
  datos: Array,
  datos2: Array,
});
const maxWords = 130;
const inputValue = ref(''); // Variable reactiva para almacenar el valor del input
const inputEtapa = ref(''); // Variable reactiva para almacenar el valor del input
const inputDesc = ref(''); // Variable reactiva para almacenar el valor del input
const inputTitol = ref(''); // Variable reactiva para almacenar el valor del input
const inputContingut = ref(''); // Variable reactiva para almacenar el valor del input
const inputIdcurs = ref(''); // Variable reactiva para almacenar el valor del input
const notification = ref(''); // Variable reactiva para almacenar el mensaje de notificación
const notificationdel = ref(''); // Variable reactiva para almacenar el mensaje de notificación
// Función para contar las palabras ingresadas
const countWords = () => {
  const wordCount = inputValue.value.trim().split(/\s+/).length;
  return wordCount;
};

// Observador para limitar el número de palabras permitidas
watch(inputValue, (newValue, oldValue) => {
  const words = countWords();
  if (words > maxWords) {
    const trimmedValue = newValue.trim().split(/\s+/).slice(0, maxWords).join(' ');
    inputValue.value = trimmedValue;
  }
});
const addToDatabase = async () => {
  try {
    const response = await axios.post('/afegir1', {
      nom: inputValue.value, // Enviar el valor del input al backend
      etapa: inputEtapa.value, // Enviar el valor del input al backend
      descripcio: inputDesc.value, // Enviar el valor del input al backend
    });

    // Establecer el mensaje de notificación
    notification.value = '¡Dades afegides correctament!';

    // Limpiar el input después de añadir el dato
    inputValue.value = '';
    inputDesc.value = '';
    inputEtapa.value = '';

    console.log(response.data);
  } catch (error) {
    console.error(error);
  }
};
const addToDatabasecont = async () => {
  try {
    const response = await axios.post('/afegir2', {
      titol: inputTitol.value, // Enviar el valor del input al backend
      contingut: inputContingut.value, // Enviar el valor del input al backend
      id_curs: inputIdcurs.value, // Enviar el valor del input al backend
    });

    // Establecer el mensaje de notificación
    notification.value = '¡Dades afegides correctament!';

    // Limpiar el input después de añadir el dato
    inputTitol.value = '';
    inputContingut.value = '';
    inputIdcurs.value = '';

    console.log(response.data);
  } catch (error) {
    console.error(error);
  }
};
const deleteItem = async (id) => {
  try {
    const response = await axios.delete(`/afegir1/${id}`);
    console.log(response.data); // Puedes manejar la respuesta aquí, como mostrar una notificación de éxito
    notificationdel.value = '¡Sha eliminat correctament!';

  } catch (error) {
    console.error(error);
    notificationdel.value = '¡Sha eliminat correctament!';
  }
};
const deleteItem2 = async (id) => {
  try {
    const response = await axios.delete(`/afegir2/${id}`);
    console.log(response.data); // Puedes manejar la respuesta aquí, como mostrar una notificación de éxito
    notificationdel.value = '¡Sha eliminat correctament!';

  } catch (error) {
    console.error(error);
    notificationdel.value = '¡Sha eliminat correctament!';
  }
};

const updateItem = async (item) => {
  try {
    const response = await axios.put(`/afegir1/${item.id}`, item);
    console.log(response.data); // Puedes manejar la respuesta aquí, como mostrar una notificación de éxito
    my_modal_3.close(); // Cerrar el modal después de actualizar
  } catch (error) {
    console.error(error);
    my_modal_3.close();
  }
};
const updateItem2 = async (item) => {
  try {
    const response = await axios.put(`/afegir2/${item.id}`, item);
    console.log(item.contingut);
    console.log(response.data); // Puedes manejar la respuesta aquí, como mostrar una notificación de éxito
    my_modal_4.close(); // Cerrar el modal después de actualizar
  } catch (error) {
    console.error(error);
    my_modal_4.close();
    
  }
};

const selectedItem = ref(null);
const selectedItem2 = ref(null);

const editItem = (dato) => {
  selectedItem.value = dato;
  my_modal_3.showModal(); // Mostrar el modal de edición
};
const editItem2 = (dato) => {
  selectedItem2.value = dato;
  my_modal_4.showModal(); // Mostrar el modal de edición
};
console.log(props.datos2);
</script>

<template>

  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <h1 class="text-lg font-semibold">Afegir cursos</h1>
    <div class="flex mx-auto">

      <input v-model="inputValue" type="text" placeholder="Nom" class="border rounded px-2 py-1 mr-2">
      <input v-model="inputEtapa" type="text" placeholder="Etapa" class="border rounded px-2 py-1 mr-2">
      <textarea v-model="inputDesc" placeholder="Descripció" class="border rounded px-2 py-1 mr-2"></textarea>
      <button @click="addToDatabase" class="bg-blue-500 text-black px-4 py-2 rounded">Afegir</button>
    </div>
    <div class="mt-4" v-if="notification">
      <div class="bg-green-200 text-green-800 px-4 py-2 rounded" v-if="notification">{{ notification }}</div>
    </div>
    <div class="mt-4">
      <h2 class="text-lg font-semibold">Cursos</h2>
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Etapa</th>
            <th>Descripció</th>
            <th>Visible</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr v-for="dato in props.datos" :key="dato.id">
            <th>{{ dato.id }}</th>
            <th>{{ dato.nom }}</th>
            <td>{{ dato.etapa }}</td>
            <td>{{ dato.descripcio }}</td>
            <td>{{ dato.visible }}</td>
            <td><button @click="editItem(dato)" class="btn btn-primary">Editar</button></td>
            <td><button @click="deleteItem(dato.id)" class="btn btn-error">Eliminar</button></td>
          </tr>

        </tbody>
        <div class="mt-4" v-if="notificationdel">
          <div class="bg-green-200 text-green-800 px-4 py-2 rounded" v-if="notificationdel">{{ notificationdel }}</div>
        </div>
      </table>
    </div>



    <h1 class="text-lg font-semibold mt-20">Afegir contingut</h1>
    <div class="flex mx-auto">

      <input v-model="inputTitol" type="text" placeholder="Titol" class="border rounded px-2 py-1 mr-2">
      <div class="ckeditor">
        Contingut
        <ckeditor  placeholder="Contingut" :editor="ClassicEditor" v-model="inputContingut" />
      </div>
      <textarea v-model="inputIdcurs" placeholder="Id curs" class="border rounded px-2 py-1 mr-2"></textarea>
      <button @click="addToDatabasecont" class="bg-blue-500 text-black px-4 py-2 rounded">Afegir</button>
    </div>
    <div class="mt-4" v-if="notification">
      <div class="bg-green-200 text-green-800 px-4 py-2 rounded" v-if="notification">{{ notification }}</div>
    </div>
    <div class="mt-4">
      <h2 class="text-lg font-semibold">Cursos</h2>
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th>Id</th>
            <th>Titol</th>
            <th>Contingut</th>
            <th>Idcurs</th>
            <th>Visible</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr v-for="dato2 in props.datos2" :key="dato2.id">
            <th>{{ dato2.id }}</th>
            <th>{{ dato2.titol }}</th>
            <td>{{ dato2.contingut }}</td>
            <td>{{ dato2.id_curs }}</td>
            <td>{{ dato2.visible }}</td>
            <td><button @click="editItem2(dato2)" class="btn btn-primary">Editar</button></td>
            <td><button @click="deleteItem2(dato2.id)" class="btn btn-error">Eliminar</button></td>
          </tr>

        </tbody>
        <div class="mt-4" v-if="notificationdel">
          <div class="bg-green-200 text-green-800 px-4 py-2 rounded" v-if="notificationdel">{{ notificationdel }}</div>
        </div>
      </table>
    </div>

    <!-- You can open the modal using ID.showModal() method -->

    <dialog id="my_modal_3" class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="my_modal_3.close()">✕</button>
        </form>
        <h3 class="font-bold text-lg">Editar Curso</h3>
        <p class="py-4">Presiona ESC o haz clic en ✕ para cerrar</p>
        <div v-if="selectedItem">
          <input v-model="selectedItem.nom" type="text" class="border rounded px-2 py-1 mb-2" placeholder="Nombre">
          <input v-model="selectedItem.etapa" type="text" class="border rounded px-2 py-1 mb-2" placeholder="Etapa">
          <textarea v-model="selectedItem.descripcio" class="border rounded px-2 py-1 mb-2"
            placeholder="Descripción"></textarea>
          <label>
            <input type="checkbox" :checked="selectedItem.visible === 1"
              @change="selectedItem.visible = $event.target.checked ? 1 : 0"> Visible
          </label>
          <button class="bg-blue-500 text-black px-4 py-2 rounded" @click="updateItem(selectedItem)">Guardar
            Cambios</button>
        </div>
      </div>
    </dialog>


    <dialog id="my_modal_4" class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="my_modal_4.close()">✕</button>
        </form>
        <h3 class="font-bold text-lg">Editar Curso</h3>
        <p class="py-4">Presiona ESC o haz clic en ✕ para cerrar</p>
        <div v-if="selectedItem2">
          <input v-model="selectedItem2.titol" type="text" class="border rounded px-2 py-1 mb-2" placeholder="Titol">
          <div class="ckeditor">
            Contingut
            <ckeditor :editor="ClassicEditor" v-model="selectedItem2.contingut" />
          </div>
          <textarea v-model="selectedItem2.id_curs" class="border rounded px-2 py-1 mb-2"
            placeholder="Descripción"></textarea>
          <label>
            <input type="checkbox" :checked="selectedItem2.visible === 1"
              @change="selectedItem2.visible = $event.target.checked ? 1 : 0"> Visible
          </label>
          <button class="bg-blue-500 text-black px-4 py-2 rounded" @click="updateItem2(selectedItem2)">Guardar
            Cambios</button>
        </div>
      </div>
    </dialog>

  </AuthenticatedLayout>
</template>
