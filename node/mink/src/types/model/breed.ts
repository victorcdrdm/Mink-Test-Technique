import { AnimalType } from "../enum/animalsTypeEnum";
import { BreedCategory } from "../enum/breedCategoryEnum";
import type { Animal } from "../model/animal";

export interface Breed {
    id: string;
    name: string;
    category: BreedCategory;
    type: AnimalType;
    animals: Animal[];
}

export interface ApiResponse<T> {
    '@context': string;
    '@id': string;
    '@type': string;
    totalItems: number;
    member: T[];
}

export type BreedCollection = Breed[];