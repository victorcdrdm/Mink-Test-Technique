import axios from 'axios';
import { API_URL } from '../types/enum/apiEnum';

interface LoginResponse {
    token: string;
    user: {
        id: number;
        email: string;
        roles: string[];
    };
}

export class ApiAuthService {
    async login(username: string, password: string): Promise<LoginResponse> {
        try {
            const response = await axios.post<LoginResponse>(`${API_URL}/login`, {
                username,
                password
            });

            if (response.status === 200 && response.data) {
                // Store the token in localStorage
                localStorage.setItem('token', response.data.token);
                // Set the token in axios default headers
                axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
                return response.data;
            }
            throw new Error('Unexpected response format');
        } catch (error) {
            console.error('Login error:', error);
            throw error;
        }
    }

    async logout(): Promise<void> {
        try {
            await axios.post(`${API_URL}/logout`);
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            // Always clear local storage and headers, even if API call fails
            localStorage.removeItem('token');
            delete axios.defaults.headers.common['Authorization'];
        }
    }

    async getUser(): Promise<void> {
        try {
            const response = await axios.get(`${API_URL}/users/1`) 
            if (response.status === 200 && response.data) {
                return response.data;
            }
        } catch (error) {
            console.error('Logout error:', error);
        }   
    }

    isAuthenticated(): boolean {
        return !!localStorage.getItem('token');
    }

    getToken(): string | null {
        return localStorage.getItem('token');
    }
} 