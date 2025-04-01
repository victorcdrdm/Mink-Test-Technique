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
            const response = await axios.post<LoginResponse>(`${API_URL}/api/login`, {
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

    logout(): void {
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
    }

    isAuthenticated(): boolean {
        return !!localStorage.getItem('token');
    }

    getToken(): string | null {
        return localStorage.getItem('token');
    }
} 