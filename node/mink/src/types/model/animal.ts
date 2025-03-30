import type { Breed } from "./breed";

export interface Animal {
    age: number,
    description: string,
    breed: Breed,
    picture?: string,
    priceExcludingTax?: number,
    fullPrice?: number,
    forSale?: boolean,
    forSaleSoon?: boolean,
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

export type AnimalCollection = ApiResponse<Animal>;