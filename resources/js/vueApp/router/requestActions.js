import axios from 'axios';
import { logOut } from '@/Mixins/authMixin.js';

const apiUrl = 'http://127.0.0.1:8089/api'; 

export const fetchData = async (endpoint) => {
  try {
    const response = await axios.get(`${apiUrl}/${endpoint}` , {
      withCredentials: true,
      headers: {
        'Content-Type': 'application/json',
        'Authorization': "Bearer " + localStorage.getItem("token"),

      }});
    return response.data;
  } catch (error) {
    console.log(error.response.status)
    if(error.response.status==401){
      logOut();
    }
    console.error('Error fetching data:', error);
    throw error;
  }
};

export const postData = async (endpoint, data) => {

  try {
    const response = await axios.post(`${apiUrl}/${endpoint}`, data, {
      withCredentials: true,
      headers: {
        'Content-Type': 'application/json',
      //  'Authorization': "Bearer " + localStorage.getItem("token"),

      },
    });
    return response.data;
  } catch (error) {
    if(error.response.status==401){
      logOut();
    }
    
    console.error('Error posting data:', error);
    throw error;
  }
};
