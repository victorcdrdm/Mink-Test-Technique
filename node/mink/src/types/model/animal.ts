import type { Breed } from "./breed";

export interface Animal {
    ['@id']: string
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
    totalItems: number;
    member: T[];
}

export type AnimalCollection = Animal[];