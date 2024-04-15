<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Continguts from '@/Components/Continguts.vue';

const props = defineProps({ // obtener los elementos recibidos del servidor
    datos: Array,
    datos2: Array,
});
const selectedItem = ref(null);
const datos2 = ref(props.datos2);
const modal = (dato) => {
    console.log(dato);
    selectedItem.value = dato;
  my_modal_3.showModal(); // Mostrar el modal de edición
};


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex w-9/12 mx-auto mt-5">
            <div class="carousel w-full">
                <div id="slide1" class="carousel-item relative w-full">
                    <img src="https://daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.jpg" class="w-full" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide4" class="btn btn-circle">❮</a>
                        <a href="#slide2" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide2" class="carousel-item relative w-full">
                    <img src="https://daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.jpg" class="w-full" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide1" class="btn btn-circle">❮</a>
                        <a href="#slide3" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide3" class="carousel-item relative w-full">
                    <img src="https://daisyui.com/images/stock/photo-1414694762283-acccc27bca85.jpg" class="w-full" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide2" class="btn btn-circle">❮</a>
                        <a href="#slide4" class="btn btn-circle">❯</a>
                    </div>
                </div>
                <div id="slide4" class="carousel-item relative w-full">
                    <img src="https://daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.jpg" class="w-full" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide3" class="btn btn-circle">❮</a>
                        <a href="#slide1" class="btn btn-circle">❯</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="flex w-9/12 mx-auto mt-12">
            <p>
                Estàs cansat d’estar tot el dia a classe i no aprendre res? T’avorreixes davant la pantalla i només fas
                que mirar “Tik-Tok” o “Instagram”? Bé, potser necessites una motivació extra, i què millor si tens un
                EVA (Entorn Virtual d’Aprenentatge) que sigui “guai” i al teu gust!
            </p>
        </div>
        <div class="mt-4">
            <h2 class="text-lg font-semibold">Cursos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="dato in props.datos" :key="dato.id">
                <div class="card w-96 bg-base-100 shadow-xl" v-if="dato.visible === 1" >
                    <div class="card-body">
                        <h2 class="card-title">{{ dato.nom }}</h2>
                        <h3>{{ dato.etapa }}</h3>
                        <p>{{ dato.descripcio }}</p>
                        <div class="card-actions justify-end">
                            <button @click="modal(dato.id)" class="btn btn-primary">Veure continguts</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        
        <dialog id="my_modal_3" class="modal">
      <div class="modal-box">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" @click="my_modal_3.close()">✕</button>
        </form>
        <h3 class="font-bold text-lg">Continguts del curs</h3>
        <Continguts  :selectedItem ="selectedItem" :datos2="datos2"/>
      </div>
    </dialog>
    
    
    </AuthenticatedLayout>
</template>

<style>


</style>

