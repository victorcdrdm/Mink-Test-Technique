import { AnimalType } from "../enum/animalsTypeEnum";
import { BreedCategory } from "../enum/breedCategoryEnum";
import type { Animal } from "../model/animal";

export interface Breed {
    id: number;
    name: string;
    category: BreedCategory;
    type: AnimalType;
    animals?: Animal;
}

export interface ApiResponse<T> {
    '@context'?: string;
    '@id'?: string;
    '@type'?: string;
    'hydra:totalItems'?: number;
    'hydra:member'?: T[];
    // Si c'est un seul élément et non une collection
    ...Partial<T>;
}

export type BreedCollection = ApiResponse<Breed>;