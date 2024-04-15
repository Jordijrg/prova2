import axios from 'axios';

export const fetchUsers = async () => {
  try {
    const response = await axios.post('/afegir1');
    return response.data;
  } catch (error) {
    throw error;
  }
};