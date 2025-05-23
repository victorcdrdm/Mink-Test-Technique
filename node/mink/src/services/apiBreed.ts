import axios from 'axios';
import type { Breed, ApiResponse } from '../types/model/breed';
import { API_URL } from "../types/enum/apiEnum";
export class ApiBreedService {        
    async getAllBreeds(): Promise<Breed[]> {
        try {
            const response = await axios.get<ApiResponse<Breed>>(`${API_URL}/breeds`);
            if (response.status === 200 && response.data.member) {
                return response.data.member;
            }
            throw new Error('Unexpected response format');
        } catch (error) {
            console.error('Error fetching breeds:', error);
            throw error;
        }
    }

    async getBreedsByType(breedType: string): Promise<Breed[]> {
        try {
            const response = await axios.get<ApiResponse<Breed>>(`${API_URL}/breeds/type/${breedType}`);
            if (response.status === 200 && response.data) {
                return response.data;
            }
            throw new Error('Unexpected response format');
        } catch (error) {
            console.error('Error fetching breeds:', error);
            throw error;
        }
    }

    async getBreedsById(id: number): Promise<Breed[]> {
        try {
            const response = await axios.get<ApiResponse<Breed>>(`${API_URL}/breeds/${id}`);
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

