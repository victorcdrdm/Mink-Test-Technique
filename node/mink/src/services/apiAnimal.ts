import type { Animal, ApiResponse } from "../types/model/animal";
import axios from 'axios';
import { API_URL } from "../types/enum/apiEnum";

export class ApiAnimalService {

    async getAllAnimals(): Promise<Animal[]> {
        try {
            const response = await axios.get<ApiResponse<Animal>>(`${API_URL}/animals`);
            if (response.status === 200 && response.data) {
                return response.data.member;
            }
            throw new Error('Unexpected response format');
        } catch (error) {
            console.error('Error fetching breeds:', error);
            throw error;
        }
    }

    async getAllAnimalsForUser(): Promise<Animal[]> {
        try {
            const response = await axios.get<ApiResponse<Animal>>(`${API_URL}/animals/all/forsale`);
            if (response.status === 200 && response.data) {
                return response.data;
            }
            throw new Error('Unexpected response format');
        } catch (error) {
            console.error('Error fetching breeds:', error);
            throw error;
        }
    }
    
    async getAnimalsByBreeId(id: number): Promise<Animal[]> {
        console.log(id)
        try {
            const response = await axios.get<ApiResponse<Animal>>(`${API_URL}/animals/breed/${id}`);
            if (response.status === 200 && response.data) {
                return response.data;
            }
            throw new Error('Unexpected response format');
        } catch (error) {
            console.error('Error fetching breeds:', error);
            throw error;
        }
    } 
    

    async getAnimalsByBreedType(type :string): Promise<Animal[]> {
        try {
            const response = await axios.get<ApiResponse<Animal>>(`${API_URL}/animals/breed/type/${type}`);
            if (response.status === 200 && response.data) {
                return response.data;
            }
            throw new Error('Unexpected response format');
        } catch (error) {
            console.error('Error fetching breeds:', error);
            throw error;
        }
    }
}