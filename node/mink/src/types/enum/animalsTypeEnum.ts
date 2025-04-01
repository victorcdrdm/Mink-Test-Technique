export enum AnimalType {
    BOVINS = 'vache',
    OVINS = 'ovin'
}

export function parseAnimalType(type: string): AnimalType {
  return type.toLowerCase() === 'vache' ? AnimalType.BOVINS : AnimalType.OVINS;
}