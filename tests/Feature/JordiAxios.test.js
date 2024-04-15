import { describe, it, expect, vi } from 'vitest';
import axios from 'axios';
import { fetchUsers } from './users.service';
import Login from '@/Pages/Auth/Login.vue';
import {shallowMount}  from '@vue/test-utils';
vi.mock('axios', () => {
  return {
    default: {
      post: vi.fn(() => Promise.resolve({ data: 'mocked data' }))
    }
  };
});

describe('fetchUsers', () => {
  it('Test de axios para los usuarios getUsers', async () => {
    // Datos de prueba que nuestra función mock retornará
    const usersMock = [{ id: 1, name: 'Alice' }];

    // Configurar la función mock para resolver con los datos de prueba
    axios.post.mockResolvedValue({ data: usersMock });

    // Llamar a la función fetchUsers que estamos probando
    const users = await fetchUsers();

    // Verificar que la funcionalidad es la esperada
    expect(axios.post).toHaveBeenCalledWith('/afegir1');
    expect(users).toEqual(usersMock);
  });

  it('this component has text', async () => {

    const wrapper = shallowMount(Login);
    await wrapper.vm.$nextTick();
    const componentText = wrapper.text();
    expect(componentText).toContain('Cursos');
  });
});