export enum BreedCategory {
    VIANDE = 'viande',
    LAITIERE = 'laitiere'
}

export function parseBreedCategory(category: string): BreedCategory {
  return category.toLowerCase() === 'laitiere' ? BreedCategory.LAITIERE : BreedCategory.VIANDE;
}